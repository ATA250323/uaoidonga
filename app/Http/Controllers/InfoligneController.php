<?php

namespace App\Http\Controllers;

use App\Models\Infoligne;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InfoligneRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InfoligneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $infolignes = Infoligne::paginate();

        return view('infoligne.index', compact('infolignes'))
            ->with('i', ($request->input('page', 1) - 1) * $infolignes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $infoligne = new Infoligne();

        return view('infoligne.create', compact('infoligne'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InfoligneRequest $request): RedirectResponse
    {
        Infoligne::create($request->validated());

        return Redirect::route('acceuils')->with('success', __('traduction.save_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $infoligne = Infoligne::where('public_id',$id)->firstOrFail();

        return view('infoligne.show', compact('infoligne'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $infoligne = Infoligne::where('public_id',$id)->firstOrFail();

        return view('infoligne.edit', compact('infoligne'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InfoligneRequest $request, Infoligne $infoligne): RedirectResponse
    {
        $infoligne->update($request->validated());

        return Redirect::route('infolignes.index')
            ->with('success', 'Infoligne updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $infoligne = Infoligne::where('public_id',$id)->firstOrFail();

        $infoligne->delete();
        return Redirect::route('infolignes.index')->with('success', __('traduction.delete_success'));
    }
    public function liremessage(Request $request, string $id)
    {
        //  request()->validate([
        //     'id' => 'required|exists:infoligneplateformes,id',
        //         "lire" =>"required",
        //     ]);
         request()->validate([
                "lire" => ["required", "string:1",  "min:1", "max:1", ],
            ]);

            $lire =  Infoligne::findOrFail($id);
            $lire->lire = $request->lire;
            $lire->save();
           return redirect()->route('home')->with('success',
             __('traduction.lirs_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );

    }
}
