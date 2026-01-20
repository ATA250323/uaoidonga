<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\UserEtablissement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UserEtablissementRequest;

class UserEtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $userEtablissements = UserEtablissement::paginate();

        return view('user-etablissement.index', compact('userEtablissements'))
            ->with('i', ($request->input('page', 1) - 1) * $userEtablissements->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $userEtablissement = new UserEtablissement();

        return view('user-etablissement.create', compact('userEtablissement'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserEtablissementRequest $request): RedirectResponse
    {
        // UserEtablissement::create($request->validated());

        // return Redirect::route('user-etablissements.index')
        //     ->with('success', 'UserEtablissement created successfully.');

                $request->validate([
                    'user_id' => 'required|exists:users,id',
                    'etablissement_id' => 'required|exists:etablissements,id',
                ]);
                if ($request->user_id === Auth::user()->id) {
                    return back()->with('error', 'Vous ne pouvez pas vous désassocier vous-même.');
                }

                $existing = UserEtablissement::where('user_id', $request->user_id)
                    ->where('etablissement_id', $request->etablissement_id)
                    ->first();

                if ($existing) {
                    $existing->delete();
                    return back()->with('success', 'Utilisateur désassocié avec succès.');
                } else {
                    UserEtablissement::create([
                        'user_id' => $request->user_id,
                        'etablissement_id' => $request->etablissement_id,
                    ]);
                    return back()->with('success', 'Utilisateur associé avec succès.');
                }
    }

    public function etablissementAssociation(Request $request): RedirectResponse
    {
        // UserEtablissement::create($request->validated());

        // return Redirect::route('user-etablissements.index')
        //     ->with('success', 'UserEtablissement created successfully.');
                $request->validate([
                    'user_id' => 'required|exists:users,id',
                    'etablissement_id' => 'required|exists:etablissements,id',
                ]);

                // dd($request->user_id,$request->etablissement_id);

                if ($request->user_id === Auth::user()->id) {
                    return back()->with('error', 'Vous ne pouvez pas vous désassocier vous-même.');
                }

                $existing = UserEtablissement::where('user_id', $request->user_id)
                    ->where('etablissement_id', $request->etablissement_id)
                    ->first();

                if ($existing) {
                    $existing->delete();
                    return back()->with('success', 'Utilisateur désassocié avec succès.');
                } else {
                    UserEtablissement::create([
                        'user_id' => $request->user_id,
                        'etablissement_id' => $request->etablissement_id,
                    ]);
                    return back()->with('success', 'Utilisateur associé avec succès.');
                }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $userEtablissement = UserEtablissement::find($id);

        return view('user-etablissement.show', compact('userEtablissement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $userEtablissement = UserEtablissement::find($id);

        return view('user-etablissement.edit', compact('userEtablissement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserEtablissementRequest $request, UserEtablissement $userEtablissement): RedirectResponse
    {
        $userEtablissement->update($request->validated());

        return Redirect::route('user-etablissements.index')
            ->with('success', 'UserEtablissement updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        UserEtablissement::find($id)->delete();

        return Redirect::route('user-etablissements.index')
            ->with('success', 'UserEtablissement deleted successfully');
    }
}
