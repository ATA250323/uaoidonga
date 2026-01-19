<?php

namespace App\Http\Controllers;

use App\Models\Anneescolaire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AnneescolaireRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AnneescolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $anneescolaires = Anneescolaire::paginate();

        return view('anneescolaire.index', compact('anneescolaires'))
            ->with('i', ($request->input('page', 1) - 1) * $anneescolaires->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $anneescolaire = new Anneescolaire();

        return view('anneescolaire.create', compact('anneescolaire'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnneescolaireRequest $request): RedirectResponse
    {
                if (Anneescolaire::where('anneefr',$request->anneefr)->exists()) {
                    return Redirect::route('anneescolaires.create')
                            ->with('alertMessage',
                            __('traduction.erreur_deja') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
                        );
                    # code...
                }else{
                    Anneescolaire::create($request->validated());

                    return Redirect::route('anneescolaires.index')
                        ->with('success', __('traduction.save_success'));
                }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $anneescolaire = Anneescolaire::find($id);

        return view('anneescolaire.show', compact('anneescolaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $anneescolaire = Anneescolaire::where('public_id',$id)->firstOrFail();

        return view('anneescolaire.edit', compact('anneescolaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnneescolaireRequest $request, Anneescolaire $anneescolaire): RedirectResponse
    {
        $anneescolaire->update($request->validated());

        return Redirect::route('anneescolaires.index')->with('success', __('traduction.update_success'));
    }

    public function destroy($id): RedirectResponse
    {
        Anneescolaire::find($id)->delete();

        return Redirect::route('anneescolaires.index')->with('success', __('traduction.delete_success'));
    }
}
