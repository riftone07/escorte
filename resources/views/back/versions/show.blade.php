@extends('layouts.backend.app')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h4>Informations de version</h4>
        <div>
            <a href="{{ route('admin.versions.edit') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <form action="{{ route('admin.versions.destroy') }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette version ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">iOS (App Store)</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 40%">Numéro de version</th>
                            <td>{{ $version->numero_appstore }}</td>
                        </tr>
                        <tr>
                            <th>URL</th>
                            <td><a href="{{ $version->url_appstore }}" target="_blank">{{ $version->url_appstore }}</a></td>
                        </tr>
                        <tr>
                            <th>Titre</th>
                            <td>{{ $version->titre_appstore ?: 'Non défini' }}</td>
                        </tr>
                        <tr>
                            <th>Motif</th>
                            <td>{{ $version->motif_appstore ?: 'Non défini' }}</td>
                        </tr>
                        <tr>
                            <th>Mise à jour obligatoire</th>
                            <td>
                                @if($version->obligatoire_appstore)
                                    <span class="badge bg-danger">Oui</span>
                                @else
                                    <span class="badge bg-success">Non</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Android (Play Store)</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 40%">Numéro de version</th>
                            <td>{{ $version->numero_playstore }}</td>
                        </tr>
                        <tr>
                            <th>URL</th>
                            <td><a href="{{ $version->url_playstore }}" target="_blank">{{ $version->url_playstore }}</a></td>
                        </tr>
                        <tr>
                            <th>Titre</th>
                            <td>{{ $version->titre_playstore ?: 'Non défini' }}</td>
                        </tr>
                        <tr>
                            <th>Motif</th>
                            <td>{{ $version->motif_playstore ?: 'Non défini' }}</td>
                        </tr>
                        <tr>
                            <th>Mise à jour obligatoire</th>
                            <td>
                                @if($version->obligatoire_playstore)
                                    <span class="badge bg-danger">Oui</span>
                                @else
                                    <span class="badge bg-success">Non</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h5><i class="bi bi-info-circle"></i> Information</h5>
                <p>Cette page affiche les informations de version actuellement configurées pour vos applications mobiles. Ces informations sont utilisées par les applications pour vérifier si une mise à jour est disponible.</p>
            </div>
        </div>
    </div>
</div>
@endsection
