<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profil;
use App\Models\Infoligne;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\ProfilRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        $profils = Profil::paginate();

        $totalMessages = Infoligne::where('lire',0)->count();
        $infolignes = Infoligne::where('lire',0)->orderBy('created_at', 'desc')->get();

        $comptesuers = User::where('id',$user->id)->first();

        $profilsuersconets = Profil::where('user_id',$user->id)->first();

        return view('profil.index', compact(
            'profils',
            'comptesuers',
                        'totalMessages',
                        'infolignes',
                        'profilsuersconets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $profil = new Profil();

        return view('profil.create', compact('profil'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(ProfilRequest $request): RedirectResponse
    {
        $request->validated();
       if ($request->hasFile('image')) {
        // Générer un nom unique
        $imageName = time() . '.' . $request->file('image')->extension();

        // Stocker la vidéo avec le Storage Laravel
        $imagePath = $request->file('image')->storeAs('profiluser', $imageName, 'public');

         Profil::create([
			'image' =>  $imagePath,
            'user_id' => Auth::user()->id,
            ]);
            return Redirect::route('home')->with('success',__('traduction.save_success'));
        }else
        {
            return Redirect::route('home')->with('alertMessage', __('traduction.erreur_surve'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $profil = Profil::find($id);

        return view('profil.show', compact('profil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $profil = Profil::find($id);

        return view('profil.edit', compact('profil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfilRequest $request, Profil $profil): RedirectResponse
    {
        $profil->update($request->validated());

        return Redirect::route('profils.index')
            ->with('success', 'Profil updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Profil::find($id)->delete();

        return Redirect::route('profils.index')
            ->with('success', 'Profil deleted successfully');
    }


      public function affichage()
    {
        //
       $user = Auth::user();

        $comptesuers = User::where('id',$user->id)->first();

        $profilsuersconets = Profil::where('user_id',$user->id)->first();
        return view("compteuser/affiche",compact(
        'comptesuers',
        'profilsuersconets','etablissements'));
    }

}
