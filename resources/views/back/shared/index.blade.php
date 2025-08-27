@extends('layouts.backend.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
@endpush

@section('content')

<div class="content-card">
<div class="card-header">
    @if(Route::currentRouteName() === 'admin.users.index')
            <h4>Utilisateurs</h4>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Ajouter un utilisateur
            </a>
        @endif
    </div>

    <div class="card ">
        <div class="card-body table-responsive">
         {{ $dataTable->table(['class' => 'table table-bordered table-hover table-sm'], true) }}
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

    @if(config('app.locale') == 'fr')
        <script>
            (($, DataTable) => {
                $.extend(true, DataTable.defaults, {
                    language: {
                        "sEmptyTable":     "Aucune donnée disponible dans le tableau",
                        "sInfo":           "Affichage des éléments _START_ à _END_ sur _TOTAL_ éléments",
                        "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
                        "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
                        "sInfoPostFix":    "",
                        "sInfoThousands":  ",",
                        "sLengthMenu":     "Afficher _MENU_ éléments",
                        "sLoadingRecords": "Chargement...",
                        "sProcessing":     "Traitement...",
                        "sSearch":         "Rechercher :",
                        "sZeroRecords":    "Aucun élément correspondant trouvé",
                        "oPaginate": {
                            "sFirst":    "Premier",
                            "sLast":     "Dernier",
                            "sNext":     "Suivant",
                            "sPrevious": "Précédent"
                        },
                        "oAria": {
                            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                        },
                        "select": {
                            "rows": {
                                "_": "%d lignes sélectionnées",
                                "0": "Aucune ligne sélectionnée",
                                "1": "1 ligne sélectionnée"
                            }
                        }
                    }
                });
            })(jQuery, jQuery.fn.dataTable);
        </script>
    @endif
    {{ $dataTable->scripts() }}

@endpush
