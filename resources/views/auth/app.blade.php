<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gendarmerie Nationale</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f9fafb;
        }
        .input-focus:focus {
            outline: none;
            border-color: #003366;
            box-shadow: 0 0 0 3px rgba(0, 51, 102, 0.1);
        }
        .btn-primary {
            background: #003366;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #002244;
        }
        .right-side-bg {
            background-image: url('{{ asset('images/bg-hero.jpeg') }}');
            background-size: cover;
            background-position: center;
        }
        .overlay {
            background: linear-gradient(135deg, rgba(0, 51, 102, 0.8) 0%, rgba(0, 34, 68, 0.9) 100%);
        }
        .form-container {
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 10px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="flex min-h-screen">
        <!-- Left Side - Login Form -->
        @yield('content')
        <!-- Right Side - Image -->
        <div class="hidden md:block md:w-1/2 right-side-bg relative">
            <div class="absolute inset-0 overlay flex flex-col justify-center items-center text-white p-12">
                <div class="max-w-md text-center">
                    <h2 class="text-4xl font-bold mb-6">Gendarmerie Nationale</h2>
                    <p class="text-xl mb-8">
                        Plateforme officielle de gestion des demandes d'escorte sécurisée sur le territoire national.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <span>Sécurité</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            <span>Protection</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <span>24h/7j</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = inputId ? document.getElementById(inputId) : document.getElementById('password');
            const toggleIcon = iconId ? document.getElementById(iconId) : document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }
        }
    </script>
    
    @stack('scripts')
</body>
</html>