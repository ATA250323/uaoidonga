<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\OrganisationRequest;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $organisations = Organisation::paginate();

        return view('organisation.index', compact('organisations'))
            ->with('i', ($request->input('page', 1) - 1) * $organisations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $organisation = new Organisation();
        $anneescolaires = Anneescolaire::all();

        return view('organisation.create', compact('organisation','anneescolaires'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganisationRequest $request): RedirectResponse
    {
        // Organisation::create($request->validated());

        // return Redirect::route('organisations.index')
        //     ->with('success', 'Organisation created successfully.');
         Auth::user();

            $request->validated();

            if ($request->hasFile('image')) {
                // Générer un nom unique
                $imageName = time() . '.' . $request->file('image')->extension();

                // Stocker la vidéo avec le Storage Laravel
                $imagePath = $request->file('image')->storeAs('organisation', $imageName, 'public');
                
            // dd($request->titre,$request->description,$request->anneescolaire_id,$request->image,);
                Organisation::create([
                    'titre' => $request->titre,
                    'description' => $request->description,
                    'anneescolaire_id' => $request->anneescolaire_id,
                    'image' =>  $imagePath,
                    ]);
                    // $ajoutcv_id = $request->ajoutcv_id;
                    return Redirect::route('organisations.index')
                    ->with('success', __('traduction.save_success'));
            }else
            {
                return Redirect::route('organisations.index')->with('error',  __('traduction.erreurphoto') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $organisation = Organisation::find($id);

        return view('organisation.show', compact('organisation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $organisation = Organisation::find($id);

        return view('organisation.edit', compact('organisation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganisationRequest $request, Organisation $organisation): RedirectResponse
    {
        $organisation->update($request->validated());

        return Redirect::route('organisations.index')
            ->with('success', 'Organisation updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $organisation = Organisation::where('public_id',$id)->firstOrFail();

        // Supprimer le fichier physique
        Storage::disk('public')->delete($organisation->image);

        // Supprimer en base
        $organisation->delete();
        return Redirect::route('organisations.index')
            ->with('success',
             __('traduction.delete_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
    }
}
