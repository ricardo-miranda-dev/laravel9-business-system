<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('role.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);
        try {
            DB::beginTransaction();
            
            $rol = Role::create(['name' => $request->name]);
            $rol->syncPermissions($request->permission);
            
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
        }

        return redirect()->route('roles.index')->with('success','Rol registrado exitosamente');
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
    public function edit(Role $role)
    {
        $permisos = Permission::all();
        return view('role.edit', compact('role','permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'permission' => 'required'
        ]);
        
        try {
            DB::beginTransaction();
            
                Role::where('id',$role->id)
                    ->update([
                        'name' => $request->name
                    ]);
            
            $role->syncPermissions($request->permission);
            
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
        }

        return redirect()->route('roles.index')->with('success','Rol editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::where('id',$id)->delete();
        return redirect()->route('roles.index')->with('success','Rol eliminado exitosamente');
    }
}
