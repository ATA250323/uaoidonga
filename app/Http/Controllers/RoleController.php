<?php

namespace App\Http\Controllers;
use App\Models\Roleetabli;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $roles = Role::all();

        return view("role-permission.roles.affiche", compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("role-permission.roles.ajout");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            "name" => ["required", "string:2",  "min:2", "max:255"]
        ]);

        // $permission = new Role();
        // $permission->name = $request->name;
        // $permission->save();
            // Transaction : si l'un échoue, tout s'annule
        if (Role::where('name',$request->name)->exists()) {

                return Redirect::route('roles.create')
                        ->with('alertMessage',
                        __('traduction.erreur_deja') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
                    );
                # code...
        }else{
                $role = Role::create([
                "name" => $request->name,
                'public_id' => Str::uuid(),
            ]);

            }

        return redirect()->route('roles.index')->with('success',
             __('traduction.save_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $permissions = Permission::get();
        $roles = Role::where('public_id',$id)->firstOrFail();
        return view('role-permission.roles.ajout-permission', compact('roles','permissions'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //

        $role = Role::where('public_id',$id)->firstOrFail();
        return view('role-permission.roles.modifie', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        request()->validate([
            "name" => ["required", "string:2",  "min:2", "max:255"]
        ]);

         if (Role::where('name',$request->name)
                ->where('id','!=', $id)->exists()) {
                return Redirect::route('roles.index')
                        ->with('alertMessage',
                        __('traduction.erreur_deja') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
                    );
                # code...
        }else{
        $role =  Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        return redirect()->route('roles.index')->with('success',
             __('traduction.update_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
     }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('roles.index') ->with('success',
             __('traduction.delete_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
    }


    public function permisroles($id)
    {
        //
        $permissions = Permission::get();
        $roles = Role::where('public_id',$id)->firstOrFail();
        $rloePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $roles->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();

        return view('role-permission.roles.ajout-permission', compact('roles','permissions','rloePermissions'));

    }
    public function dontpermirole(Request $request,$roleId)
    { $request->validate([
        'permission'=>'required'
    ]);
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('message','Permission ajouter a role');
    }
  }
