<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $permissions = Permission::all();
        return view("role-permission.permission.affiche", compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("role-permission.permission.ajout");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            "name" => ["required", "string:2",  "min:2", "max:255", "unique:permissions,name"]
        ]);
    if (Permission::where('name',$request->name)->exists()) {
                return Redirect::route('permissions.index')
                        ->with('alertMessage',
                        __('traduction.erreur_deja') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
                    );
                # code...
    }else{
        Permission::create([
                "name" => $request->name,
                'public_id' => Str::uuid(),
            ]);
        return redirect()->route('permissions.index')->with('success',
             __('traduction.save_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
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

        $permission = Permission::where('public_id',$id)->firstOrFail();
        return view('role-permission.permission.modifie', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        request()->validate([
            "name" => ["required", "string:2",  "min:2", "max:255"]
        ]);

        if (Permission::where('name',$request->name)
                ->where('id','!=', $id)->exists()) {
                return Redirect::route('permissions.index')
                        ->with('alertMessage',
                        __('traduction.erreur_deja') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
                    );
                # code...
        }else{
        $permission =  Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')->with('success',
             __('traduction.update_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $permission = Permission::findOrFail($id);

        $permission->delete();

        return redirect()->route('permissions.index')->with('message', 'La permission a été supprimée avec succès');

    }
}
