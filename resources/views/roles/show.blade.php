@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Détails du rôle</h4>
        <div>
            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <th style="width: 30%">ID</th>
                    <td>{{ $role->id }}</td>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td>{{ $role->name }}</td>
                </tr>
                <tr>
                    <th>Guard</th>
                    <td>{{ $role->guard_name }}</td>
                </tr>
                <tr>
                    <th>Créé le</th>
                    <td>{{ $role->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Modifié le</th>
                    <td>{{ $role->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <h5>Permissions</h5>
        
        @if($rolePermissions->count() > 0)
            <div class="row">
                @foreach($rolePermissions as $permission)
                    <div class="col-md-3 mb-2">
                        <span class="badge bg-info">{{ $permission->name }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                Ce rôle n'a aucune permission.
            </div>
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection
