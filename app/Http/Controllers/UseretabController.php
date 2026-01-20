<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\Inscriptionuser;
use App\Models\Etablissement;
use App\Models\UserEtablissement;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

//cela permet de créer un membre
class UseretabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
                        // dd($public_id);
                        //id connecter
        $user= Auth::user();

        $etablissements = Etablissement::all();
        $users = User::whereNotNull('user_id')->with(['roles', 'etablissements'])->get();
        $user = $users->isNotEmpty();
                // Liste des utilisateurs associés à cet établissement
        $etablissementAssocies = UserEtablissement::all()->pluck('user_id')->toArray();
        return view('useretab.user.affiche', compact('etablissementAssocies','users','user','etablissements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = new User();
        //id connecter
        $user= Auth::user();
        $etablissements = Etablissement::all();

        $role = $user->roles->first();

            // Si l'utilisateur connecté est un Administrateur
            if ($user->hasAnyRole(['Administrateur'])) {
                // Il voit tous les rôles sauf le rôle Super-Administrateur,Administrateur
                $roles = Role::whereNotIn('name', ['Super-Administrateur','Administrateur'])->get();
            } else {
                // Autres utilisateurs voient les rôles sauf les rôles Super-Administrateur,Administrateur,Directeur
                $roles = Role::whereNotIn('name', ['Super-Administrateur', 'Administrateur','Directeur'])->get();
            }

            return view("useretab.user.ajout",compact('roles','etablissements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
             //id connecter
        $iduser= Auth::user();

            $request->validate([
                'nom' => ['required', 'string', 'min:3', 'max:12'],
                'email' => ['required', 'string', 'email', 'max:255'],
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            ], [
                'nom.required' => __('traduction.aremplir'),
                'email.required' => __('traduction.aremplir'),
                // 'password.required' => __('traduction.aremplir'),
            ]);


            if (User::where('email', $request->email)->exists()) {
                return back()->with('alertMessage', __('traduction.erreur_deja'));
            }
            // $userexiste = User::where('email', $request->email)->first();

            function generatemotdepasse($longueur =9){
                $caracteres= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$&';
                return substr(str_shuffle(str_repeat($caracteres,ceil($longueur / strlen($caracteres)))), 0, $longueur);
            }

            $motdepassenonhasher = generatemotdepasse(9);
            $motdepassehasher = Hash::make($motdepassenonhasher);

            // ✅ Création du nouvel utilisateur
            $user = User::create([
                "name" => $request->nom,
                "email" => $request->email,
                "user_id" => $iduser->id,
                "password" => $motdepassehasher,
            ]);

            $user->syncRoles($request->typecompte);

            // ✅ Enregistrement dans Useretablissement
            UserEtablissement::create([
                'user_id' => $user->id,                // ID de l'utilisateur nouvellement créé
                'etablissement_id' => $request->etablissement_id, // ID de l'établissement récupéré plus haut
            ]);

            // 🔔 Optionnel : envoi de mail d'inscription
            // $motdepasse = $request->password;
            try {
                Mail::to($user->email)->send(new Inscriptionuser($user,  $motdepassenonhasher));
                return redirect()->route('etabusers.index')->with('success', __('traduction.Evoiemail_user'));

            } catch (Exception $e) {
            return redirect()->route('etabusers.index')
                ->with('error', __('traduction.ErreurEvoiemail'));
            }
        }

    /**
     * Display the specified resource.
     */
    public function show($public_id, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $user= Auth::user();

        $role = $user->roles->first();

        $user = User::where('public_id',$id)->firstOrFail();
        // $roles = Role::pluck( "name","name")->all();
        $userRoles = $user->roles->pluck( "name","name")->all();

            // Si l'utilisateur connecté est un Administrateur
            if ($user->hasAnyRole(['Administrateur'])) {
                // Il voit tous les rôles sauf le rôle Super-Administrateur,Administrateur
                $roles = Role::whereNotIn('name', ['Super-Administrateur','Administrateur'])->get();
            } else {
                // Autres utilisateurs voient les rôles sauf les rôles Super-Administrateur,Administrateur,Directeur
                $roles = Role::whereNotIn('name', ['Super-Administrateur', 'Administrateur','Directeur'])->get();
            }

        return view("useretab.user.modifie",compact('user','userRoles','roles'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

            request()->validate([
                'name' => ['required', 'string', 'min:12', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);

            $user =  User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $user->syncRoles($request->typecompte);

        return redirect()->route('etabusers.index')->with('success',
             __('traduction.save_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($public_id, $id)
    {
        //
       $user = User::where('public_id',$id)->firstOrFail();

        // Supprimer en base
        $user->delete();
        return redirect()->route('etabusers.index',$public_id)->with('success',
             __('traduction.delete_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );

    }

}
