@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Modifier le rôle</h4>
    </div>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="name" class="form-label">Nom du rôle</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-4">
            <label class="form-label">Permissions</label>
            
            @if ($permissions->count() > 0)
                <div class="row">
                    @foreach ($permissions as $permission)
                        <div class="col-md-3 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->name }}" id="permission_{{ $permission->id }}"
                                    {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('permission')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            @else
                <div class="alert alert-info">
                    Aucune permission disponible.
                </div>
            @endif
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
