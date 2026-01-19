<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\User;
use App\Models\Profil;
use App\Mail\Inscription;
use App\Models\Roleetabli;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\Inscriptionuser;
use App\Models\Etablissement;
use App\Models\UserEtablissement;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\MenuRoleEtablissement;
use Illuminate\Support\Facades\Redirect;

//cela permet de créer un membre
class UseretabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index($public_id)
    {
                        // dd($public_id);
                        //id connecter
        $user= Auth::user();

        $today = Carbon::now();

        $etablissement = Etablissement::where('public_id', $public_id)->first();

        $role = $user->roles->first();

        if (!$role) {
            $menus = collect();
        } else {
            $menus = $role->menus()->wherePivot('etablissement_id', $etablissement->id)->get();
        }


        if (Etablissement::where('public_id', $public_id)->whereHas('users.subscriptions', function ($query) {
                $query->where('status', 'active'); // abonnement actif
            })->exists())
        {
                // Trouver l’établissement
                $etablissement = Etablissement::where('public_id', $public_id)->firstOrFail();

                $users = User::where('etablissement_id', $etablissement->id)
                ->with('roles') // Charge les rôles associés
                ->get();

                // Liste des utilisateurs associés à cet établissement
                $etablissementAssocies = UserEtablissement::where('etablissement_id', $etablissement->id)
                                        ->pluck('user_id')
                                        ->toArray();

                return view('useretab.user.affiche', compact('etablissement', 'users', 'etablissementAssocies','public_id','menus',));
        }else{
                return redirect::route('home',$public_id)->with('alertMessage',  __('traduction.no_etablissement') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */);
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($public_id,)
    {
        //
        $user = new User();
        //id connecter
        $user= Auth::user();

        $today = Carbon::now();

        $etablissement = Etablissement::where('public_id', $public_id)->first();

        $role = $user->roles->first();

       if (!$role) {
            $menus = collect();
        } else {
            $menus = $role->menus()
                        ->wherePivot('etablissement_id', $etablissement->id)
                        ->get();
        }


            // Si l'utilisateur connecté est un Administrateur
            if ($user->hasAnyRole(['Administrateur'])) {
                // Il voit tous les rôles sauf le rôle Super-Administrateur,Administrateur
                $roles = Role::whereNotIn('name', ['Super-Administrateur','Administrateur'])->get();
            } else {
                // Autres utilisateurs voient les rôles sauf les rôles Super-Administrateur,Administrateur,Directeur
                $roles = Role::whereNotIn('name', ['Super-Administrateur', 'Administrateur','Directeur'])->get();
            }

            return view("useretab.user.ajout",compact('roles', 'public_id','menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $public_id)
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


            // 🔍 Vérifier que l’établissement existe
            $etablissement = Etablissement::where('public_id', $public_id)->first();

            if (!$etablissement) {
                return redirect()->route('etabusers.create', $public_id)->with('alertMessage', __('traduction.creer_avant'));
            }

            $userexiste = User::where('email', $request->email)
            ->where('etablissement_id', $etablissement->id)
            ->first();

             if (!$userexiste) {

            // $confirmationCode = Str::random(40);
            // creation du code confirmation
             $confirmationCode =  collect(range('A', 'Z'))
                    ->merge(range(0, 9))
                    ->shuffle()
                    ->take(8)
                    ->implode('');

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
                "etablissement_id" => $etablissement->id,
                "user_id" => $iduser->id,
                "password" => $motdepassehasher,
                'confirmation'=> $confirmationCode, // Enregistre le code
            ]);

            $user->syncRoles($request->typecompte);

            // ✅ Enregistrement dans Useretablissement
            UserEtablissement::create([
                'user_id' => $user->id,                // ID de l'utilisateur nouvellement créé
                'etablissement_id' => $etablissement->id, // ID de l'établissement récupéré plus haut
            ]);

            // 🔔 Optionnel : envoi de mail d'inscription
            // $motdepasse = $request->password;
            try {
                Mail::to($user->email)->send(new Inscriptionuser($user, $confirmationCode, $motdepassenonhasher));
                // Message de confirmation pour la redirection
                // session()->flash('success', __('traduction.Evoiemail'));
            return redirect()->route('etabusers.index', $public_id)
                ->with('success', __('traduction.Evoiemail_user'));

            } catch (Exception $e) {
            return redirect()->route('etabusers.index', $public_id)
                ->with('error', __('traduction.ErreurEvoiemail'));
            }
            }else
            {
                return redirect()->route('etabusers.create', $public_id)->with('alertMessage', __('traduction.creer_avant'));
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
    public function edit($public_id, $id)
    {
        //
        $user= Auth::user();

        $today = Carbon::now();

        $etablissement = Etablissement::where('public_id', $public_id)->first();

        $role = $user->roles->first();

      if (!$role) {
            $menus = collect();
        } else {
            $menus = $role->menus()->wherePivot('etablissement_id', $etablissement->id)->get();
        }

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

        return view("useretab.user.modifie",compact('user','userRoles','public_id','menus','roles'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $public_id, $id)
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

        return redirect()->route('etabusers.index', $public_id)->with('success',
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


    public function afficherole($public_id)
    {
        $user= Auth::user();

        $today = Carbon::now();

        // Récupère l’établissement
        $etablissement = Etablissement::where('public_id', $public_id)->first();

        $role = $user->roles->first();

        if (!$role) {
            $menus = collect();
        } else {
            $menus = $role->menus()->wherePivot('etablissement_id', $etablissement->id)->get();
        }


        // Récupère les rôles (sauf Super-Administrateur)
        $roles = Role::whereNotIn('name', ['Super-Administrateur'])->get();

        // Vérifie si l’établissement a un abonnement actif
        $subscription = Subscription::where('user_id', $etablissement->user_id)
            ->where('status', 'active')
            ->with('plan.menus') // <-- On charge directement le plan avec ses menus
            ->first();

        // Si abonnement valide, on récupère les menus liés au plan
        if ($subscription && $subscription->plan) {
            $menues = $subscription->plan->menus;
        } else {
            $menues = collect(); // pas d’abonnement => aucun menu
        }
        // Relations existantes entre menus/rôles/établissement
        $menuRoleEtablissements = MenuRoleEtablissement::where('etablissement_id', $etablissement->id)->get();

        // dd($subscription,$menus);
        return view('useretab.user.afficherole', compact('roles','public_id' ,'menues','menus','menuRoleEtablissements','etablissement'));
    }
}
