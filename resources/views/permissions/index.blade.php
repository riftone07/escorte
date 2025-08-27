@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Gestion des permissions</h4>
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Ajouter une permission
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Guard</th>
                    <th width="150" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-primary" title="Éditer">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette permission ?');">
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
