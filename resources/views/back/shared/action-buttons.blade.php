<div class="btn-group" role="group">
    <a href="{{ $showUrl }}" class="btn btn-sm btn-info" title="Voir">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ $editUrl }}" class="btn btn-sm btn-primary" title="Éditer">
        <i class="bi bi-pencil"></i>
    </a>
    <form action="{{ $deleteUrl }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>
