<?php
namespace App\Http\Controllers;

use Storage;
use App\Models\Centre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use App\Models\CategoriesExamen;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

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
                'examens' => 'required',
                'centres' => 'required',
                'sexe'    => 'required',
                // 🔥 file requis UNIQUEMENT si ce n’est PAS un force_update
                'file' => $request->has('force_update')
                    ? 'nullable'
                    : 'required|mimes:xlsx,xls,csv',
            ]);

        // 2️⃣ Vérifier si données existent
        $anneeExiste = DB::table('resultats_dynamiques')
            ->where('annee', $request->annee)
            ->where('examens', $request->examens)
            ->where('centres', $request->centres)
            ->where('sexe', $request->sexe)
            ->exists();


    if ($anneeExiste && !$request->has('force_update'))
    {
            // 🔹 Sauvegarder les données du formulaire
            session([
                'import_data' => [
                    'annee'   => $request->annee,
                    'examens' => $request->examens,
                    'centres' => $request->centres,
                    'sexe'    => $request->sexe,
                ]
            ]);

            // 2b. Récupérer résumé des données existantes
            $donneesExistantes = DB::table('resultats_dynamiques')
                ->where('annee', $request->annee)
                ->where('examens', $request->examens)
                ->where('centres', $request->centres)
                ->where('sexe', $request->sexe)
                ->select('matricule','nom','prenom')
                ->get();

                // 🔹 Sauvegarder le fichier Excel
            $tmpPath = $request->file('file')->store('tmp');
            session(['tmp_file' => $tmpPath]);

            $totalEleves = $donneesExistantes->count();

            $message  = __('traduction.annee')   . ' : ' . $request->annee   . "\n";
            $message .= __('traduction.exam')  . ' : ' . $request->examens . "\n";
            $message .= __('traduction.centre')  . ' : ' . $request->centres . "\n";
            $message .= __('traduction.sexe')    . ' : ' . $request->sexe    . "\n";
            $message .=  __('traduction.nobreleve'). ' : ' .$totalEleves. "\n";
            $message .= __('traduction.verifiedabord');

            return back()->with([
                        'confirm_update' => true,
                        'existing_message' => $message,
                    ]);
        }


        if ($anneeExiste && $request->has('force_update')) {

            DB::table('resultats_dynamiques')
                ->where('annee', $request->annee)
                ->where('examens', $request->examens)
                ->where('centres', $request->centres)
                ->where('sexe', $request->sexe)
                ->delete();
        }


    // 4️⃣ Lecture Excel
    if ($request->has('force_update')) {
            $filePath = storage_path('app/' . session('tmp_file'));
        } else {
            $filePath = $request->file('file')->getRealPath();
        }

    $rows = Excel::toArray([], $filePath);
    $headings = $rows[0][0];
    $erreurs = [];

    // 5️⃣ Vérification ligne par ligne
    foreach (array_slice($rows[0], 1) as $index => $row) {
        $ligne = $index + 2;
        $matricule = $row[0] ?? null;
        $nom = $row[1] ?? null;
        $prenom = $row[2] ?? null;

        // Exemple validation note <20
        foreach ($headings as $i => $col) {
            $column = Str::slug($col,'_');
            $value = $row[$i] ?? null;
            if (!in_array($column,['matricule','nom','prenom','sexe','annee','centres','examens','etablissements']) && $value !== null) {
                if (!is_numeric($value) || $value < 0 || $value > 100) {
                    $erreurs[] = "Ligne {$ligne} : La note de {$col} est invalide (>100 ou non numérique).";
                }
            }
        }

        // Doublons matricule
        if ($matricule) {
            $eleveExiste = DB::table('resultats_dynamiques')
                ->where('matricule',$matricule)
                ->exists();
            if ($eleveExiste) {
                $erreurs[] = "Ligne {$ligne} : L’élève {$nom} {$prenom} a un matricule déjà existant.";
            }
        }
    }

    if (!empty($erreurs)) {
        return back()->with('import_errors', $erreurs);
    }

    // 6️⃣ Insertion
    foreach (array_slice($rows[0], 1) as $row) {

        $data = [
            'annee'   => $request->annee,
            'examens' => $request->examens,
            'centres' => $request->centres,
            'sexe'    => $request->sexe,
        ];

        foreach ($headings as $i => $col) {
            $data[Str::slug($col, '_')] = $row[$i] ?? null;
        }

        DB::table('resultats_dynamiques')->insert($data);
    }

    session()->forget(['import_data', 'tmp_file']);

    return back()->with('success', "✅ Importation réussie");

}

    // 📊 Affichage
    public function index(Request $request)
    {
        $annee = $request->annee;

        $colonnes = Schema::getColumnListing('resultats_dynamiques');
        $colonnes = array_diff($colonnes, ['id', 'created_at', 'updated_at']);

        $query = DB::table('resultats_dynamiques');

        if ($annee) {
            $query->where('annee', $annee);
        }

        $resultats = $query->get();

        return view('resultats.index', compact('resultats', 'colonnes', 'annee'));
    }
}
