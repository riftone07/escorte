@extends('layouts.master')
@push('css')
    <style>
        .form-section {
            padding-top: 10px;   /* haut */
            padding-bottom: 80px; /* bas */
        }

        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 40px;
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(0, 86, 166, 0.15);
            border-color: var(--primary);
        }
        .article-banner{
            background: url("{{ asset('images/bg-hero.jpeg') }}") center/cover;
        }
        @media (max-width: 768px) {
            .article-banner {
                background: url("{{ asset('images/bg-hero.jpeg') }}") center/cover;
            }
        }
    </style>
@endpush
@section('content')
    <div class="article-banner mb-2">
        <div class="container h-100">
            <div class="banner-content h-100 d-flex align-items-end pb-5">
                <div class="text-white">
                    <h1 class="display-4 fw-bold mb-3" style="color: white !important;">Demande d'escorte officielle</h1>
                    <div class="meta-info d-flex gap-4">
                        <div>
                            <i class="bi bi-shield-check me-2"></i>
                            Nos équipes analyseront votre demande et vous contacteront sous 48h.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-container">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('front.reclamations.storePublic') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">

                                <div class="col-12 mt-4">
                                    <h4 class="mb-4 border-bottom pb-2">Informations du demandeur</h4>
                                </div>

                                <div class="col-md-6">
                                    <label for="prenom" class="form-label">Prénom<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                                    @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                                    @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="telephone" class="form-label">Téléphone<span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                                    @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" >
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{ old('adresse') }}" placeholder="Votre adresse complète" required>
                                    @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <h4 class="mb-4 border-bottom pb-2">Détails de la mission d'escorte</h4>
                                </div>

                                <div class="col-md-6">
                                    <label for="type_escorte" class="form-label">Type d'escorte <span class="text-danger">*</span></label>
                                    <select class="form-select form-control @error('type_escorte') is-invalid @enderror" id="type_escorte" name="type_escorte" required>
                                        <option value="" selected disabled>Sélectionnez le type</option>
                                        <option value="transport_fonds" {{ old('type_escorte') == 'transport_fonds' ? 'selected' : '' }}>Transport de fonds</option>
                                        <option value="personnalites" {{ old('type_escorte') == 'personnalites' ? 'selected' : '' }}>Personnalités/VIP</option>
                                        <option value="marchandises" {{ old('type_escorte') == 'marchandises' ? 'selected' : '' }}>Marchandises précieuses</option>
                                        <option value="convoi_special" {{ old('type_escorte') == 'convoi_special' ? 'selected' : '' }}>Convoi spécial</option>
                                        <option value="autre" {{ old('type_escorte') == 'autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    @error('type_escorte')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="urgence" class="form-label">Niveau d'urgence <span class="text-danger">*</span></label>
                                    <select class="form-select form-control @error('urgence') is-invalid @enderror" id="urgence" name="urgence" required>
                                        <option value="" selected disabled>Sélectionnez l'urgence</option>
                                        <option value="normale" {{ old('urgence') == 'normale' ? 'selected' : '' }}>Normale (72h)</option>
                                        <option value="urgent" {{ old('urgence') == 'urgent' ? 'selected' : '' }}>Urgent (24h)</option>
                                        <option value="tres_urgent" {{ old('urgence') == 'tres_urgent' ? 'selected' : '' }}>Très urgent (immédiat)</option>
                                    </select>
                                    @error('urgence')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="date_mission" class="form-label">Date de la mission <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control @error('date_mission') is-invalid @enderror" id="date_mission" name="date_mission" value="{{ old('date_mission') }}" required>
                                    @error('date_mission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="duree_estimee" class="form-label">Durée estimée</label>
                                    <input type="text" class="form-control @error('duree_estimee') is-invalid @enderror" id="duree_estimee" name="duree_estimee" value="{{ old('duree_estimee') }}" placeholder="Ex: 2 heures, 1 journée">
                                    @error('duree_estimee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="lieu_depart" class="form-label">Lieu de départ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('lieu_depart') is-invalid @enderror" id="lieu_depart" name="lieu_depart" value="{{ old('lieu_depart') }}" required placeholder="Adresse complète de départ">
                                    @error('lieu_depart')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="lieu_arrivee" class="form-label">Lieu d'arrivée <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('lieu_arrivee') is-invalid @enderror" id="lieu_arrivee" name="lieu_arrivee" value="{{ old('lieu_arrivee') }}" required placeholder="Adresse complète d'arrivée">
                                    @error('lieu_arrivee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="description" class="form-label">Description détaillée de la mission <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required placeholder="Décrivez en détail la nature de la mission, les risques potentiels, le nombre de personnes/véhicules...">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="image" class="form-label">Documents justificatifs <small class="text-muted">(optionnel)</small></label>
                                    <div class="d-flex gap-2 mb-2">
                                        <button type="button" class="btn btn-outline-primary" id="take-photo-btn">
                                            <i class="bi bi-camera-fill"></i> Prendre une photo
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" id="choose-file-btn">
                                            <i class="bi bi-folder"></i> Choisir un fichier
                                        </button>
                                    </div>
                                    <input type="file" class="form-control d-none @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" capture="environment">
                                    <div class="form-text">Formats acceptés : JPG, PNG, PDF. Taille max : 5 Mo. (Autorisations, pièces d'identité, etc.)</div>
                                    <div id="image-preview" class="mt-2 d-none">
                                        <img src="#" alt="Aperçu de l'image" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="numero_dossier" class="form-label">Numéro de dossier/référence</label>
                                    <input type="text" class="form-control @error('numero_dossier') is-invalid @enderror" id="numero_dossier" name="numero_dossier" value="{{ old('numero_dossier') }}" placeholder="Référence interne si applicable">
                                    @error('numero_dossier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="organisme" class="form-label">Organisme/Entreprise <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('organisme') is-invalid @enderror" id="organisme" name="organisme" value="{{ old('organisme') }}" required placeholder="Nom de l'organisme demandeur">
                                    @error('organisme')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="fonction" class="form-label">Fonction/Qualité <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('fonction') is-invalid @enderror" id="fonction" name="fonction" value="{{ old('fonction') }}" required placeholder="Votre fonction dans l'organisme">
                                    @error('fonction')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <h4 class="mb-4 border-bottom pb-2">Personne à contacter</h4>
                                </div>

                                <div class="col-md-6">
                                    <label for="contact_nom" class="form-label">Nom du contact <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('contact_nom') is-invalid @enderror" id="contact_nom" name="contact_nom" value="{{ old('contact_nom') }}" required placeholder="Nom de la personne à contacter">
                                    @error('contact_nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="contact_telephone" class="form-label">Téléphone du contact <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('contact_telephone') is-invalid @enderror" id="contact_telephone" name="contact_telephone" value="{{ old('contact_telephone') }}" required placeholder="Numéro de téléphone du contact">
                                    @error('contact_telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="contact_email" class="form-label">Email du contact</label>
                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" name="contact_email" value="{{ old('contact_email') }}" placeholder="Email de la personne à contacter">
                                    @error('contact_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="contact_fonction" class="form-label">Fonction du contact</label>
                                    <input type="text" class="form-control @error('contact_fonction') is-invalid @enderror" id="contact_fonction" name="contact_fonction" value="{{ old('contact_fonction') }}" placeholder="Fonction de la personne à contacter">
                                    @error('contact_fonction')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <strong>Important :</strong> Cette demande sera étudiée par nos services. Un accusé de réception vous sera envoyé, suivi d'une réponse sous 48-72h ouvrables.
                                    </div>
                                    <button type="submit" class="btn btn-primary-custom btn-lg w-100">
                                        <i class="bi bi-shield-check me-2"></i>
                                        Soumettre la demande d'escorte
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');
            const previewImage = imagePreview.querySelector('img');
            const takePhotoBtn = document.getElementById('take-photo-btn');
            const chooseFileBtn = document.getElementById('choose-file-btn');

            // Vérifier si l'appareil a une caméra
            const hasCamera = 'mediaDevices' in navigator && 'getUserMedia' in navigator.mediaDevices;

            if (!hasCamera) {
                takePhotoBtn.classList.add('d-none');
            }

            // Bouton pour prendre une photo (ouvre la caméra sur mobile)
            takePhotoBtn.addEventListener('click', function() {
                imageInput.setAttribute('capture', 'environment'); // Utilise la caméra arrière
                imageInput.click();
            });

            // Bouton pour choisir un fichier depuis la galerie
            chooseFileBtn.addEventListener('click', function() {
                imageInput.removeAttribute('capture'); // Ne force pas l'utilisation de la caméra
                imageInput.click();
            });

            // Prévisualisation de l'image sélectionnée
            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.classList.remove('d-none');
                    };

                    reader.readAsDataURL(this.files[0]);
                } else {
                    imagePreview.classList.add('d-none');
                }
            });
        });
    </script>
@endpush
