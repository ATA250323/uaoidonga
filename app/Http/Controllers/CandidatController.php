<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Candidat;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\CategoriesExamen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CandidatRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\CentreEtablissementExamen;

class CandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $candidats = Candidat::paginate();

        return view('candidat.index', compact('candidats'))
            ->with('i', ($request->input('page', 1) - 1) * $candidats->perPage());
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
                        'prenom' => $request->prenom,
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
}
