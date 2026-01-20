<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\InscriptionRequest;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $inscriptions = Inscription::paginate();

        return view('inscription.index', compact('inscriptions'))
            ->with('i', ($request->input('page', 1) - 1) * $inscriptions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $anneepasse   = date('Y') -1; // année en cours
        $anneeencours   = date('Y'); // année en cours
        $annee = $anneepasse.' - '.$anneeencours;
// dd($anneepasse ,$anneeencours ,$annee);
        $inscription = new Inscription();

        $etablissements = Etablissement::all();
        $anneexiste = Anneescolaire::where('anneefr',$annee)->first();

        return view('inscription.create', compact('inscription','etablissements','anneexiste'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InscriptionRequest $request): RedirectResponse
    {
        // Inscription::create($request->validated());

        // return Redirect::route('inscriptions.index')
        //     ->with('success', 'Inscription created successfully.');
        Auth::user();

            $request->validated();

        if ($request->hasFile('image')) {
            if (Inscription::where('anneescolaire_id',$request->anneescolaire_id)
                            ->where('matricule',$request->matricule)->exists()) {

                    return Redirect::route('inscriptions.create')
                            ->with('alertMessage',
                            __('traduction.erreur_deja') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
                        );
                    # code...
            }else{
                // Générer un nom unique
                $imageName = time() . '.' . $request->file('image')->extension();
                // Stocker la vidéo avec le Storage Laravel
                $imagePath = $request->file('image')->storeAs('inscription', $imageName, 'public');
            // dd($request->titre,$request->description,$request->anneescolaire_id,$request->image,);
               Inscription::create([
                    'matricule' => $request->matricule,
                    'nom' => $request->nom,
                    'sexe' => $request->sexe,
                    'niveau' => $request->niveau,
                    'etablissement_id' => $request->etablissement_id,
                    'anneescolaire_id' => $request->anneescolaire_id,
                    'image' =>  $imagePath,
                    ]);
                    // $ajoutcv_id = $request->ajoutcv_id;
                    return Redirect::route('inscriptions.index')
                    ->with('success', __('traduction.save_success'));
            }
                }else
                {
                    return Redirect::route('inscriptions.index')->with('error',  __('traduction.erreurphoto') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */);
                }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $inscription = Inscription::find($id);

        return view('inscription.show', compact('inscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $inscription = Inscription::find($id);

        return view('inscription.edit', compact('inscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InscriptionRequest $request, Inscription $inscription): RedirectResponse
    {
        $inscription->update($request->validated());

        return Redirect::route('inscriptions.index')
            ->with('success', 'Inscription updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Inscription::find($id)->delete();

        return Redirect::route('inscriptions.index')
            ->with('success', 'Inscription deleted successfully');
    }
}
