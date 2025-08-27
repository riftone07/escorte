@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Créer une version</h4>
    </div>

    <form action="{{ route('admin.versions.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">iOS (App Store)</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="numero_appstore" class="form-label">Numéro de version</label>
                            <input type="number" class="form-control @error('numero_appstore') is-invalid @enderror" id="numero_appstore" name="numero_appstore" value="{{ old('numero_appstore', 1) }}" min="1" required>
                            @error('numero_appstore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="url_appstore" class="form-label">URL</label>
                            <input type="url" class="form-control @error('url_appstore') is-invalid @enderror" id="url_appstore" name="url_appstore" value="{{ old('url_appstore') }}" required>
                            @error('url_appstore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="titre_appstore" class="form-label">Titre (optionnel)</label>
                            <input type="text" class="form-control @error('titre_appstore') is-invalid @enderror" id="titre_appstore" name="titre_appstore" value="{{ old('titre_appstore') }}">
                            @error('titre_appstore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="motif_appstore" class="form-label">Motif de mise à jour (optionnel)</label>
                            <textarea class="form-control @error('motif_appstore') is-invalid @enderror" id="motif_appstore" name="motif_appstore" rows="3">{{ old('motif_appstore') }}</textarea>
                            @error('motif_appstore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="obligatoire_appstore" name="obligatoire_appstore" value="1" {{ old('obligatoire_appstore') ? 'checked' : '' }}>
                            <label class="form-check-label" for="obligatoire_appstore">
                                Mise à jour obligatoire
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Android (Play Store)</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="numero_playstore" class="form-label">Numéro de version</label>
                            <input type="number" class="form-control @error('numero_playstore') is-invalid @enderror" id="numero_playstore" name="numero_playstore" value="{{ old('numero_playstore', 1) }}" min="1" required>
                            @error('numero_playstore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="url_playstore" class="form-label">URL</label>
                            <input type="url" class="form-control @error('url_playstore') is-invalid @enderror" id="url_playstore" name="url_playstore" value="{{ old('url_playstore') }}" required>
                            @error('url_playstore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="titre_playstore" class="form-label">Titre (optionnel)</label>
                            <input type="text" class="form-control @error('titre_playstore') is-invalid @enderror" id="titre_playstore" name="titre_playstore" value="{{ old('titre_playstore') }}">
                            @error('titre_playstore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="motif_playstore" class="form-label">Motif de mise à jour (optionnel)</label>
                            <textarea class="form-control @error('motif_playstore') is-invalid @enderror" id="motif_playstore" name="motif_playstore" rows="3">{{ old('motif_playstore') }}</textarea>
                            @error('motif_playstore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="obligatoire_playstore" name="obligatoire_playstore" value="1" {{ old('obligatoire_playstore') ? 'checked' : '' }}>
                            <label class="form-check-label" for="obligatoire_playstore">
                                Mise à jour obligatoire
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.versions.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
