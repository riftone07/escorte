@extends('layouts.backend.app')

@section('content')
<div class="row g-4">
    <!-- Statistiques principales -->
    <div class="col-12">
        <div class="row g-3">
            <!-- Total des demandes -->
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">{{ $totalRequests }}</h3>
                                <p class="mb-0">Demandes</p>
                            </div>
                            <i class="bi bi-shield-check fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En attente -->
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">{{ $pendingRequests }}</h3>
                                <p class="mb-0">En attente</p>
                            </div>
                            <i class="bi bi-clock fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En cours -->
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">{{ $inProgressRequests }}</h3>
                                <p class="mb-0">En cours</p>
                            </div>
                            <i class="bi bi-arrow-repeat fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approuvées -->
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">{{ $approvedRequests }}</h3>
                                <p class="mb-0">Approuvées</p>
                            </div>
                            <i class="bi bi-check-circle fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Terminées -->
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">{{ $completedRequests }}</h3>
                                <p class="mb-0">Terminées</p>
                            </div>
                            <i class="bi bi-check-square fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Urgentes -->
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">{{ $urgentRequests }}</h3>
                                <p class="mb-0">Urgentes</p>
                            </div>
                            <i class="bi bi-exclamation-triangle fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques et statistiques -->
    <div class="col-lg-8">
        <div class="row g-4">
            <!-- Évolution mensuelle -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-graph-up"></i> Évolution des demandes (6 derniers mois)
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            <!-- Répartition par type -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-pie-chart"></i> Par type d'escorte
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="typeChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Répartition par urgence -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-speedometer2"></i> Par urgence
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="urgencyChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar avec informations -->
    <div class="col-lg-4">
        <div class="row g-4">
            <!-- Statistiques du mois -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-calendar-month"></i> Ce mois-ci
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span>Nouvelles demandes</span>
                            <span class="badge bg-primary fs-6">{{ $monthlyRequests }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span>Approuvées</span>
                            <span class="badge bg-success fs-6">{{ $monthlyApproved }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Taux d'approbation</span>
                            <span class="badge bg-info fs-6">
                                {{ $monthlyRequests > 0 ? round(($monthlyApproved / $monthlyRequests) * 100) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Demandes récentes -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-clock-history"></i> Demandes récentes
                        </h5>
                        <a href="{{ route('admin.escort-requests.index') }}" class="btn btn-outline-primary btn-sm">
                            Voir tout
                        </a>
                    </div>
                    <div class="card-body p-0">
                        @if($recentRequests->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($recentRequests as $request)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $request->numero_demande }}</h6>
                                            <p class="mb-1 text-muted small">{{ $request->nom_complet }}</p>
                                            <small class="text-muted">{{ $request->created_at->diffForHumans() }}</small>
                                        </div>
                                        <span class="badge bg-{{ $request->statut === 'en_attente' ? 'warning' : ($request->statut === 'approuve' ? 'success' : 'secondary') }}">
                                            {{ $request->statut_libelle }}
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-inbox text-muted fs-1"></i>
                                <p class="text-muted mt-2">Aucune demande récente</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Prochaines missions -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-calendar-event"></i> Prochaines missions
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @if($upcomingMissions->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($upcomingMissions as $mission)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $mission->numero_demande }}</h6>
                                            <p class="mb-1 text-muted small">{{ $mission->nom_complet }}</p>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar"></i> {{ $mission->date_mission->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                        <span class="badge bg-{{ $mission->urgence === 'tres_urgent' ? 'danger' : ($mission->urgence === 'urgent' ? 'warning' : 'success') }}">
                                            {{ $mission->urgence_libelle }}
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-calendar-x text-muted fs-1"></i>
                                <p class="text-muted mt-2">Aucune mission programmée</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning"></i> Actions rapides
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('admin.escort-requests.create') }}" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Nouvelle demande
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.escort-requests.index', ['statut' => 'en_attente']) }}" class="btn btn-warning w-100">
                            <i class="bi bi-clock"></i> Demandes en attente
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.escort-requests.index', ['urgence' => 'tres_urgent']) }}" class="btn btn-danger w-100">
                            <i class="bi bi-exclamation-triangle"></i> Demandes urgentes
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.escort-requests.index') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-list"></i> Toutes les demandes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique d'évolution mensuelle
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(collect($monthlyEvolution)->pluck('month')) !!},
            datasets: [{
                label: 'Demandes',
                data: {!! json_encode(collect($monthlyEvolution)->pluck('count')) !!},
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graphique par type d'escorte
    const typeCtx = document.getElementById('typeChart').getContext('2d');
    const typeLabels = {
        'personnalite': 'Personnalité',
        'transport_fonds': 'Transport de fonds',
        'transport_detenus': 'Transport de détenus',
        'mission_speciale': 'Mission spéciale'
    };
    
    new Chart(typeCtx, {
        type: 'doughnut',
        data: {
            labels: Object.keys({!! json_encode($requestsByType) !!}).map(key => typeLabels[key] || key),
            datasets: [{
                data: Object.values({!! json_encode($requestsByType) !!}),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Graphique par urgence
    const urgencyCtx = document.getElementById('urgencyChart').getContext('2d');
    const urgencyLabels = {
        'normale': 'Normale',
        'urgent': 'Urgent',
        'tres_urgent': 'Très urgent'
    };
    
    new Chart(urgencyCtx, {
        type: 'doughnut',
        data: {
            labels: Object.keys({!! json_encode($requestsByUrgency) !!}).map(key => urgencyLabels[key] || key),
            datasets: [{
                data: Object.values({!! json_encode($requestsByUrgency) !!}),
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(220, 53, 69, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
</script>
@endpush