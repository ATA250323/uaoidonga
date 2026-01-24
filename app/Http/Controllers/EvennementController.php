<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Evennement;
use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EvennementRequest;
use Illuminate\Support\Facades\Redirect;

class EvennementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $evennements = Evennement::paginate();

        return view('evennement.index', compact('evennements'))
            ->with('i', ($request->input('page', 1) - 1) * $evennements->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $evennement = new Evennement();
        $organisations = Organisation::all();
        $anneescolaires = Anneescolaire::all();

        return view('evennement.create', compact('evennement','organisations','anneescolaires'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvennementRequest $request): RedirectResponse
    {
        // Evennement::create($request->validated());

        // return Redirect::route('evennements.index')
        //     ->with('success', 'Evennement created successfully.');
         Auth::user();

            $request->validated();

        if ($request->hasFile('image')) {
            if (Evennement::where('anneescolaire_id',$request->anneescolaire_id)
                            ->where('organisation_id',$request->organisation_id)->exists()) {

                    return Redirect::route('evennements.create')
                            ->with('alertMessage',
                            __('traduction.erreur_deja') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
                        );
                    # code...
            }else{
                // Générer un nom unique
                $imageName = time() . '.' . $request->file('image')->extension();

                // Stocker la vidéo avec le Storage Laravel
                $imagePath = $request->file('image')->storeAs('evennement', $imageName, 'public');
            // dd($request->titre,$request->description,$request->anneescolaire_id,$request->image,);
                Evennement::create([
                    'titrear' => $request->titrear,
                    'organisation_id' => $request->organisation_id,
                    'anneescolaire_id' => $request->anneescolaire_id,
                    'image' =>  $imagePath,
                    ]);
                    // $ajoutcv_id = $request->ajoutcv_id;
                    return Redirect::route('evennements.index')
                    ->with('success', __('traduction.save_success'));
            }
                }else
                {
                    return Redirect::route('evennements.index')->with('error',  __('traduction.erreurphoto') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */);
                }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $evennement = Evennement::find($id);
        $organisations = Organisation::all();
        $anneescolaires = Anneescolaire::all();

        return view('evennement.show', compact('evennement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $evennement = Evennement::where('public_id',$id)->firstOrFail();
        $organisations = Organisation::all();
        $anneescolaires = Anneescolaire::all();

        return view('evennement.edit', compact('evennement','organisations','anneescolaires'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvennementRequest $request, $id): RedirectResponse
    {
        // $evennement->update($request->validated());

        // return Redirect::route('evennements.index')
        //     ->with('success',__('traduction.update_success'));

        $request->validated();

            $evennement = Evennement::where('public_id',$id)->firstOrFail();
            if ($request->hasFile('image')) {

                // Supprimer le fichier physique
                Storage::disk('public')->delete($evennement->image);

                // Générer un nom unique
                $imageName = time() . '.' . $request->file('image')->extension();

                // Stocker la vidéo avec le Storage Laravel
                $imagePath = $request->file('image')->storeAs('evennement', $imageName, 'public');

                    $evennement->titrear = $request->titrear;
                    $evennement->organisation_id = $request->organisation_id;
                    $evennement->anneescolaire_id = $request->anneescolaire_id;
                    $evennement->image = $imagePath;
                    $evennement->save();
                    return redirect()->route('evennements.index')->with('succes', __('traduction.update_success') );
                }else{
                            return Redirect::route('evennements.index')
                    ->with('error', __('traduction.erreurphoto') );
                }
    }

    public function destroy($id): RedirectResponse
    {
        // Evennement::find($id)->delete();

        // return Redirect::route('evennements.index')
        //     ->with('success', 'Evennement deleted successfully');
        $evennement = Evennement::where('public_id',$id)->firstOrFail();

        // Supprimer le fichier physique
        Storage::disk('public')->delete($evennement->image);

        // Supprimer en base
        $evennement->delete();
        return Redirect::route('evennements.index')
            ->with('success',
             __('traduction.delete_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
    }
}
