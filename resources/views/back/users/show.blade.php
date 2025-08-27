@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Détails de l'utilisateur</h4>
        <div>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
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
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Email vérifié</th>
                    <td>{{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y H:i') : 'Non vérifié' }}</td>
                </tr>
                <tr>
                    <th>Créé le</th>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Modifié le</th>
                    <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <h5>Rôles</h5>
        
        @if($user->roles->count() > 0)
            <div class="row">
                @foreach($user->roles as $role)
                    <div class="col-md-3 mb-2">
                        <span class="badge bg-info">{{ $role->name }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                Cet utilisateur n'a aucun rôle assigné.
            </div>
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection
