<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            min-height: 100vh;
            position: relative;
        }

        .sidebar {
            width: 240px;
            background-color: #fff;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            z-index: 1030;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        /* Ouverture automatique au survol en mode desktop */
        @media (min-width: 992px) {
            .sidebar.collapsed:hover {
                width: 240px;
            }
            
            .sidebar.collapsed:hover .logo-text,
            .sidebar.collapsed:hover .nav-section-header,
            .sidebar.collapsed:hover .nav-text,
            .sidebar.collapsed:hover .user-name {
                display: block;
                opacity: 1;
            }
            
            .sidebar.collapsed:hover .nav-item {
                justify-content: flex-start;
                padding: 4px 8px;
            }
            
            .sidebar.collapsed:hover .nav-icon {
                margin-right: 10px;
                font-size: 0.9rem;
            }
            
            .sidebar.collapsed:hover .user-profile {
                width: 240px;
                justify-content: flex-start;
            }
            
            .sidebar.collapsed:hover .logo {
                justify-content: flex-start;
            }
            
            .sidebar.collapsed:hover .logo-icon {
                margin-right: 10px;
            }
            
            .main-content.expanded {
                transition-delay: 0.1s;
            }
        }
        
        .sidebar.collapsed {
            width: 70px;
        }
        
        .sidebar.collapsed .logo-text,
        .sidebar.collapsed .nav-section-header,
        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .user-name {
            display: none;
        }
        
        .sidebar.collapsed .logo {
            justify-content: center;
        }
        
        .sidebar.collapsed .logo-icon {
            margin-right: 0;
        }
        
        .sidebar.collapsed .nav-item {
            justify-content: center;
            padding: 8px;
            margin-bottom: 8px;
        }
        
        .sidebar.collapsed .nav-icon {
            margin-right: 0;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .sidebar.collapsed .section-label {
            text-align: center;
            font-size: 0.7rem;
        }
        
        .sidebar.collapsed .user-profile {
            justify-content: center;
            width: 70px;
        }

        .main-content {
            margin-left: 240px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        
        .main-content.expanded {
            margin-left: 70px;
        }
        
        .sidebar-collapse-btn {
            width: 24px;
            height: 24px;
            background-color: #f8f9fa;
            border: 1px solid #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-left: auto;
            font-size: 0.8rem;
        }

        .navbar-mobile {
            display: none;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1020;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #212529;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1025;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding-top: 70px;
            }

            .navbar-mobile {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .overlay.show {
                display: block;
            }

            .user-profile {
                width: 230px;
            }
        }

        .logo-container {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
        }

        .logo {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background-color: #000;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .icon-laravel {
            color: white;
            font-size: 1.2rem;
        }

        .nav-section {
            padding: 12px 15px;
            overflow-y: auto;
            flex-grow: 1;
            padding-bottom: 10px;
        }
        .derniersection
        {
            padding-bottom: 100px;
        }

        .nav-section-header {
            font-size: 0.75rem;
            color: #6c757d;
            margin-bottom: 8px;
            margin-top: 12px;
        }
        
        .section-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 6px;
            color: #6c757d;
            text-decoration: none;
            margin-bottom: 4px;
            font-size: 0.85rem;
        }

        .nav-item:hover {
            background-color: #f8f9fa;
            color: #212529;
        }

        .nav-item.active {
            background-color: #f8f9fa;
            color: #212529;
        }

        .nav-icon {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .user-profile {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 240px;
            background-color: #fff;
            border-top: 1px solid #f1f1f1;
            z-index: 10;
            font-size: 0.85rem;
            cursor: pointer;
        }
        
        .user-profile-content {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            position: relative;
        }
        
        .dropdown-toggle {
            margin-left: auto;
            font-size: 0.7rem;
            color: #6c757d;
            transition: transform 0.2s;
        }
        
        .user-profile.open .dropdown-toggle {
            transform: rotate(180deg);
        }
        
        .user-dropdown {
            display: none;
            background-color: #fff;
            border-top: 1px solid #f1f1f1;
            padding: 8px 0;
            position: absolute;
            bottom: 100%;
            left: 0;
            width: 100%;
            box-shadow: 0 -4px 6px rgba(0,0,0,0.05);
        }
        
        .user-profile.open .user-dropdown {
            display: block;
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            color: #495057;
            text-decoration: none;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        .sidebar.collapsed .dropdown-toggle,
        .sidebar.collapsed .dropdown-text {
            display: none;
        }
        
        .sidebar.collapsed .user-dropdown {
            width: 200px;
            left: 70px;
        }
        
        .sidebar.collapsed:hover .dropdown-toggle,
        .sidebar.collapsed:hover .dropdown-text {
            display: block;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .user-name {
            font-size: 0.9rem;
            color: #495057;
        }

        .dashboard-card {
            background: repeating-linear-gradient(
                45deg,
                #f8f9fa,
                #f8f9fa 10px,
                #e9ecef 10px,
                #e9ecef 20px
            );
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            height: 200px;
            margin-bottom: 20px;
        }

        .large-card {
            height: 500px;
        }

        /* Breadcrumb styles */
        .breadcrumb-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 12px 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .breadcrumb {
            margin-bottom: 0;
            padding: 0;
        }

        /* Card styles */
        .content-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            margin-bottom: 20px;
            border-bottom: 1px solid #f1f1f1;
        }

        .card-header h4, .card-header h5 {
            margin-bottom: 0;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
    @stack('css')
</head>
<body>
<!-- Mobile Navbar -->
<div class="navbar-mobile">
    <button class="menu-toggle" id="menuToggle">
        <i class="bi bi-list"></i>
    </button>
    <div class="mobile-logo">{{ env('APP_NAME') }}</div>
    <div class="mobile-user">
        <span>{{ ucfirst(auth()->user()->initials()) }}</span>
    </div>
</div>

<!-- Overlay for mobile -->
<div class="overlay" id="overlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="logo-container">
        <div class="logo">
            <div class="logo-icon">
                <span class="icon-laravel">≪</span>
            </div>
            <span class="logo-text">{{ env('APP_NAME') }}</span>
            <div class="sidebar-collapse-btn" id="sidebarCollapseBtn">
                <i class="bi bi-chevron-left"></i>
            </div>
        </div>
    </div>

    <div class="nav-section" id="sidebar-menu">
        <div class="section-label">Menu</div>
        @include('layouts.backend.menu')
    </div>

    <div class="user-profile" id="userProfileContainer">
        <div class="user-profile-content">
            <div class="user-avatar">
                <span>{{ ucfirst(auth()->user()->initials()) }}</span>
            </div>
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="dropdown-toggle">
                <i class="bi bi-chevron-down"></i>
            </div>
        </div>
        <div class="user-dropdown">
            <a href="{{ route('profile.show') }}" class="dropdown-item">
                <i class="bi bi-person me-2"></i>
                <span class="dropdown-text">Profil</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    <span class="dropdown-text">Déconnexion</span>
                </a>
            </form>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">

    @if(isset($breadcrumb))
        @include('partials.breadcrumb')
    @else
        @yield('breadcrumb')
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const mainContent = document.querySelector('.main-content');
        const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');

        // Mobile menu toggle
        function toggleMenu() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
            document.body.classList.toggle('menu-open');
        }

        menuToggle.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);

        // Sidebar collapse toggle (desktop)
        function toggleSidebarCollapse() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            
            // Change the icon direction
            const icon = sidebarCollapseBtn.querySelector('i');
            if (sidebar.classList.contains('collapsed')) {
                icon.classList.remove('bi-chevron-left');
                icon.classList.add('bi-chevron-right');
            } else {
                icon.classList.remove('bi-chevron-right');
                icon.classList.add('bi-chevron-left');
            }
            
            // Save state to localStorage
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }
        
        sidebarCollapseBtn.addEventListener('click', toggleSidebarCollapse);
        
        // Close menu when clicking on a menu item (on mobile)
        const menuItems = document.querySelectorAll('.nav-item');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    toggleMenu();
                }
            });
        });

        // Handle resize events
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.classList.remove('menu-open');
            }
        });
        
        // Restore sidebar state from localStorage
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            toggleSidebarCollapse();
        }
        
        // Gérer l'ouverture automatique au survol en mode desktop
        if (window.innerWidth >= 992) {
            let hoverTimeout;
            
            sidebar.addEventListener('mouseenter', function() {
                if (sidebar.classList.contains('collapsed')) {
                    clearTimeout(hoverTimeout);
                }
            });
            
            sidebar.addEventListener('mouseleave', function() {
                if (sidebar.classList.contains('collapsed')) {
                    clearTimeout(hoverTimeout);
                    hoverTimeout = setTimeout(() => {
                        // Rien à faire, les styles CSS s'occupent de tout
                    }, 300);
                }
            });
        }
        
        // Gestion du dropdown utilisateur
        const userProfile = document.getElementById('userProfileContainer');
        userProfile.addEventListener('click', function(e) {
            // Ne pas ouvrir le dropdown si on clique sur un lien à l'intérieur du dropdown
            if (e.target.closest('.dropdown-item') && userProfile.classList.contains('open')) {
                return;
            }
            userProfile.classList.toggle('open');
            e.stopPropagation();
        });
        
        // Fermer le dropdown quand on clique ailleurs
        document.addEventListener('click', function() {
            userProfile.classList.remove('open');
        });
        
        // Empêcher la fermeture quand on clique dans le dropdown
        const userDropdown = userProfile.querySelector('.user-dropdown');
        userDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
</script>
@stack('scripts')
</body>
</html>
