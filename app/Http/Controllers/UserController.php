<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\WithBreadcrumb;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use WithBreadcrumb;
    /**
     * Display a listing of the resource.
     */

    public function index(UsersDataTable $dataTable)
    {
        $data = $this->withBreadcrumb([
            'Utilisateurs' => route('admin.users.index')
        ]);
        
        return $dataTable->render('back.shared.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        
        $data = $this->withBreadcrumb([
            'Utilisateurs' => route('admin.users.index'),
            'Créer' => '#'
        ], [
            'roles' => $roles
        ]);
        
        return view('back.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => ['nullable', 'array'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        // Assigner les rôles à l'utilisateur
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        
        $data = $this->withBreadcrumb([
            'Utilisateurs' => route('admin.users.index'),
            'Détails' => '#'
        ], [
            'user' => $user
        ]);
        
        return view('back.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->getRoleNames()->toArray();
        
        $data = $this->withBreadcrumb([
            'Utilisateurs' => route('admin.users.index'),
            'Modifier' => '#'
        ], [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
        
        return view('back.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'roles' => ['nullable', 'array'],
        ];
        
        // Ajouter la validation du mot de passe uniquement s'il est fourni
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }
        
        $request->validate($rules);
        
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        // Mettre à jour les rôles de l'utilisateur
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles([]);
        }
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // Empêcher la suppression de l'utilisateur actuellement connecté
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé avec succès');
    }
}
