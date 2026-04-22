<?php

namespace App\Http\Controllers;

use App\Exports\CandidatsExport;
use App\Http\Requests\CandidatRequest;
use App\Models\Anneescolaire;
use App\Models\Candidat;
use App\Models\CategoriesExamen;
use App\Models\CentreEtablissementExamen;
use App\Models\Etablissement;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel as ExcelWriter;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class CandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // $candidats = Candidat::paginate();

        $colonnes = Schema::getColumnListing('candidats');
        $colonnes = array_diff($colonnes, ['id', 'created_at', 'updated_at','date_naissance','public_id','photo']);

        // $query = DB::table('candidats');

        // $candidats = $query->get();
        // $candidats = DB::table('candidats')
        //         ->leftJoin('etablissements', 'candidats.etablissement_id', '=', 'etablissements.id')
        //         ->leftJoin('categories_examens', 'candidats.categorie_examen_id', '=', 'categories_examens.id')
        //         ->leftJoin('anneescolaires', 'candidats.anneescolaire_id', '=', 'anneescolaires.id')
        //         ->select(
        //             'candidats.*',
        //             'etablissements.nomarabe as nomarabe',
        //             'categories_examens.libelle as libelle',
        //             'anneescolaires.anneefr as anneefr',
        //         )
        //         ->get();
        $candidats = DB::table('candidats')
                // 🔥 1. joindre etablissements AVANT
                ->leftJoin('etablissements', 'candidats.etablissement_id', '=', 'etablissements.id')
                ->leftJoin('categories_examens', 'candidats.categorie_examen_id', '=', 'categories_examens.id')
                ->leftJoin('anneescolaires', 'candidats.anneescolaire_id', '=', 'anneescolaires.id')
                // 🔥 2. ensuite pivot
                ->leftJoin('centre_etablissement_examens', function($join) {
                    $join->on('centre_etablissement_examens.etablissement_id', '=', 'etablissements.id')
                        ->on('centre_etablissement_examens.categorie_examen_id', '=', 'candidats.categorie_examen_id');
                })
                // 🔥 3. puis centres
                ->leftJoin('centres', 'centre_etablissement_examens.centre_id', '=', 'centres.id')
                ->select(
                    'candidats.*',
                    'etablissements.nomarabe as nomarabe',
                    'categories_examens.libelle as libelle',
                    'anneescolaires.anneefr as anneefr',
                    'centres.nomar as centre_nom'
                )

                ->get();


        return view('candidat.index', compact('candidats','colonnes'));
        // return view('candidat.index', compact('candidats'))
        //     ->with('i', ($request->input('page', 1) - 1) * $candidats->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $candidat = new Candidat();
        $examens = CategoriesExamen::all();
        $anneescolaires = Anneescolaire::all();
        $etablissements = Etablissement::all();
         $sexes = [
            ['sexe' => __('traduction.sexe1') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */],
            ['sexe' => __('traduction.sexe2') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */],
        ];
        return view('candidat.create', compact('candidat','etablissements','anneescolaires','examens','sexes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CandidatRequest $request): RedirectResponse
    {
        Auth::user();

        $request->validated();

        $mapping = CentreEtablissementExamen::where([
                'etablissement_id' => $request->etablissement_id,
                'categorie_examen_id' => $request->categorie_examen_id,
            ])->firstOrFail();

            if (Candidat::where([
                'anneescolaire_id' => $request->anneescolaire_id,
                'numero_table' => $request->numero_table,])->exists()) {

                return redirect()
                            ->back()
                            ->withInput($request->only([
                                'anneescolaire_id',
                                'etablissement_id',
                                'categorie_examen_id',
                                'sexe',
                            ]))
                            ->with('alertMessage', __('traduction.erreur_deja'));

                // return Redirect::route('candidats.create')
                //             ->with('alertMessage',
                //             __('traduction.erreur_deja') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
                //         );
                //     # code...
            }else{

                    Candidat::create([
                        'nom' => $request->nom,
                        'sexe' => $request->sexe,
                        // 'date_naissance' => $request->date_naissance,
                        // 'telephone' => $request->telephone,
                        // 'adresse' => $request->adresse,
                        'numero_table' => $request->numero_table,
                        'etablissement_id' => $request->etablissement_id,
                        'centre_id' => $mapping->centre_id, // 🔐 imposé
                        'anneescolaire_id' => $request->anneescolaire_id,
                        'categorie_examen_id' => $request->categorie_examen_id,
                    ]);
                    return redirect()
                            ->back()
                            ->withInput($request->only([
                                'anneescolaire_id',
                                'etablissement_id',
                                'categorie_examen_id',
                                'sexe',
                            ]))
                            ->with('success', __('traduction.save_success'));
                // return redirect()->route('candidats.index')->with('success', __('traduction.save_success'));
            }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $candidat = Candidat::find($id);

        return view('candidat.show', compact('candidat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $candidat = Candidat::where('public_id',$id)->firstOrFail();
        $examens = CategoriesExamen::all();
        $anneescolaires = Anneescolaire::all();
        $etablissements = Etablissement::all();
         $sexes = [
            ['sexe' => __('traduction.sexe1') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */],
            ['sexe' => __('traduction.sexe2') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */],
        ];
        return view('candidat.edit', compact('candidat','etablissements','anneescolaires','examens','sexes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        request()->validate([
            'nom' => 'required|string',
			'prenom' => 'required|string',
			'sexe' => 'required|string',
			'numero_table' => 'string',
			// 'centre_id' => 'required',
			'etablissement_id' => 'required',
			'anneescolaire_id' => 'required',
			'categorie_examen_id' => 'required',
            ]);


        $candidat = Candidat::where('public_id',$id)->firstOrFail();

            if (CentreEtablissementExamen::where([
                'etablissement_id' => $request->etablissement_id,
                'categorie_examen_id' => $request->categorie_examen_id,])->exists()) {

                $mapping = CentreEtablissementExamen::where([
                        'etablissement_id' => $request->etablissement_id,
                        'categorie_examen_id' => $request->categorie_examen_id,
                    ])->first();

                $candidat->nom = $request->nom;
                $candidat->prenom = $request->prenom;
                $candidat->sexe = $request->sexe;
                // $candidat->date_naissance = $request->date_naissance;
                // $candidat->telephone = $request->telephone;
                // $candidat->adresse = $request->adresse;
                $candidat->numero_table = $request->numero_table;
                $candidat->etablissement_id = $request->etablissement_id;
                $candidat->centre_id = $mapping->centre_id; // 🔐 imposé
                $candidat->anneescolaire_id = $request->anneescolaire_id;
                $candidat->categorie_examen_id = $request->categorie_examen_id;

                $candidat->save();
            return Redirect::route('candidats.index')->with('success', __('traduction.update_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
        );

            }else{
                return Redirect::route('candidats.edit', $candidat->public_id)
                            ->with('alertMessage',
                            __('traduction.etablipasexam') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
                        );
                    # code...
            }
    }

    public function destroy($id): RedirectResponse
    {
        $candidat = Candidat::where('public_id',$id)->firstOrFail();

        // Supprimer en base
        $candidat->delete();
        return Redirect::route('candidats.index')
            ->with('success', __('traduction.delete_success'));
    }

        public function export(Request $request)
        {

            $ids = $request->ids ?? [];
            $visibleCols = $request->visibleCols ?? [];

            $query = Candidat::with(['etablissement', 'categoriesExamen', 'centre', 'anneescolaire']);

            if (!empty($ids)) {
                $query->whereIn('id', $ids);
            }
            return Excel::download(
                new CandidatsExport($query, $visibleCols),
                'candidats.xlsx',
                ExcelWriter::XLSX // 🔥 SOLUTION
            );
        }


        public function chargercandidat(Request $request)
        {

            $categorie_examens = CategoriesExamen::all();
            $etablissements = Etablissement::all();
            $anneescolaires = Anneescolaire::all();
            $sexes = [
                ['sexe' => __('traduction.sexe1')],
                ['sexe' => __('traduction.sexe2')],
            ];
            // return view('resultats.import');
            return view('candidat.import', compact('categorie_examens','etablissements','anneescolaires','sexes'));
        }


           // 📥 Import Excel

    public function importcandidat(Request $request)
        {
            // dd( $request->anneescolaire_id,$request->categorie_examen_id,$request->etablissement_id,$request->sexe);
            // 1️⃣ Validation
                    $request->validate([
                        'etablissement_id'   => 'required',
                        'anneescolaire_id' => 'required',
                        'categorie_examen_id' => 'required',
                        'sexe'    => 'required',
                        // 🔥 file requis UNIQUEMENT si ce n’est PAS un force_update
                        'file' => $request->has('force_update')
                            ? 'nullable'
                            : 'required|mimes:xlsx,xls,csv',
                    ]);
                // 2️⃣ Vérifier si données existent
                $anneeExiste = DB::table('candidats')
                    ->where('anneescolaire_id', $request->anneescolaire_id)
                    ->where('categorie_examen_id', $request->categorie_examen_id)
                    ->where('etablissement_id', $request->etablissement_id)
                    ->where('sexe', $request->sexe)
                    ->exists();


            if ($anneeExiste && !$request->has('force_update'))
            {
                    // 🔹 Sauvegarder les données du formulaire
                    session([
                        'import_data' => [
                            'anneescolaire_id'   => $request->anneescolaire_id,
                            'categorie_examen_id' => $request->categorie_examen_id,
                            'etablissement_id' => $request->etablissement_id,
                            'sexe'    => $request->sexe,
                        ]
                    ]);

                    // 2b. Récupérer résumé des données existantes
                    $donneesExistantes = DB::table('candidats')
                        ->where('anneescolaire_id', $request->anneescolaire_id)
                        ->where('categorie_examen_id', $request->categorie_examen_id)
                        ->where('etablissement_id', $request->etablissement_id)
                        ->where('sexe', $request->sexe)
                        ->select('numero_table','nom')
                        ->get();

                        // 🔹 Sauvegarder le fichier Excel
                    $tmpPath = $request->file('file')->store('tmp');
                    session(['tmp_file' => $tmpPath]);

                    $totalEleves = $donneesExistantes->count();

                    // $message  = __('traduction.annee')   . ' : ' . $request->annee   . "\n";
                    // $message .= __('traduction.exam')  . ' : ' . $request->examen . "\n";
                    // $message .= __('traduction.centre')  . ' : ' . $request->centre . "\n";
                    // $message .= __('traduction.sexe')    . ' : ' . $request->sexe    . "\n";
                    $message  =  __('traduction.nobreleve'). ' : ' .$totalEleves. "\n";
                    $message .= __('traduction.verifiedabord');

                    return back()->with([
                                'confirm_candidat_update' => true,
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

                    $table = 'candidats';
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
                    Schema::create($table, function (Blueprint $table) use ($headings) {
                        $table->id();
                        $table->uuid('public_id')->unique();
                        $table->string('nom', 255);
                        $table->string('sexe',10)->nullable();
                        $table->date('date_naissance')->nullable();
                        $table->string('numero_table', 20)->nullable();
                        $table->foreignId('etablissement_id')->constrained()->cascadeOnDelete();
                        $table->foreignId('anneescolaire_id')->constrained()->onDelete('cascade');
                        $table->foreignId('categorie_examen_id')->constrained('categories_examens')->cascadeOnDelete();
                        $table->unique(['numero_table', 'anneescolaire_id', 'categorie_examen_id'], 'candidat_unique'); // numéro unique par examen + année
                        foreach ($headings as $col) {
                            $table->string(Str::slug($col, '_'))->nullable();
                        }
                        $table->timestamps();
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

                $matricule = $data['numero_table'] ?? null;
                $nom       = $data['Nom'] ?? null;
                foreach ($data as $col => $value) {

                    $column = Str::slug($col, '_');

                    if (!in_array($column, [
                        'numero_table','nom','sexe',
                        'anneescolaire_id','categorie_examen_id','etablissement_id'
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
                $eleveExisteAutreMatricule = DB::table('candidats')
                    ->where('anneescolaire_id', $request->anneescolaire_id)
                    ->where('categorie_examen_id', $request->categorie_examen_id)
                    ->where('etablissement_id', $request->etablissement_id)
                    ->where('sexe', $request->sexe)
                    // ->where('nom', $nom)
                    ->where('numero_table', '<>', $matricule)
                    ->exists();

                if ($eleveExisteAutreMatricule) {
                    $erreurs[] =
                        __('traduction.ligne').' '.$ligne.' '.
                        __('traduction.leleve').' '.$nom.
                        __('traduction.existe');
                }


                // Vérification si un matricule existe avec autre sexe
                $eleveExisteAutreSexe = DB::table('candidats')
                    ->where('numero_table', $matricule)
                    ->where('sexe', '<>', $request->sexe)
                    ->exists();

                if ($eleveExisteAutreSexe) {
                    $erreurs[] =
                        __('traduction.ligne').' '.$ligne.' '.
                        __('traduction.leleve').' '.$nom.' '.
                        __('traduction.existeautresexe');
                }
            }
            if (!empty($erreurs)) {
                return back()->with('import_candidat_errors', $erreurs);
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
                        'anneescolaire_id'   => $request->anneescolaire_id,
                        'categorie_examen_id' => $request->categorie_examen_id,
                        'etablissement_id' => $request->etablissement_id,
                        'sexe'    => $request->sexe,
                    ];
                    $matricule = null;
                    // 2️⃣ Normalisation + récupération matricule
                    foreach ($rowData as $col => $value) {
                        $column = Str::slug($col, '_');
                        if ($column === 'numero_table') {
                            $matricule = $value;
                        }
                        $data[$column] = $value;
                    }
                    // 3️⃣ Sécurité
                    if (!$matricule) {
                        continue;
                    }
                    // 4️⃣ INSERT / UPDATE
                    // DB::table('candidats')->updateOrInsert(
                    //     [
                    //         'numero_table' => $matricule,
                    //         'anneescolaire_id'     => $request->anneescolaire_id,
                    //         'categorie_examen_id'   => $request->categorie_examen_id,
                    //         'etablissement_id'   => $request->etablissement_id,
                    //         'sexe'      => $request->sexe,
                    //     ],
                    //     $data
                    // );

                    $exists = DB::table('candidats')->where([
                        'numero_table' => $matricule,
                        'anneescolaire_id' => $request->anneescolaire_id,
                        'categorie_examen_id' => $request->categorie_examen_id,
                        'etablissement_id' => $request->etablissement_id,
                        'sexe' => $request->sexe,
                    ])->first();

                    if (!$exists) {
                        $data['public_id'] = Str::uuid();
                    }

                    DB::table('candidats')->updateOrInsert(
                        [
                            'numero_table' => $matricule,
                            'anneescolaire_id' => $request->anneescolaire_id,
                            'categorie_examen_id' => $request->categorie_examen_id,
                            'etablissement_id' => $request->etablissement_id,
                            'sexe' => $request->sexe,
                        ],
                        $data
                    );
                                    }

            session()->forget(['import_data', 'tmp_file']);

            return back()->with('success',  __('traduction.importreusi') );

        }
}
