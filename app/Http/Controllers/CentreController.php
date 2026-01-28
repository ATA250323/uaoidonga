<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use App\Http\Requests\CentreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CentreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $centres = Centre::paginate();

        return view('centre.index', compact('centres'))
            ->with('i', ($request->input('page', 1) - 1) * $centres->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $centre = new Centre();
        $anneescolaires = Anneescolaire::all();

        return view('centre.create', compact('centre','anneescolaires'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(CentreRequest $request): RedirectResponse
{
    $user = Auth::user();

    $data = $request->validated();

    // Vérifier si le centre existe déjà (exemple par nom ou classe)
    if (Centre::where('nomar', $data['nomar'])->exists()) {
        return redirect()
            ->route('centres.create')
            ->with('alertMessage', __('traduction.erreur_deja'));
    }

    // Génération du code unique
    $prefixe = Centre::generateCode('CT');

    Centre::create([
        'nomar'            => $data['nomar'],
        // 'nomfr'            => $data['nomfr'],
        'adresse'          => $data['adresse'],
        // 'email'            => $data['email'],
        // 'telephone'        => $data['telephone'],
        'anneescolaire_id' => $data['anneescolaire_id'],
        'prefixe'             => $prefixe,
    ]);

    return redirect()
        ->route('centres.index')
        ->with('success', __('traduction.save_success'));
}



    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $centre = Centre::find($id);

        return view('centre.show', compact('centre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        // $centre = Centre::find($id);
        $centre = Centre::where('public_id',$id)->firstOrFail();
        $anneescolaires = Anneescolaire::all();

        return view('centre.edit', compact('centre','anneescolaires'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // $centre->update($request->validated());

        // return Redirect::route('centres.index')
        //     ->with('success', 'Centre updated successfully');
         request()->validate([
            'nomar' => 'string',
			// 'nomfr' => 'string',
			'adresse' => 'required|string',
			// 'email' => 'required|string',
			// 'telephone' => 'required|string',
			'anneescolaire_id' => 'required',
            ]);

            $centre =  Centre::findOrFail($id);
            $centre->nomar = $request->nomar;
            // $centre->nomfr = $request->nomfr;
            $centre->adresse = $request->adresse;
            // $centre->email = $request->email;
            // $centre->telephone = $request->telephone;
            $centre->anneescolaire_id = $request->anneescolaire_id;
            $centre->save();
        return Redirect::route('centres.index',)
            ->with('success',
             __('traduction.update_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
    }

    public function destroy($id): RedirectResponse
    {
        // Centre::find($id)->delete();

        // return Redirect::route('centres.index')
        //     ->with('success', 'Centre deleted successfully');

        // Carousel::find($id)->delete();
        $centre = Centre::where('public_id',$id)->firstOrFail();

        // Supprimer en base
        $centre->delete();
        return Redirect::route('centres.index')
            ->with('success', __('traduction.delete_success'));
    }
}
