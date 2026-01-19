<?php

namespace App\Http\Controllers;

use App\Models\Dirigent;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DirigentRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class DirigentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $dirigents = Dirigent::paginate();

        return view('dirigent.index', compact('dirigents'))
            ->with('i', ($request->input('page', 1) - 1) * $dirigents->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $dirigent = new Dirigent();

        return view('dirigent.create', compact('dirigent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DirigentRequest $request): RedirectResponse
    {
        // Dirigent::create($request->validated());

        // return Redirect::route('dirigents.index')
        //     ->with('success', 'Dirigent created successfully.');
        Auth::user();

            $request->validated();

        if ($request->hasFile('image')) {
            if (Dirigent::where('email',$request->email)
                            ->where('nom',$request->nom)->exists()) {

                    return Redirect::route('dirigents.create')
                            ->with('alertMessage',
                            __('traduction.erreur_deja') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
                        );
                    # code...
            }else{
                // Générer un nom unique
                $imageName = time() . '.' . $request->file('image')->extension();

                // Stocker la vidéo avec le Storage Laravel
                $imagePath = $request->file('image')->storeAs('dirigent', $imageName, 'public');
            // dd($request->titre,$request->description,$request->anneescolaire_id,$request->image,);
                Dirigent::create([
                    'nom' => $request->nom,
                    'profession' => $request->profession,
                    'facebook' => $request->facebook,
                    'whatsapp' => $request->whatsapp,
                    'tiweter' => $request->tiweter,
                    'email' => $request->email,
                    'image' =>  $imagePath,
                    ]);
                    // $ajoutcv_id = $request->ajoutcv_id;
                    return Redirect::route('dirigents.index')
                    ->with('success', __('traduction.save_success'));
            }
                }else
                {
                    return Redirect::route('dirigents.index')->with('error',  __('traduction.erreurphoto') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */);
                }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $dirigent = Dirigent::where('public_id',$id)->firstOrFail();

        return view('dirigent.show', compact('dirigent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $dirigent = Dirigent::where('public_id',$id)->firstOrFail();

        return view('dirigent.edit', compact('dirigent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // $dirigent->update($request->validated());
            request()->validate([
    		'nom' => 'string',
			'profession' => 'string',
			'facebook' => 'string',
			'whatsapp' => 'string',
			'tiweter' => 'string',
			'email' => 'string',
			'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048', // max 2MB
            ]);

            $dirigent = Dirigent::find($id);
            // $dirigent = Dirigent::where('public_id',$id)->firstOrFail();

            if ($request->hasFile('image')) {

                // Supprimer le fichier physique
                Storage::disk('public')->delete($dirigent->image);

                // Générer un nom unique
                $imageName = time() . '.' . $request->file('image')->extension();

                // Stocker la vidéo avec le Storage Laravel
                $imagePath = $request->file('image')->storeAs('dirigent', $imageName, 'public');

                    $dirigent->nom = $request->nom;
                    $dirigent->profession = $request->profession;
                    $dirigent->facebook = $request->facebook;
                    $dirigent->whatsapp = $request->whatsapp;
                    $dirigent->tiweter = $request->tiweter;
                    $dirigent->email = $request->email;
                    $dirigent->image = $imagePath;
                    $dirigent->save();

                    return redirect()->route('dirigents.index')->with('succes', __('traduction.update_success') );
                }else{
                    return Redirect::route('dirigents.index')->with('error', __('traduction.erreurphoto') );
                }
    }

    public function destroy($id): RedirectResponse
    {
        // Dirigent::find($id)->delete();

        // return Redirect::route('dirigents.index')
        //     ->with('success', 'Dirigent deleted successfully');

             $dirigent = Dirigent::where('public_id',$id)->firstOrFail();

        // Supprimer le fichier physique
        Storage::disk('public')->delete($dirigent->image);

        // Supprimer en base
        $dirigent->delete();
        return Redirect::route('dirigents.index')
            ->with('success',
             __('traduction.delete_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
    }
}
