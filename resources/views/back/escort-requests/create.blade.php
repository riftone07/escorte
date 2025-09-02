@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Nouvelle demande d'escorte</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.escort-requests.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Informations du demandeur -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-person-circle"></i> Informations du demandeur
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                               id="nom" name="nom" value="{{ old('nom') }}" required>
                                        @error('nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                               id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                                        @error('prenom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                                               id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                                        @error('telephone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="organisme" class="form-label">Organisme <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('organisme') is-invalid @enderror" 
                                               id="organisme" name="organisme" value="{{ old('organisme') }}" required>
                                        @error('organisme')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fonction" class="form-label">Fonction <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('fonction') is-invalid @enderror" 
                                               id="fonction" name="fonction" value="{{ old('fonction') }}" required>
                                        @error('fonction')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="adresse" class="form-label">Adresse</label>
                                        <textarea class="form-control @error('adresse') is-invalid @enderror" 
                                                  id="adresse" name="adresse" rows="2">{{ old('adresse') }}</textarea>
                                        @error('adresse')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails de la mission -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-shield-check"></i> Détails de la mission
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="type_escorte" class="form-label">Type d'escorte <span class="text-danger">*</span></label>
                                        <select class="form-select @error('type_escorte') is-invalid @enderror" 
                                                id="type_escorte" name="type_escorte" required>
                                            <option value="">Sélectionner un type</option>
                                            <option value="personnalite" {{ old('type_escorte') === 'personnalite' ? 'selected' : '' }}>Escorte de personnalité</option>
                                            <option value="transport_fonds" {{ old('type_escorte') === 'transport_fonds' ? 'selected' : '' }}>Transport de fonds</option>
                                            <option value="transport_detenus" {{ old('type_escorte') === 'transport_detenus' ? 'selected' : '' }}>Transport de détenus</option>
                                            <option value="mission_speciale" {{ old('type_escorte') === 'mission_speciale' ? 'selected' : '' }}>Mission spéciale</option>
                                        </select>
                                        @error('type_escorte')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="urgence" class="form-label">Urgence <span class="text-danger">*</span></label>
                                        <select class="form-select @error('urgence') is-invalid @enderror" 
                                                id="urgence" name="urgence" required>
                                            <option value="">Sélectionner l'urgence</option>
                                            <option value="normale" {{ old('urgence') === 'normale' ? 'selected' : '' }}>Normale</option>
                                            <option value="urgent" {{ old('urgence') === 'urgent' ? 'selected' : '' }}>Urgent</option>
                                            <option value="tres_urgent" {{ old('urgence') === 'tres_urgent' ? 'selected' : '' }}>Très urgent</option>
                                        </select>
                                        @error('urgence')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_mission" class="form-label">Date et heure de mission <span class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control @error('date_mission') is-invalid @enderror" 
                                               id="date_mission" name="date_mission" value="{{ old('date_mission') }}" required>
                                        @error('date_mission')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombre_personnes" class="form-label">Nombre de personnes <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('nombre_personnes') is-invalid @enderror" 
                                               id="nombre_personnes" name="nombre_personnes" value="{{ old('nombre_personnes', 1) }}" 
                                               min="1" max="50" required>
                                        @error('nombre_personnes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="duree_estimee" class="form-label">Durée estimée (heures)</label>
                                        <input type="number" class="form-control @error('duree_estimee') is-invalid @enderror" 
                                               id="duree_estimee" name="duree_estimee" value="{{ old('duree_estimee') }}" 
                                               min="0.5" max="24" step="0.5">
                                        @error('duree_estimee')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                       
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lieu_depart" class="form-label">Lieu de départ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('lieu_depart') is-invalid @enderror" 
                                               id="lieu_depart" name="lieu_depart" value="{{ old('lieu_depart') }}" required>
                                        @error('lieu_depart')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lieu_arrivee" class="form-label">Lieu d'arrivée <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('lieu_arrivee') is-invalid @enderror" 
                                               id="lieu_arrivee" name="lieu_arrivee" value="{{ old('lieu_arrivee') }}" required>
                                        @error('lieu_arrivee')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description de la mission <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personne à contacter -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-person-lines-fill"></i> Personne à contacter (optionnel)
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_nom" class="form-label">Nom</label>
                                        <input type="text" class="form-control @error('contact_nom') is-invalid @enderror" 
                                               id="contact_nom" name="contact_nom" value="{{ old('contact_nom') }}">
                                        @error('contact_nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_telephone" class="form-label">Téléphone</label>
                                        <input type="tel" class="form-control @error('contact_telephone') is-invalid @enderror" 
                                               id="contact_telephone" name="contact_telephone" value="{{ old('contact_telephone') }}">
                                        @error('contact_telephone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                               id="contact_email" name="contact_email" value="{{ old('contact_email') }}">
                                        @error('contact_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_fonction" class="form-label">Fonction</label>
                                        <input type="text" class="form-control @error('contact_fonction') is-invalid @enderror" 
                                               id="contact_fonction" name="contact_fonction" value="{{ old('contact_fonction') }}">
                                        @error('contact_fonction')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Document et statut -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-file-earmark-text"></i> Document joint
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="document" class="form-label">Document officiel</label>
                                <input type="file" class="form-control @error('document') is-invalid @enderror" 
                                       id="document" name="document" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                @error('document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    Formats acceptés : PDF, DOC, DOCX, JPG, JPEG, PNG (max 5MB)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statut et commentaire admin -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-gear"></i> Statut et traitement
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="statut" class="form-label">Statut initial</label>
                                <select class="form-select @error('statut') is-invalid @enderror" 
                                        id="statut" name="statut">
                                    <option value="en_attente" {{ old('statut', 'en_attente') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="en_cours" {{ old('statut') === 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="approuve" {{ old('statut') === 'approuve' ? 'selected' : '' }}>Approuvé</option>
                                    <option value="refuse" {{ old('statut') === 'refuse' ? 'selected' : '' }}>Refusé</option>
                                    <option value="termine" {{ old('statut') === 'termine' ? 'selected' : '' }}>Terminé</option>
                                </select>
                                @error('statut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="commentaire_admin" class="form-label">Commentaire administrateur</label>
                                <textarea class="form-control @error('commentaire_admin') is-invalid @enderror" 
                                          id="commentaire_admin" name="commentaire_admin" rows="3">{{ old('commentaire_admin') }}</textarea>
                                @error('commentaire_admin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="d-flex justify-content-between mt-4">
                <div>
                    <a href="{{ route('admin.escort-requests.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour à la liste
                    </a>
                </div>
                <div class="d-flex gap-2">
                    <button type="reset" class="btn btn-outline-warning">
                        <i class="bi bi-arrow-clockwise"></i> Réinitialiser
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Créer la demande
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Définir la date minimum à maintenant
    const dateInput = document.getElementById('date_mission');
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    dateInput.min = now.toISOString().slice(0, 16);
});
</script>
@endpush
