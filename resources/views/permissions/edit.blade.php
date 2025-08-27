@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Modifier la permission</h4>
    </div>

    <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="name" class="form-label">Nom de la permission</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $permission->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
