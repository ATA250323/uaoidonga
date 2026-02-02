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

        // if ($anneeExiste && $request->has('force_update')) {

        //     DB::table('resultats_dynamiques')
        //         ->where('annee', $request->annee)
        //         ->where('examens', $request->examens)
        //         ->where('centres', $request->centres)
        //         ->where('sexe', $request->sexe)
        //         ->delete();
        // }


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

            // Déterminer le type pour Excel
            $type = match($extension) {
                'csv' => ExcelExcel::CSV,
                default => ExcelExcel::XLSX, // XLS et XLSX sont lus comme XLSX
            };

        $table = 'resultats_dynamiques';

            // Lire le fichier Excel
        $rows = Excel::toArray([], $filePath, null, $type);
        // $rows = Excel::toArray([], $file);
        $headings = $rows[0][0];
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
                $t->string('centres',50)->nullable();
                $t->string('etablissements',50)->nullable();
                $t->string('examens',50)->nullable();
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
                    $erreurs[] = __('traduction.ligne') .' '. $ligne .' '. __('traduction.lanote').' '.$col.' '.__('traduction.lanote');
                }
            }
        }

        // Doublons matricule
        // if ($matricule) {
        //     $eleveExiste = DB::table('resultats_dynamiques')
        //         ->where('matricule',$matricule)
        //         ->exists();
        //     if ($eleveExiste) {
        //         $erreurs[] = "Ligne {$ligne} : L’élève {$nom} {$prenom} a un matricule déjà existant.";
        //     }
        // }
        $eleveExisteAutreMatricule = DB::table('resultats_dynamiques')
            ->where('annee', $request->annee)
            ->where('examens', $request->examens)
            ->where('centres', $request->centres)
            ->where('sexe', $request->sexe)
            ->where('nom', $nom)
            ->where('prenom', $prenom)
            ->where('matricule','<>',$matricule)
            ->exists();

        if ($eleveExisteAutreMatricule) {
            $erreurs[] = __('traduction.ligne') .' '. $ligne .' '. __('traduction.leleve').' '.$nom .' '.$prenom .' '. __('traduction.existe');
        }

    }

    if (!empty($erreurs)) {
        return back()->with('import_errors', $erreurs);
    }

    // 6️⃣Aucune erreur → insertion
        foreach (array_slice($rows[0], 1) as $row) {
            $data = [
                'annee'    => $request->annee,
                'examens'  => $request->examens,
                'centres'  => $request->centres,
                'sexe'     => $request->sexe,
            ];
            // Récupérer matricule (clé principale)
            $matricule = null;
            foreach ($headings as $i => $col) {
                $column = Str::slug($col, '_');
                $value  = $row[$i] ?? null;
                if ($column === 'matricule') {
                    $matricule = $value;
                }
                $data[$column] = $value;
            }

            // 🔴 Sécurité : matricule obligatoire
            if (!$matricule) {
                continue;
            }
            // ✅ UPDATE ou INSERT (ligne par ligne)
            DB::table('resultats_dynamiques')->updateOrInsert(
                [
                    'matricule' => $matricule,
                    'annee'     => $request->annee,
                    'examens'   => $request->examens,
                    'centres'   => $request->centres,
                    'sexe'      => $request->sexe,
                ],
                $data
            );
        }

    session()->forget(['import_data', 'tmp_file']);

    return back()->with('success', "✅ Importation réussie");

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

                    $information = DB::table('candidats')
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

// public function ajaxRecherche(Request $request)
// {
//      $request->validate([
//         'matricule' => 'required'
//     ]);

//     $resultat = DB::table('resultats_dynamiques')
//         ->where('numero_matricule', $request->matricule)
//         ->first();

//     if (!$resultat) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Aucun résultat trouvé pour ce numéro matricule'
//         ]);
//     }

//     return response()->json([
//         'success' => true,
//         'data' => [
//             'matricule'        => $resultat->numero_matricule,
//             'nom'              => $resultat->nom,
//             'prenoms'          => $resultat->prenoms,
//             'date_naissance'   => $resultat->date_naissance,
//             'lieu_naissance'   => $resultat->lieu_naissance,
//             'nationalite'      => $resultat->nationalite,
//             'sexe'             => $resultat->sexe,
//             'telephone'        => $resultat->telephone,
//             'adresse'          => $resultat->adresse,
//             'decision'         => $resultat->decision,
//             'photo'            => $resultat->photo
//                 ? asset('storage/'.$resultat->photo)
//                 : asset('images/avatar.png'),
//         ]
//     ]);
// }

}
