@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Demande d'escorte #{{ $escortRequest->numero_demande }}</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.escort-requests.pdf', $escortRequest) }}" class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-pdf"></i> Télécharger PDF
            </a>
            <a href="{{ route('admin.escort-requests.edit', $escortRequest) }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $escortRequest->id }})">
                <i class="bi bi-trash"></i> Supprimer
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <!-- Informations générales -->
            <div class="col-lg-8">
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
                                        <strong>Nom complet :</strong><br>
                                        {{ $escortRequest->nom_complet }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Téléphone :</strong><br>
                                        <a href="tel:{{ $escortRequest->telephone }}">{{ $escortRequest->telephone }}</a>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Email :</strong><br>
                                        <a href="mailto:{{ $escortRequest->email }}">{{ $escortRequest->email }}</a>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Organisme :</strong><br>
                                        {{ $escortRequest->organisme }}
                                    </div>
                                    <div class="col-12 mt-3">
                                        <strong>Fonction :</strong><br>
                                        {{ $escortRequest->fonction }}
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
                                        <strong>Type d'escorte :</strong><br>
                                        <span class="badge bg-info">{{ $escortRequest->type_escorte_libelle }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Urgence :</strong><br>
                                        @if($escortRequest->urgence === 'tres_urgent')
                                            <span class="badge bg-danger">{{ $escortRequest->urgence_libelle }}</span>
                                        @elseif($escortRequest->urgence === 'urgent')
                                            <span class="badge bg-warning">{{ $escortRequest->urgence_libelle }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $escortRequest->urgence_libelle }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Date et heure :</strong><br>
                                        {{ $escortRequest->date_mission->format('d/m/Y à H:i') }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Nombre de personnes :</strong><br>
                                        {{ $escortRequest->nombre_personnes }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Lieu de départ :</strong><br>
                                        {{ $escortRequest->lieu_depart }}
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <strong>Lieu d'arrivée :</strong><br>
                                        {{ $escortRequest->lieu_arrivee }}
                                    </div>
                                    <div class="col-12 mt-3">
                                        <strong>Description :</strong><br>
                                        <div class="bg-light p-3 rounded">
                                            {{ $escortRequest->description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personne à contacter -->
                    @if($escortRequest->contact_nom)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-person-lines-fill"></i> Personne à contacter
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Nom :</strong><br>
                                        {{ $escortRequest->contact_nom }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Téléphone :</strong><br>
                                        <a href="tel:{{ $escortRequest->contact_telephone }}">{{ $escortRequest->contact_telephone }}</a>
                                    </div>
                                    @if($escortRequest->contact_email)
                                    <div class="col-md-6 mt-3">
                                        <strong>Email :</strong><br>
                                        <a href="mailto:{{ $escortRequest->contact_email }}">{{ $escortRequest->contact_email }}</a>
                                    </div>
                                    @endif
                                    @if($escortRequest->contact_fonction)
                                    <div class="col-md-6 mt-3">
                                        <strong>Fonction :</strong><br>
                                        {{ $escortRequest->contact_fonction }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Document -->
                    @if($escortRequest->document_path)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-file-earmark-text"></i> Document joint
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-earmark-pdf fs-2 text-danger me-3"></i>
                                    <div>
                                        <strong>Document officiel</strong><br>
                                        <small class="text-muted">Téléchargé le {{ $escortRequest->created_at->format('d/m/Y à H:i') }}</small>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="{{ route('admin.escort-requests.download', $escortRequest) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-download"></i> Télécharger
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar avec statut et actions -->
            <div class="col-lg-4">
                <div class="row g-4">
                    <!-- Statut et traitement -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-gear"></i> Statut et traitement
                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.escort-requests.update', $escortRequest) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <div class="mb-3">
                                        <label for="statut" class="form-label">Statut</label>
                                        <select class="form-select" id="statut" name="statut" required>
                                            <option value="en_attente" {{ $escortRequest->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                            <option value="en_cours" {{ $escortRequest->statut === 'en_cours' ? 'selected' : '' }}>En cours</option>
                                            <option value="approuve" {{ $escortRequest->statut === 'approuve' ? 'selected' : '' }}>Approuvé</option>
                                            <option value="refuse" {{ $escortRequest->statut === 'refuse' ? 'selected' : '' }}>Refusé</option>
                                            <option value="termine" {{ $escortRequest->statut === 'termine' ? 'selected' : '' }}>Terminé</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="commentaire_admin" class="form-label">Commentaire administrateur</label>
                                        <textarea class="form-control" id="commentaire_admin" name="commentaire_admin" 
                                                  rows="4" placeholder="Commentaire interne...">{{ $escortRequest->commentaire_admin }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-check-circle"></i> Mettre à jour
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Informations système -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-info-circle"></i> Informations système
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>Date de création :</strong><br>
                                    <small class="text-muted">{{ $escortRequest->created_at->format('d/m/Y à H:i') }}</small>
                                </div>
                                
                                @if($escortRequest->date_traitement)
                                <div class="mb-3">
                                    <strong>Date de traitement :</strong><br>
                                    <small class="text-muted">{{ $escortRequest->date_traitement->format('d/m/Y à H:i') }}</small>
                                </div>
                                @endif

                                <div class="mb-0">
                                    <strong>Dernière modification :</strong><br>
                                    <small class="text-muted">{{ $escortRequest->updated_at->format('d/m/Y à H:i') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
