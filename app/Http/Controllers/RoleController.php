<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

          $roles = Role::orderBy('id','DESC')->get();

        return view('roles.index', compact('roles'));
    }

    public function create(Request $request)
    {

        $permissions = Permission::where('name', 'not like', 'api.%')->orderBy('name','ASC')->get();
        return view('roles.create', compact('permissions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $role = Role::create([
            'name' => $request->get('name'),
            'guard_name' => 'web'
        ]);
        $role->syncPermissions($request->get('permission'));

        Flash::success(__('Rôle créé avec succès'));

        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        $rolePermissions = $role->permissions;

        return view('roles.show', compact('role', 'rolePermissions'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        $rolePermissions = $role->permissions->pluck('name')->toArray();

        $permissions = Permission::where('name', 'not like', 'api.%')->orderBy('name','ASC')->get();

        return view('roles.edit',compact('role','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->get('permission'));

        Flash::success(__('Rôle mise à jour avec succès'));
        return redirect()->route('admin.roles.index')
            ->with('success','Rôle mis à jour avec succès');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success','Rôle supprimé avec succès');
    }

}
