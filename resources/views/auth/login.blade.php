@extends('auth.app')

@section('content')

<div class="w-full md:w-1/2 flex flex-col justify-center items-center p-8 md:p-16">
    <div class="w-full max-w-md form-container p-8 rounded-xl">
        <div class="mb-8 flex items-center">
            <img src="{{ asset('images/logogendarmerie.jpg') }}" alt="Gendarmerie Logo" class="w-32 mr-3">
        </div>
        
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Connexion Administrateur</h2>
        <p class="text-gray-600 mb-8">Accès sécurisé à la plateforme de gestion des demandes d'escorte.</p>
        
        <!-- Laravel Form -->
        <form method="POST" action="{{ route('login') ?? '#' }}" class="space-y-6">
            @csrf
            
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse e-mail</label>
                <div class="relative">
                    <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') ?? '' }}"
                        placeholder="admin@gendarmerie.sn"
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg input-focus transition-all"
                        required
                    >
                </div>
                @if(isset($errors))
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                @endif
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        placeholder="Votre mot de passe sécurisé"
                        class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-lg input-focus transition-all"
                        required
                    >
                    <button 
                        type="button" 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                        onclick="togglePassword()"
                    >
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @if(isset($errors))
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                @endif
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember"
                        class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500"
                    >
                    <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
                </div>
                <a href="{{ route('password.request') ?? '#' }}" class="text-sm text-[#003366] hover:text-[#002244] transition-colors">
                    Mot de passe oublié ?
                </a>
            </div>

            <!-- Login Button -->
            <button 
                type="submit" 
                class="w-full btn-primary text-white py-3 rounded-lg font-semibold"
            >
                Se connecter
            </button>
        </form>

        <!-- Info Section -->
        <div class="mt-8 text-center">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <p class="text-blue-800 text-sm mb-0">
                    <i class="fas fa-info-circle mr-2"></i>
                    Accès réservé au personnel autorisé de la Gendarmerie Nationale
                </p>
            </div>
            <a href="{{ url('/') }}" class="text-[#003366] hover:text-[#002244] text-sm transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>


@endsection
