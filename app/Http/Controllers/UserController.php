<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Inscriptionuser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $users = User::all();
        return view("role-permission.user.affiche", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view("role-permission.user.ajout",compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $iduser= Auth::user();
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);

        function generatemotdepasse($longueur =9){
                $caracteres= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$&';
                return substr(str_shuffle(str_repeat($caracteres,ceil($longueur / strlen($caracteres)))), 0, $longueur);
            }

            $motdepassenonhasher = generatemotdepasse(9);
            $motdepassehasher = Hash::make($motdepassenonhasher);

        $user =  User::create([
            "name" => $request->name,
            "email" => $request->email,
            "user_id" => $iduser->id,
            "password" => $motdepassehasher,

        ]);
        $user->syncRoles($request->role);
        // Mail::to($user->email)->send(new Inscriptionuser($user, $motdepassenonhasher));
        // return redirect()->route('users.index')->with('success', __('traduction.save_success'));
         try {
                Mail::to($user->email)->send(new Inscriptionuser($user,  $motdepassenonhasher));
                return redirect()->route('users.index')->with('success', __('traduction.Evoiemail_user'));

            } catch (Exception $e) {
            return redirect()->route('users.index')
                ->with('error', __('traduction.ErreurEvoiemail'));
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::all();
        // récupérer uniquement les noms des rôles
        $userRoles = $user->roles->pluck('name')->toArray();
        return view("role-permission.user.modifie",compact('user','roles','userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

            request()->validate([
                "name" => ["required", "string:2",  "min:2", "max:255"],
                'email' => ['required', 'string', "min:5", "max:255"],
                'role' => ['required']
            ]);

            $user =  User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success',
             __('traduction.save_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('success',
             __('traduction.delete_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );

    }
}
