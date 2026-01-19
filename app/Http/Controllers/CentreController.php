<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CentreRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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

        return view('centre.create', compact('centre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CentreRequest $request): RedirectResponse
    {
        Centre::create($request->validated());

        return Redirect::route('centres.index')
            ->with('success', 'Centre created successfully.');
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
        $centre = Centre::find($id);

        return view('centre.edit', compact('centre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CentreRequest $request, Centre $centre): RedirectResponse
    {
        $centre->update($request->validated());

        return Redirect::route('centres.index')
            ->with('success', 'Centre updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Centre::find($id)->delete();

        return Redirect::route('centres.index')
            ->with('success', 'Centre deleted successfully');
    }
}
