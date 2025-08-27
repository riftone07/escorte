@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Créer un utilisateur</h4>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>
        </div>
        
        <div class="form-group mt-3">
            <label class="form-label">Rôles</label>
            <div class="row">
                @foreach ($roles as $role)
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}">
                            <label class="form-check-label" for="role_{{ $role->id }}">
                                {{ $role->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('roles')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
