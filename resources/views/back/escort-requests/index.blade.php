@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Demandes d'escorte</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.escort-requests.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Nouvelle demande
            </a>
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#filtersCollapse">
                <i class="bi bi-funnel"></i> Filtres
            </button>
        </div>
    </div>

    <!-- Filtres -->
    <div class="collapse {{ request()->hasAny(['statut', 'urgence', 'search']) ? 'show' : '' }}" id="filtersCollapse">
        <div class="card-body border-bottom">
            <form method="GET" action="{{ route('admin.escort-requests.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Recherche</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ $filters['search'] ?? '' }}" 
                           placeholder="Numéro, nom, organisme...">
                </div>
                <div class="col-md-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-select" id="statut" name="statut">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente" {{ ($filters['statut'] ?? '') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="en_cours" {{ ($filters['statut'] ?? '') === 'en_cours' ? 'selected' : '' }}>En cours</option>
                        <option value="approuve" {{ ($filters['statut'] ?? '') === 'approuve' ? 'selected' : '' }}>Approuvé</option>
                        <option value="refuse" {{ ($filters['statut'] ?? '') === 'refuse' ? 'selected' : '' }}>Refusé</option>
                        <option value="termine" {{ ($filters['statut'] ?? '') === 'termine' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="urgence" class="form-label">Urgence</label>
                    <select class="form-select" id="urgence" name="urgence">
                        <option value="">Toutes les urgences</option>
                        <option value="normale" {{ ($filters['urgence'] ?? '') === 'normale' ? 'selected' : '' }}>Normale</option>
                        <option value="urgent" {{ ($filters['urgence'] ?? '') === 'urgent' ? 'selected' : '' }}>Urgent</option>
                        <option value="tres_urgent" {{ ($filters['urgence'] ?? '') === 'tres_urgent' ? 'selected' : '' }}>Très urgent</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Filtrer
                    </button>
                    <a href="{{ route('admin.escort-requests.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body p-0">
        @if($escortRequests->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0 table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Numéro</th>
                            <th>Demandeur</th>
                            <th>Type d'escorte</th>
                            <th>Urgence</th>
                            <th>Date mission</th>
                            <th>Statut</th>
                            <th>Date création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($escortRequests as $request)
                        <tr>
                            <td>
                                <strong class="text-primary">{{ $request->numero_demande }}</strong>
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $request->nom_complet }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $request->telephone }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $request->type_escorte_libelle }}</span>
                            </td>
                            <td>
                                @if($request->urgence === 'tres_urgent')
                                    <span class="badge bg-danger">{{ $request->urgence_libelle }}</span>
                                @elseif($request->urgence === 'urgent')
                                    <span class="badge bg-warning">{{ $request->urgence_libelle }}</span>
                                @else
                                    <span class="badge bg-success">{{ $request->urgence_libelle }}</span>
                                @endif
                            </td>
                            <td>{{ $request->date_mission->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($request->statut === 'en_attente')
                                    <span class="badge bg-warning">En attente</span>
                                @elseif($request->statut === 'en_cours')
                                    <span class="badge bg-info">En cours</span>
                                @elseif($request->statut === 'approuve')
                                    <span class="badge bg-success">Approuvé</span>
                                @elseif($request->statut === 'refuse')
                                    <span class="badge bg-danger">Refusé</span>
                                @else
                                    <span class="badge bg-secondary">Terminé</span>
                                @endif
                            </td>
                            <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.escort-requests.show', $request) }}" 
                                       class="btn btn-outline-primary btn-sm" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.escort-requests.pdf', $request) }}" 
                                       class="btn btn-outline-success btn-sm" title="Télécharger PDF">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a>
                                    <a href="{{ route('admin.escort-requests.edit', $request) }}" 
                                       class="btn btn-outline-secondary btn-sm" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm" 
                                            onclick="confirmDelete({{ $request->id }})" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $escortRequests->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-shield-x display-1 text-muted"></i>
                <h5 class="mt-3">Aucune demande d'escorte</h5>
                <p class="text-muted">Aucune demande ne correspond à vos critères de recherche.</p>
            </div>
        @endif
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

// Gestion du changement de statut
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const requestId = this.dataset.requestId;
            const newStatus = this.value;
            const currentStatus = this.dataset.currentStatus;
            
            if (newStatus === currentStatus) return;
            
            fetch(`/admin/escort-requests/${requestId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ statut: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.dataset.currentStatus = newStatus;
                    // Afficher une notification de succès
                    showNotification('Statut mis à jour avec succès', 'success');
                } else {
                    // Remettre l'ancienne valeur
                    this.value = currentStatus;
                    showNotification('Erreur lors de la mise à jour', 'error');
                }
            })
            .catch(error => {
                this.value = currentStatus;
                showNotification('Erreur lors de la mise à jour', 'error');
            });
        });
    });
});

function showNotification(message, type) {
    // Simple notification - vous pouvez utiliser une librairie comme Toastr
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alert = document.createElement('div');
    alert.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
    alert.style.top = '20px';
    alert.style.right = '20px';
    alert.style.zIndex = '9999';
    alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(alert);
    
    setTimeout(() => {
        alert.remove();
    }, 5000);
}
</script>
@endpush
