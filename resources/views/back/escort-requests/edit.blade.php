@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Modifier la demande d'escorte #{{ $escortRequest->numero_demande }}</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.escort-requests.update', $escortRequest) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="row g-4">
                <!-- Statut et traitement -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-gear"></i> Statut et traitement
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="statut" class="form-label">Statut <span class="text-danger">*</span></label>
                                <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                                    <option value="en_attente" {{ old('statut', $escortRequest->statut) === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="en_cours" {{ old('statut', $escortRequest->statut) === 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="approuve" {{ old('statut', $escortRequest->statut) === 'approuve' ? 'selected' : '' }}>Approuvé</option>
                                    <option value="refuse" {{ old('statut', $escortRequest->statut) === 'refuse' ? 'selected' : '' }}>Refusé</option>
                                    <option value="termine" {{ old('statut', $escortRequest->statut) === 'termine' ? 'selected' : '' }}>Terminé</option>
                                </select>
                                @error('statut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="commentaire_admin" class="form-label">Commentaire administrateur</label>
                                <textarea class="form-control @error('commentaire_admin') is-invalid @enderror" 
                                          id="commentaire_admin" name="commentaire_admin" rows="6" 
                                          placeholder="Commentaire interne sur le traitement de la demande...">{{ old('commentaire_admin', $escortRequest->commentaire_admin) }}</textarea>
                                @error('commentaire_admin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    Ce commentaire est visible uniquement par les administrateurs.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations de la demande (lecture seule) -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-info-circle"></i> Informations de la demande
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <strong>Demandeur :</strong><br>
                                    {{ $escortRequest->nom_complet }}<br>
                                    <small class="text-muted">{{ $escortRequest->organisme }} - {{ $escortRequest->fonction }}</small>
                                </div>
                                
                                <div class="col-6 mb-3">
                                    <strong>Type d'escorte :</strong><br>
                                    <span class="badge bg-info">{{ $escortRequest->type_escorte_libelle }}</span>
                                </div>
                                
                                <div class="col-6 mb-3">
                                    <strong>Urgence :</strong><br>
                                    @if($escortRequest->urgence === 'tres_urgent')
                                        <span class="badge bg-danger">{{ $escortRequest->urgence_libelle }}</span>
                                    @elseif($escortRequest->urgence === 'urgent')
                                        <span class="badge bg-warning">{{ $escortRequest->urgence_libelle }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $escortRequest->urgence_libelle }}</span>
                                    @endif
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <strong>Date et heure de mission :</strong><br>
                                    {{ $escortRequest->date_mission->format('d/m/Y à H:i') }}
                                </div>
                                
                                <div class="col-6 mb-3">
                                    <strong>Lieu de départ :</strong><br>
                                    <small>{{ $escortRequest->lieu_depart }}</small>
                                </div>
                                
                                <div class="col-6 mb-3">
                                    <strong>Lieu d'arrivée :</strong><br>
                                    <small>{{ $escortRequest->lieu_arrivee }}</small>
                                </div>
                                
                                <div class="col-12">
                                    <strong>Contact :</strong><br>
                                    <a href="tel:{{ $escortRequest->telephone }}">{{ $escortRequest->telephone }}</a><br>
                                    <a href="mailto:{{ $escortRequest->email }}">{{ $escortRequest->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description complète -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-file-text"></i> Description de la mission
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="bg-light p-3 rounded">
                                {{ $escortRequest->description }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations système -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-clock-history"></i> Historique
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Date de création :</strong><br>
                                    <small class="text-muted">{{ $escortRequest->created_at->format('d/m/Y à H:i') }}</small>
                                </div>
                                
                                @if($escortRequest->date_traitement)
                                <div class="col-md-4">
                                    <strong>Date de traitement :</strong><br>
                                    <small class="text-muted">{{ $escortRequest->date_traitement->format('d/m/Y à H:i') }}</small>
                                </div>
                                @endif

                                <div class="col-md-4">
                                    <strong>Dernière modification :</strong><br>
                                    <small class="text-muted">{{ $escortRequest->updated_at->format('d/m/Y à H:i') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="d-flex justify-content-between mt-4">
                <div>
                    <a href="{{ route('admin.escort-requests.show', $escortRequest) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Enregistrer les modifications
                    </button>
                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $escortRequest->id }})">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cette demande d'escorte ? Cette action est irréversible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(requestId) {
    const form = document.getElementById('deleteForm');
    form.action = `/admin/escort-requests/${requestId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
