<?php

namespace App\Http\Controllers;

use App\Models\Apropo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ApropoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ApropoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $apropos = Apropo::all();
        $apropo = Apropo::first();

        return view('apropo.index', compact('apropos','apropo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $apropo = new Apropo();

        return view('apropo.create', compact('apropo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApropoRequest $request): RedirectResponse
    {
        Apropo::create($request->validated());

        return Redirect::route('apropos.index')
            ->with('success',__('traduction.save_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $apropo = Apropo::find($id);

        return view('apropo.show', compact('apropo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        // $apropo = Apropo::find($id);
        $apropo = Apropo::where('public_id',$id)->firstOrFail();

        return view('apropo.edit', compact('apropo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApropoRequest $request, Apropo $apropo): RedirectResponse
    {
        $apropo->update($request->validated());

        return Redirect::route('apropos.index')
             ->with('success', __('traduction.update_success'));;
    }

    public function destroy($id): RedirectResponse
    {
        Apropo::find($id)->delete();

        return Redirect::route('apropos.index')
             ->with('success', __('traduction.delete_success'));
    }
}
