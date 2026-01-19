<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EtablissementRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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

        return view('etablissement.create', compact('etablissement'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EtablissementRequest $request): RedirectResponse
    {
        Etablissement::create($request->validated());

        return Redirect::route('etablissements.index')
            ->with('success', 'Etablissement created successfully.');
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
        $etablissement = Etablissement::find($id);

        return view('etablissement.edit', compact('etablissement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EtablissementRequest $request, Etablissement $etablissement): RedirectResponse
    {
        $etablissement->update($request->validated());

        return Redirect::route('etablissements.index')
            ->with('success', 'Etablissement updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Etablissement::find($id)->delete();

        return Redirect::route('etablissements.index')
            ->with('success', 'Etablissement deleted successfully');
    }
}
