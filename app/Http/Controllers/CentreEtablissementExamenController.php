<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\CategoriesExamen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\CentreEtablissementExamen;
use App\Http\Requests\CentreEtablissementExamenRequest;

class CentreEtablissementExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $centreEtablissementExamens = CentreEtablissementExamen::paginate();

        return view('centre-etablissement-examen.index', compact('centreEtablissementExamens'))
            ->with('i', ($request->input('page', 1) - 1) * $centreEtablissementExamens->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $centreEtablissementExamen = new CentreEtablissementExamen();
        $examens = CategoriesExamen::all();
        $centres = Centre::all();
        $etablissements = Etablissement::all();
        $anneescolaires = Anneescolaire::all();

        return view('centre-etablissement-examen.create', compact('centreEtablissementExamen','examens','etablissements','centres','anneescolaires'));
    }

    /**
     * Store a newly created resource in storage.
     */

    //  public function store(Request $request)
    // {
    //     $request->validate([
    //         'etablissement_id' => 'required',
    //         'categorie_examen_id' => 'required',
    //         'centre_id' => 'required',
    //     ]);

    //     CentreEtablissementExamen::updateOrCreate(
    //         [
    //             'etablissement_id' => $request->etablissement_id,
    //             'categorie_examen_id' => $request->categorie_examen_id,
    //         ],
    //         [
    //             'centre_id' => $request->centre_id
    //         ]
    //     );

    //     return redirect()->route('centre-etablissement-examens.index')
    //         ->with('success', __('traduction.save_success'));
    // }
    public function store(Request $request)
        {
            $request->validate([
                'etablissement_id'     => 'required',
                'categorie_examen_id'  => 'required',
                'centre_id'            => 'required',
                'anneescolaire_id'     => 'nullable|exists:anneescolaires,id',
            ]);

            $existe = CentreEtablissementExamen::where([
                'etablissement_id'     => $request->etablissement_id,
                'categorie_examen_id'  => $request->categorie_examen_id,
                'anneescolaire_id'     => $request->anneescolaire_id,
            ])->exists();

            if ($existe) {
                return back()->with(
                    'alertMessage',
                    "Un centre d’examen existe déjà pour cet établissement, cette catégorie et cette année scolaire."
                );
            }

            CentreEtablissementExamen::create([
                'etablissement_id'     => $request->etablissement_id,
                'categorie_examen_id'  => $request->categorie_examen_id,
                'anneescolaire_id'     => $request->anneescolaire_id,
                'centre_id'            => $request->centre_id,
            ]);

            return redirect()->route('centre-etablissement-examens.index')
                ->with('success', __('traduction.save_success'));
        }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $centreEtablissementExamen = CentreEtablissementExamen::find($id);

        return view('centre-etablissement-examen.show', compact('centreEtablissementExamen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        // $centreEtablissementExamen = CentreEtablissementExamen::find($id);
        $centreEtablissementExamen = CentreEtablissementExamen::where('public_id',$id)->firstOrFail();
        $examens = CategoriesExamen::all();
        $centres = Centre::all();
        $etablissements = Etablissement::all();
        $anneescolaires = Anneescolaire::all();

        return view('centre-etablissement-examen.edit', compact('centreEtablissementExamen','examens','etablissements','centres','anneescolaires'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id): RedirectResponse
    {
        // $centreEtablissementExamen->update($request->validated());


            $centreEtablissementExamen =  CentreEtablissementExamen::findOrFail($id);

        request()->validate([
           'centre_id' => 'required',
			'etablissement_id' => 'required',
			'categorie_examen_id' => 'required',
			'anneescolaire_id' => 'required',
            ]);

            // Vérifie si une autre ligne existe avec les mêmes paramètres
                $existe = CentreEtablissementExamen::where([
                    'etablissement_id'    => $request->etablissement_id,
                    'categorie_examen_id' => $request->categorie_examen_id,
                    'anneescolaire_id'    => $request->anneescolaire_id,
                ])->where('id', '<>', $id) // Ignore la ligne en cours
                ->exists();

            if ($existe) {
                return back()->with(
                    'alertMessage',
                    "Un centre d’examen existe déjà pour cet établissement, cette catégorie et cette année scolaire."
                );
            }

            $centreEtablissementExamen->etablissement_id = $request->etablissement_id;
            $centreEtablissementExamen->anneescolaire_id = $request->anneescolaire_id;
            $centreEtablissementExamen->categorie_examen_id = $request->categorie_examen_id;
            $centreEtablissementExamen->centre_id = $request->centre_id;
            $centreEtablissementExamen->save();

        return Redirect::route(route: 'centre-etablissement-examens.index',)
            ->with('success',
             __('traduction.update_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
    }

    public function destroy($id): RedirectResponse
    {
        // CentreEtablissementExamen::find($id)->delete();

        // return Redirect::route('centre-etablissement-examens.index')
        //     ->with('success', 'CentreEtablissementExamen deleted successfully');

        $centreEtablissementExamen = CentreEtablissementExamen::where('public_id',$id)->firstOrFail();

        // Supprimer en base
        $centreEtablissementExamen->delete();
        return Redirect::route('centre-etablissement-examens.index')
            ->with('success', __('traduction.delete_success'));
    }
}
