<?php
namespace App\Http\Controllers;

use Storage;
use App\Models\Centre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use App\Models\Candidat;
use App\Models\CategoriesExamen;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Maatwebsite\Excel\Excel as ExcelExcel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class ResultatController extends Controller
{

public function charger(Request $request)
    {

        $examens = CategoriesExamen::all();
        $centres = Centre::all();
        $anneescolaires = Anneescolaire::all();
         $sexes = [
            ['sexe' => __('traduction.sexe1')],
            ['sexe' => __('traduction.sexe2')],
        ];
        // return view('resultats.import');
        return view('resultats.import', compact('examens','centres','anneescolaires','sexes'));
    }

    // 📥 Import Excel

    public function import(Request $request)
        {

            // 1️⃣ Validation

                    $request->validate([
                        'annee'   => 'required',
                        'examen' => 'required',
                        'centre' => 'required',
                        'sexe'    => 'required',
                        // 🔥 file requis UNIQUEMENT si ce n’est PAS un force_update
                        'file' => $request->has('force_update')
                            ? 'nullable'
                            : 'required|mimes:xlsx,xls,csv',
                    ]);

                // 2️⃣ Vérifier si données existent
                $anneeExiste = DB::table('resultats_dynamiques')
                    ->where('annee', $request->annee)
                    ->where('examen', $request->examen)
                    ->where('centre', $request->centre)
                    ->where('sexe', $request->sexe)
                    ->exists();


            if ($anneeExiste && !$request->has('force_update'))
            {
                    // 🔹 Sauvegarder les données du formulaire
                    session([
                        'import_data' => [
                            'annee'   => $request->annee,
                            'examen' => $request->examen,
                            'centre' => $request->centre,
                            'sexe'    => $request->sexe,
                        ]
                    ]);

                    // 2b. Récupérer résumé des données existantes
                    $donneesExistantes = DB::table('resultats_dynamiques')
                        ->where('annee', $request->annee)
                        ->where('examen', $request->examen)
                        ->where('centre', $request->centre)
                        ->where('sexe', $request->sexe)
                        ->select('matricule','nom','prenom')
                        ->get();

                        // 🔹 Sauvegarder le fichier Excel
                    $tmpPath = $request->file('file')->store('tmp');
                    session(['tmp_file' => $tmpPath]);

                    $totalEleves = $donneesExistantes->count();

                    $message  = __('traduction.annee')   . ' : ' . $request->annee   . "\n";
                    $message .= __('traduction.exam')  . ' : ' . $request->examen . "\n";
                    $message .= __('traduction.centre')  . ' : ' . $request->centre . "\n";
                    $message .= __('traduction.sexe')    . ' : ' . $request->sexe    . "\n";
                    $message .=  __('traduction.nobreleve'). ' : ' .$totalEleves. "\n";
                    $message .= __('traduction.verifiedabord');

                    return back()->with([
                                'confirm_update' => true,
                                'existing_message' => $message,
                            ]);
                }
            // 4️⃣ Lecture Excel
                if ($request->has('force_update')) {
                        // fichier temporaire déjà stocké
                        $filePath = storage_path('app/' . session('tmp_file'));
                        // On force XLSX par défaut, CSV si le nom contient .csv
                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                } else {
                        $file = $request->file('file');
                        $filePath = $file->getRealPath();
                        $extension = $file->getClientOriginalExtension();
                    }

                    $extension = strtolower($extension);

                    $table = 'resultats_dynamiques';
                // Déterminer le Reader et le type pour Excel
                   $reader = match($extension) {
                        'csv'  => new Csv(),
                        default => new Xlsx(),
                    };
                    // Forcer le calcul des formules
                    $reader->setReadDataOnly(false);  // false pour lire les formules
                    $spreadsheet = $reader->load($filePath);
                    // Récupérer les valeurs calculées
                    $rows = $spreadsheet->getActiveSheet()->toArray(null, true, false, false);
                    if (empty($rows)) {
                        return back()->with('error', 'Le fichier Excel est vide !');
                    }

                $headings = array_values($rows[0]); // ✅ la ligne d'en-tête
                $erreurs = [];

                // Créer table si inexistante
                if (!Schema::hasTable($table)) {
                    Schema::create($table, function (Blueprint $t) use ($headings) {
                        $t->id();
                        $t->string('matricule')->unique();
                        // Colonnes fixes minimales (optionnel mais conseillé)
                        $t->string('nom',60)->nullable();
                        $t->string('prenom',100)->nullable();
                        $t->string('sexe',15)->nullable();
                        $t->string('annee',20); // ex: 2024-2025
                        $t->string('centre',50)->nullable();
                        $t->string('etablissement',50)->nullable();
                        $t->string('examen',50)->nullable();
                        foreach ($headings as $col) {
                            $t->string(Str::slug($col, '_'))->nullable();
                        }
                        $t->timestamps();
                    });
                }

                // Ajouter colonnes manquantes
                Schema::table($table, function (Blueprint $t) use ($headings, $table) {
                    foreach ($headings as $col) {
                        $column = Str::slug($col, '_');
                        if (!Schema::hasColumn($table, $column)) {
                            $t->string($column)->nullable();
                        }
                    }
                });

            // 5️⃣ Vérification ligne par ligne
            foreach (array_slice($rows, 1) as $index => $row) {

                $ligne = $index + 2;

                // Associer chaque colonne à sa valeur
                $data = array_combine($headings, $row);

                $matricule = $data['Matricule'] ?? null;
                $nom       = $data['Nom'] ?? null;
                $prenom    = $data['Prenom'] ?? null;

                foreach ($data as $col => $value) {

                    $column = Str::slug($col, '_');

                    if (!in_array($column, [
                        'matricule','nom','prenom','sexe',
                        'annee','centre','examen','etablissement'
                    ]) && $value !== null) {

                        $value = trim($value);
                        $isNumberValid = is_numeric($value) && $value >= 0 && $value <= 600;
                        $isWordValid   = preg_match('/^[\p{L}\s]+$/u', $value); // lettres seulement

                        if (!$isNumberValid && !$isWordValid) {
                            $erreurs[] =
                                __('traduction.ligne').' '.$ligne.' '.
                                __('traduction.lanote').' '.$col.' : '.$value;
                        }
                    }
                }

                // Vérification élève existant avec autre matricule
                $eleveExisteAutreMatricule = DB::table('resultats_dynamiques')
                    ->where('annee', $request->annee)
                    ->where('examen', $request->examen)
                    ->where('centre', $request->centre)
                    ->where('sexe', $request->sexe)
                    ->where('nom', $nom)
                    ->where('prenom', $prenom)
                    ->where('matricule', '<>', $matricule)
                    ->exists();

                if ($eleveExisteAutreMatricule) {
                    $erreurs[] =
                        __('traduction.ligne').' '.$ligne.' '.
                        __('traduction.leleve').' '.$nom.' '.$prenom.' '.
                        __('traduction.existe');
                }
            }

            if (!empty($erreurs)) {
                return back()->with('import_errors', $erreurs);
            }

            // 6️⃣Aucune erreur → insertion
                foreach (array_slice($rows, 1) as $index => $row) {

                    $ligne = $index + 2;

                    if (!is_array($row)) {
                        continue;
                    }

                    if (count($headings) !== count($row)) {
                        continue;
                    }

                    // 1️⃣ Combiner colonnes + valeurs
                    $rowData = array_combine($headings, $row);

                    $data = [
                        'annee'   => $request->annee,
                        'examen' => $request->examen,
                        'centre' => $request->centre,
                        'sexe'    => $request->sexe,
                    ];

                    $matricule = null;

                    // 2️⃣ Normalisation + récupération matricule
                    foreach ($rowData as $col => $value) {
                        $column = Str::slug($col, '_');

                        if ($column === 'matricule') {
                            $matricule = $value;
                        }

                        $data[$column] = $value;
                    }

                    // 3️⃣ Sécurité
                    if (!$matricule) {
                        continue;
                    }

                    // 4️⃣ INSERT / UPDATE
                    DB::table('resultats_dynamiques')->updateOrInsert(
                        [
                            'matricule' => $matricule,
                            'annee'     => $request->annee,
                            'examen'   => $request->examen,
                            'centre'   => $request->centre,
                            'sexe'      => $request->sexe,
                        ],
                        $data
                    );
                }

            session()->forget(['import_data', 'tmp_file']);

            return back()->with('success',  __('traduction.importreusi') );

        }
    // 📊 Affichage
    public function index(Request $request)
    {
        $annee = $request->annee;

        $anneescolaires = Anneescolaire::all();

        $colonnes = Schema::getColumnListing('resultats_dynamiques');
        $colonnes = array_diff($colonnes, ['id', 'created_at', 'updated_at']);

        $query = DB::table('resultats_dynamiques');

        if ($annee) {
            $query->where('annee', $annee);
        }

        $resultats = $query->get();

        return view('resultats.index', compact('resultats', 'colonnes', 'annee','anneescolaires'));
    }

     public function recherche_resultats(Request $request)
    {
             $candidat = null;
             $information = null;

            $numero_table = DB::table('candidats')
                        ->where('numero_table', $request->matricule)
                        ->first();

                if ($numero_table) {

                    // $information = DB::table('candidats')
                    // ->with(['anneescolaire'])
                    // ->where('numero_table', $request->matricule)
                    // ->first();

                    // $information = DB::table('candidats')
                    //     ->join('anneescolaires', 'anneescolaires.id', '=', 'candidats.anneescolaire_id')
                    //     ->where('candidats.numero_table', $request->matricule)
                    //     ->select('candidats.*', 'anneescolaires.libelle as annee_scolaire')
                    //     ->first();

                    $information = Candidat::with('anneescolaire','etablissement','centre','categoriesExamen')
                        ->where('numero_table', $request->matricule)
                        ->first();

                    if ($request->filled('matricule')) {
                        $candidat = DB::table('resultats_dynamiques')
                            ->where('matricule', $request->matricule)
                            ->first();
                        }
                } else {
                    # code...
                    $candidat = null;
                    $information = null;
                }


            return view('resultats.recherche_resultat', compact('candidat','information'));
    }

}
