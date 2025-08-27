@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Créer une permission</h4>
    </div>

    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf
        
        <div class="form-group mb-3">
            <label for="name" class="form-label">Nom de la permission</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
