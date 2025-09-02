@extends('layouts.master')
@section('content')

    <!-- Hero Section -->
    <section class="hero-section" id="accueil">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row">
                <div class="col-lg-8 col-xl-7 hero-content">
                    <div class="hero-text-overlay">
                        <h1 class="display-4 fw-bold mb-4 text-white">Demande d'escorte de la Gendarmerie Nationale</h1>
                        <p class="lead mb-5 text-white">Service officiel de demande d'escorte pour le transport sécurisé de personnes, biens ou véhicules sous protection de la Gendarmerie.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('front.reclamation.create') }}" class="btn btn-light btn-lg px-4  btn-hero-primary">
                                <i class="bi bi-shield-check me-2"></i>
                                Demander une escorte</a>
                            <a href="tel:+221338234239" class="btn btn-outline-light btn-lg px-4">
                                <i class="bi bi-telephone-fill me-2"></i>+221 33 823 42 39
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="container">
            <h2 class="section-title">Types d'escortes</h2>
            <p class="section-subtitle">Services de protection et d'accompagnement sécurisé</p>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h3 class="service-title">Transport de fonds</h3>
                        <p class="service-description">
                            Escorte sécurisée pour le transport de valeurs, fonds et matériels sensibles avec protection renforcée.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <h3 class="service-title">Personnalités</h3>
                        <p class="service-description">
                            Protection rapprochée et escorte de personnalités officielles, dignitaires et VIP.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h3 class="service-title">Marchandises</h3>
                        <p class="service-description">
                            Accompagnement sécurisé de convois de marchandises précieuses ou sensibles.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements Section -->
    <section class="guarantee-section" id="exigences-grid" >
        <div class="container">
            <h2 class="section-title">Conditions et exigences</h2>
            <p class="section-subtitle">Informations importantes pour votre demande d'escorte</p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <div class="guarantee-card">
                    <h3 class="guarantee-title">
                        <i class="bi bi-check-circle-fill text-primary-custom"></i>
                        Critères d'éligibilité
                    </h3>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-file-text"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Justification officielle</h4>
                            <p>Toute demande doit être accompagnée d'une justification officielle et de documents d'identité valides.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Délai de traitement</h4>
                            <p>Les demandes sont traitées sous 48-72h ouvrables selon la nature et l'urgence de la mission.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Zone de couverture</h4>
                            <p>Service disponible sur l'ensemble du territoire national avec coordination des unités locales.</p>
                        </div>
                    </div>
                </div>

                <div class="guarantee-card">
                    <h3 class="guarantee-title">
                        <i class="bi bi-list-check text-primary-custom"></i>
                        Procédure de demande
                    </h3>

                    <ol class="steps-list">
                        <li>
                            <h5>Préparez vos documents</h5>
                            <p>Rassemblez tous les documents justificatifs, pièces d'identité et autorisations nécessaires.</p>
                        </li>
                        <li>
                            <h5>Détaillez votre demande</h5>
                            <p>Précisez l'itinéraire, les horaires, le type de transport et la nature des biens/personnes à escorter.</p>
                        </li>
                        <li>
                            <h5>Soumettez votre demande</h5>
                            <p>Complétez le formulaire en ligne avec toutes les informations requises pour traitement.</p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="testimonials-section">
        <div class="container">
            <h2 class="section-title">Nos performances</h2>
            <p class="section-subtitle">La sécurité et l'efficacité au service des citoyens</p>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="text-center mb-3">
                            <i class="bi bi-shield-check" style="font-size: 3rem; color: var(--primary);"></i>
                        </div>
                        <div class="text-center">
                            <h3 class="text-primary-custom mb-2">98%</h3>
                            <h5>Taux de réussite</h5>
                            <p class="testimonial-text">
                                Des missions d'escorte menées avec succès, garantissant la sécurité totale des biens et personnes transportés.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="text-center mb-3">
                            <i class="bi bi-clock" style="font-size: 3rem; color: var(--primary);"></i>
                        </div>
                        <div class="text-center">
                            <h3 class="text-primary-custom mb-2">24h</h3>
                            <h5>Délai moyen</h5>
                            <p class="testimonial-text">
                                Temps de réponse moyen pour le traitement et la validation des demandes d'escorte urgentes.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="text-center mb-3">
                            <i class="bi bi-people" style="font-size: 3rem; color: var(--primary);"></i>
                        </div>
                        <div class="text-center">
                            <h3 class="text-primary-custom mb-2">500+</h3>
                            <h5>Missions annuelles</h5>
                            <p class="testimonial-text">
                                Nombre de missions d'escorte réalisées chaque année sur l'ensemble du territoire national.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <h2 class="section-title">Contactez-nous</h2>
            <p class="section-subtitle">Service de demande d'escorte - Gendarmerie Nationale</p>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <h5>Adresse</h5>
                                <p class="mb-0">Haut Commandement de la Gendarmerie<br>Avenue Lamine Gueye, Dakar</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <h5>Téléphone</h5>
                                <p class="mb-0">+221 33 823 42 39</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <h5>Email officiel</h5>
                                <p class="mb-0">escorte@gendarmerie.sn</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div>
                                <h5>Horaires de service</h5>
                                <p class="mb-0">24h/24 - 7j/7 pour les urgences<br>Bureau: Lun - Ven: 8h - 17h</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="map-placeholder">
                    <span>
                        <img src="{{ asset('images/bg-hero.jpeg') }}" alt="Gendarmerie Nationale" width="100%" class="img-fluid rounded">
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
