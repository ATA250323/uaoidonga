<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EtablissementRequest;

class EtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $etablissements = Etablissement::paginate();

        return view('etablissement.index', compact('etablissements'))
            ->with('i', ($request->input('page', 1) - 1) * $etablissements->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $etablissement = new Etablissement();
        $anneescolaires = Anneescolaire::all();
        $centres = Centre::all();

        return view('etablissement.create', compact('etablissement','centres','anneescolaires'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(EtablissementRequest $request): RedirectResponse
    // {
    //     Etablissement::create($request->validated());

    //     return Redirect::route('etablissements.index')
    //         ->with('success', 'Etablissement created successfully.');
    // }

        public function store(EtablissementRequest $request): RedirectResponse
{
    $user = Auth::user();

    $data = $request->validated();

    // Vérifier si le centre existe déjà (exemple par nom ou classe)
    if (Etablissement::where('nomarabe', $data['nomarabe'])->exists()) {
        return redirect()
            ->route('etablissements.create')
            ->with('alertMessage', __('traduction.erreur_deja'));
    }

    // Génération du code unique
    $prefixe = Etablissement::generateCode('ET');

    Etablissement::create([
        'nomarabe'            => $data['nomarabe'],
        'nomfrancais'            => $data['nomfrancais'],
        'adresse'          => $data['adresse'],
        'email'            => $data['email'],
        'telephone'        => $data['telephone'],
        'anneescolaire_id' => $data['anneescolaire_id'],
        'centre_id' => $data['centre_id'],
        'prefixe'             => $prefixe,
    ]);

    return redirect()
        ->route('etablissements.index')
        ->with('success', __('traduction.save_success'));
}
    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $etablissement = Etablissement::find($id);

        return view('etablissement.show', compact('etablissement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        // $etablissement = Etablissement::find($id);
        $etablissement = Etablissement::where('public_id',$id)->firstOrFail();
        $anneescolaires = Anneescolaire::all();
        $centres = Centre::all();

        return view('etablissement.edit', compact('etablissement','anneescolaires','centres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // $etablissement->update($request->validated());

        // return Redirect::route('etablissements.index')
        //     ->with('success', 'Etablissement updated successfully');
        request()->validate([
            'nomarabe' => 'required|string',
			'nomfrancais' => 'required|string',
			'adresse' => 'required|string',
			'email' => 'required|string',
			'telephone' => 'required|string',
			'centre_id' => 'required',
			'anneescolaire_id' => 'required|string',
            ]);

            $etablissement =  Etablissement::findOrFail($id);
            $etablissement->nomarabe = $request->nomarabe;
            $etablissement->nomfrancais = $request->nomfrancais;
            $etablissement->adresse = $request->adresse;
            $etablissement->email = $request->email;
            $etablissement->telephone = $request->telephone;
            $etablissement->centre_id = $request->centre_id;
            $etablissement->anneescolaire_id = $request->anneescolaire_id;
            $etablissement->save();
        return Redirect::route('etablissements.index',)
            ->with('success',
             __('traduction.update_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
    }

    public function destroy($id): RedirectResponse
    {
        // Etablissement::find($id)->delete();

        // return Redirect::route('etablissements.index')
        //     ->with('success', 'Etablissement deleted successfully');
        $etablissement = Etablissement::where('public_id',$id)->firstOrFail();

        // Supprimer en base
        $etablissement->delete();
        return Redirect::route('etablissements.index')
            ->with('success', __('traduction.delete_success'));
    }
}
