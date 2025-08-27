@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Gestion des rôles</h4>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Ajouter un rôle
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Permissions</th>
                    <th width="150" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @if($role->permissions->count() > 0)
                            <span class="badge bg-info">{{ $role->permissions->count() }} permissions</span>
                        @else
                            <span class="badge bg-secondary">Aucune permission</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-sm btn-info" title="Voir">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary" title="Éditer">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
