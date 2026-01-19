<?php

namespace App\Http\Controllers;

use App\Models\Temoin;
use Illuminate\View\View;
use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Http\Requests\TemoinRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class TemoinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $temoins = Temoin::paginate();

        return view('temoin.index', compact('temoins'))
            ->with('i', ($request->input('page', 1) - 1) * $temoins->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $temoin = new Temoin();
        $organisations = Organisation::all();

        return view('temoin.create', compact('temoin','organisations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TemoinRequest $request): RedirectResponse
    {
        // Temoin::create($request->validated());

        // return Redirect::route('temoins.index')
        //     ->with('success', 'Temoin created successfully.');

        // Auth::user();

            $request->validated();
            if ($request->hasFile('image')) {
                // Générer un nom unique
                $imageName = time() . '.' . $request->file('image')->extension();
                // Stocker la vidéo avec le Storage Laravel
                $imagePath = $request->file('image')->storeAs('temoin', $imageName, 'public');
            // dd($request->titre,$request->description,$request->anneescolaire_id,$request->image,);
                Temoin::create([
                    'nom_prenom' => $request->nom_prenom,
                    'nom_organe' => $request->nom_organe,
                    'messagear' => $request->messagear,
                    'messagefr' => $request->messagefr,
                    'image' =>  $imagePath,
                    ]);
                    // $ajoutcv_id = $request->ajoutcv_id;
                    return Redirect::route('temoins.index')
                    ->with('success', __('traduction.save_success'));
        }else
            {
                return Redirect::route('temoins.index')->with('error',  __('traduction.erreurphoto'));
            }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        // $temoin = Temoin::find($id);
         $temoin = Temoin::where('public_id',$id)->firstOrFail();

        return view('temoin.show', compact('temoin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $temoin = Temoin::find($id);
        $organisations = Organisation::all();

        return view('temoin.edit', compact('temoin','organisations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TemoinRequest $request, Temoin $temoin): RedirectResponse
    {
        $temoin->update($request->validated());

        return Redirect::route('temoins.index')
            ->with('success', 'Temoin updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        // Temoin::find($id)->delete();

        // return Redirect::route('temoins.index')
        //     ->with('success', 'Temoin deleted successfully');
         $temoin = Temoin::where('public_id',$id)->firstOrFail();

        // Supprimer le fichier physique
        Storage::disk('public')->delete($temoin->image);

        // Supprimer en base
        $temoin->delete();
        return Redirect::route('temoins.index')
            ->with('success',
             __('traduction.delete_success')
       );
    }


    public function temoinsStatus($id)
{
    $temoignage = Temoin::findOrFail($id);
    $temoignage->status = !$temoignage->status;
    $temoignage->save();

    return back()->with('success',__('traduction.statut_mis'));
}
}
