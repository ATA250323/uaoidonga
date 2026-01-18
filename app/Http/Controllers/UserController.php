<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\Inscription;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $roles = Role::pluck( "name","name")->all();
        return view("role-permission.user.ajout",compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required']
        ]);

        $user =  User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password"=> Hash::make($request->password)

        ]);
        $user->syncRoles($request->roles);
        $motdepasse =  $request->password;
        Mail::to($user->email)->send(new Inscription($user, $motdepasse));
        return redirect()->route('users.index')->with('message', 'Admin a été ajouté avec succès');

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
        $roles = Role::pluck( "name","name")->all();
        $userRoles = $user->roles->pluck( "name","name")->all();
        return view("role-permission.user.modifie",compact('user','roles','userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

            request()->validate([
                "name" => ["required", "string:2",  "min:2", "max:255", "unique:users,name,$id"],
                'email' => ['required', 'string', "min:5", "max:255"],
                'password' => ['required', 'string', "min:5", "max:255"],
                'roles' => ['required']
            ]);

            $user =  User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            $user->syncRoles($request->roles);

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
