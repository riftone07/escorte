
@can('admin.dashboard')
<a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <span class="nav-icon">
        <i class="bi bi-house"></i>
    </span>
    <span class="nav-text">Dashboard</span>
</a>
@endcan

<!-- Demandes d'escorte Section -->
<div class="nav-section">
    <div class="nav-section-header">
        <span>Demandes d'escorte</span>
    </div>
    @can('admin.escort-requests.index')
    <a href="{{ route('admin.escort-requests.index') }}" class="nav-item {{ request()->routeIs('admin.escort-requests.*') ? 'active' : '' }}">
        <span class="nav-icon">
            <i class="bi bi-shield-check"></i>
        </span>
        <span class="nav-text">Demandes</span>
    </a>
    @endcan
</div>

<!-- Paramètres Section -->
<div class="nav-section derniersection">
    <div class="nav-section-header">
        <span>Paramètres</span>
    </div>
    @can('admin.users.index')
    <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <span class="nav-icon">
            <i class="bi bi-person-gear"></i>
        </span>
        <span class="nav-text">Utilisateurs</span>
    </a>
    @endcan
    @can('admin.roles.index')
    <a href="{{ route('admin.roles.index') }}" class="nav-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
        <span class="nav-icon">
            <i class="bi bi-people"></i>
        </span>
        <span class="nav-text">Rôles</span>
    </a>
    @endcan
    @can('admin.permissions.index')
    <a href="{{ route('admin.permissions.index') }}" class="nav-item {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
        <span class="nav-icon">
            <i class="bi bi-shield-lock"></i>
        </span>
        <span class="nav-text">Permissions</span>
    </a>
    @endcan
    @can('admin.versions.index')
    <a href="{{ route('admin.versions.index') }}" class="nav-item {{ request()->routeIs('admin.versions.*') ? 'active' : '' }}">
        <span class="nav-icon">
            <i class="bi bi-shield-lock"></i>
        </span>
        <span class="nav-text">Versions</span>
    </a>
    @endcan

</div>
