<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gendarmerie Nationale - Demande d'Escorte</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="{{ asset("images/gendarmerie-logo.png") }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset("images/gendarmerie-logo.png") }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset("images/gendarmerie-logo.png") }}">
    <style>
        :root {
            --primary: #003366;
            --primary-light: #004080;
            --primary-dark: #002244;
            --secondary: #64748b;
            --accent: #0ea5e9;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: var(--gray-700);
            overflow-x: hidden;
            padding-top: 80px; /* Ajout de padding pour compenser la navbar fixe */
        }

        /* Utilities */
        .text-primary-custom { color: var(--primary) !important; }
        .bg-primary-custom { background-color: var(--primary) !important; }
        .btn-primary-custom {
            background: var(--primary);
            border: 1px solid var(--primary);
            color: white;
            font-weight: 500;
            padding: 12px 24px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .btn-primary-custom:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }

        .navbar.scrolled .navbar-brand {
            color: var(--dark) !important;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 8px 16px !important;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .navbar.scrolled .nav-link {
            color: var(--gray-600) !important;
        }

        .nav-link:hover, .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
        }

        .navbar.scrolled .nav-link:hover,
        .navbar.scrolled .nav-link.active {
            color: var(--primary) !important;
            background: var(--gray-100);
        }

        .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .navbar.scrolled .navbar-toggler {
            border-color: var(--gray-300);
            color: var(--gray-600);
        }




        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.3);
            z-index: 1;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            line-height: 1.1;
            color: white;
            margin-bottom: 24px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
            max-width: 600px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .btn-hero-primary {
            background: var(--primary);
            border: 1px solid var(--primary);
            color: white;
            font-weight: 600;
            padding: 8px 8px;
            border-radius: 12px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
        }

        .btn-hero-primary:hover {
            background: var(--primary-light);
            border-color: var(--primary-light);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.5);
        }

        .btn-hero-secondary {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            font-weight: 600;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
        }

        .cta-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-secondary-custom {
            background: white;
            border: 1px solid var(--gray-300);
            color: var(--gray-700);
            font-weight: 500;
            padding: 12px 24px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-secondary-custom:hover {
            background: var(--gray-50);
            border-color: var(--gray-400);
            color: var(--gray-800);
            transform: translateY(-1px);
        }

        /* Services Section */
        .services-section {
            padding: 100px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            margin-bottom: 16px;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: var(--gray-600);
            text-align: center;
            margin-bottom: 80px;
        }

        .service-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            padding: 40px 32px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--primary);
        }

        .service-icon {
            width: 64px;
            height: 64px;
            background: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        .service-icon i {
            font-size: 1.5rem;
            color: white;
        }

        .service-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 12px;
        }

        .service-description {
            color: var(--gray-600);
            line-height: 1.6;
        }

        /* Guarantee Section */
        .guarantee-section {
            background: var(--gray-50);
            padding: 100px 0;
        }

        .guarantee-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            padding: 48px;
            margin-bottom: 32px;
        }

        .guarantee-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .feature-item {
            display: flex;
            gap: 20px;
            margin-bottom: 32px;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon i {
            color: white;
            font-size: 1.25rem;
        }

        .feature-content h4 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .feature-content p {
            color: var(--gray-600);
            margin: 0;
        }

        .steps-list {
            list-style: none;
            padding: 0;
        }

        .steps-list li {
            background: var(--gray-50);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 16px;
            position: relative;
            padding-left: 60px;
        }

        .steps-list li::before {
            content: counter(step-counter);
            counter-increment: step-counter;
            position: absolute;
            left: 20px;
            top: 24px;
            width: 24px;
            height: 24px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .steps-list {
            counter-reset: step-counter;
        }

        .steps-list h5 {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .steps-list p {
            color: var(--gray-600);
            margin: 0;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 100px 0;
        }

        .testimonial-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            padding: 32px;
            height: 100%;
        }

        .stars {
            color: #fbbf24;
            margin-bottom: 20px;
        }

        .testimonial-text {
            color: var(--gray-700);
            font-style: italic;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            background: var(--gray-200);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
            font-size: 0.875rem;
        }

        .author-info h6 {
            font-weight: 600;
            color: var(--dark);
            margin: 0;
        }

        .author-info small {
            color: var(--gray-500);
        }

        /* Contact Section */
        .contact-section {
            background: var(--gray-50);
            padding: 100px 0;
        }

        .contact-info {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            padding: 48px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .contact-icon {
            width: 48px;
            height: 48px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contact-icon i {
            color: white;
            font-size: 1.125rem;
        }

        .map-placeholder {
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: var(--gray-300);
            padding: 60px 0 30px;
        }

        .footer h5 {
            color: white;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer a {
            color: var(--gray-400);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer a:hover {
            color: white;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 8px;
        }

        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: var(--gray-800);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .social-link:hover {
            background: var(--primary);
            color: white;
        }

        .newsletter-form {
            margin-top: 20px;
        }

        .newsletter-form .form-control {
            background: var(--gray-800);
            border: 1px solid var(--gray-700);
            color: var(--gray-300);
            border-radius: 8px;
            padding: 12px 16px;
        }

        .newsletter-form .form-control:focus {
            background: var(--gray-800);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .footer-bottom {
            border-top: 1px solid var(--gray-800);
            margin-top: 40px;
            padding-top: 20px;
            color: var(--gray-500);
        }

        .guarantee-section {
            background: var(--gray-50);
            padding: 30px 0;
        }

        .guarantee-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            padding: 48px;
            margin-bottom: 32px;
        }

        .guarantee-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .feature-item {
            display: flex;
            gap: 20px;
            margin-bottom: 32px;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon i {
            color: white;
            font-size: 1.25rem;
        }

        .feature-content h4 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .feature-content p {
            color: var(--gray-600);
            margin: 0;
        }

        .steps-list {
            list-style: none;
            padding: 0;
        }

        .steps-list li {
            background: var(--gray-50);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 16px;
            position: relative;
            padding-left: 60px;
        }

        .steps-list li::before {
            content: counter(step-counter);
            counter-increment: step-counter;
            position: absolute;
            left: 20px;
            top: 24px;
            width: 24px;
            height: 24px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .steps-list {
            counter-reset: step-counter;
        }

        .steps-list h5 {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .steps-list p {
            color: var(--gray-600);
            margin: 0;
        }




        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0 60px;
                text-align: center;
            }

            .cta-buttons {
                justify-content: center;
            }

            .guarantee-card {
                padding: 32px 24px;
            }

            .feature-item {
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }

            .steps-list li {
                padding-left: 24px;
                text-align: center;
            }

            .steps-list li::before {
                position: static;
                margin: 0 auto 12px;
            }
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hero text overlay */
        .hero-text-overlay {
            background: rgba(0, 51, 102, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .hero-text-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            border-radius: 20px;
            pointer-events: none;
        }

        .hero-text-overlay > * {
            position: relative;
            z-index: 1;
        }

        /* Animation d'entrée */
        .hero-text-overlay {
            animation: slideInUp 1s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive pour mobile */
        @media (max-width: 768px) {
            .hero-text-overlay {
                padding: 30px 25px;
                border-radius: 15px;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
    <style>
        .article-banner {
            height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .article-banner::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(0deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.2) 100%);
        }

        .banner-content {
            position: relative;
            z-index: 1;
        }

        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .meta-info {
            border-left: 3px solid #28a745;
            padding-left: 1rem;
        }

        .share-button {
            transition: all 0.3s ease;
        }

        .share-button:hover {
            transform: translateY(-2px);
        }

        .related-article {
            transition: all 0.3s ease;
            border-radius: 1rem;
        }

        .related-article:hover {
            transform: translateY(-5px);
        }

        .market-stats {
            background: #f8f9fa;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #28a745;
        }
        /* REMPLACEZ la section Navigation dans votre CSS par ceci : */

        /* Navigation - Style moderne */

        .navbar {
            background-color: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .navbar.navbar-scrolled {
            padding: 8px 0;
            background-color: rgba(255, 255, 255, 0.98);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar.fixed-top {
            padding: 10px 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--dark) !important;
            display: flex;
            align-items: center;
        }

        .brand-text {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary);
            margin-left: 8px;
        }

        .navbar-nav {
            gap: 10px;
        }

        .nav-link {
            color: var(--gray-700) !important;
            font-weight: 500;
            font-size: 1rem;
            padding: 10px 16px !important;
            border-radius: 8px;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            background-color: rgba(26, 94, 162, 0.08);
        }

        .nav-link.active {
            color: var(--primary) !important;
            background-color: rgba(26, 94, 162, 0.12);
            font-weight: 600;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 3px;
            background-color: var(--primary);
            border-radius: 3px;
        }

        .navbar-toggler {
            border: none;
            padding: 8px;
            border-radius: 8px;
            background-color: rgba(26, 94, 162, 0.1);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(26, 94, 162, 0.25);
        }

        .btn-assistance {
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(26, 94, 162, 0.2);
            transition: all 0.3s ease;
        }

        .btn-assistance:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(26, 94, 162, 0.3);
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                margin-top: 15px;
            }

            .navbar-nav {
                margin-bottom: 15px;
            }

            .nav-cta {
                text-align: center;
            }
        }
        .hero-section {
            background: url({{ asset('images/bg-hero.jpeg') }}) center/cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="gendarmerie" patternUnits="userSpaceOnUse" width="20" height="20"><circle cx="10" cy="10" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23gendarmerie)"/></svg>') repeat;
            z-index: 1;
        }

        /* Styles du bouton WhatsApp flottant */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background-color: #25D366;
            color: white;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .whatsapp-float:hover {
            background-color: #20b954;
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
        }

        /* Styles du bouton d'urgence flottant */
        .emergency-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
            z-index: 1000;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .emergency-float:hover {
            background-color: #c82333;
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.6);
        }

        /* Animation de pulsation */
        .emergency-float::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #dc3545;
            animation: pulse 2s infinite;
            z-index: -1;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }

        /* Icône WhatsApp en SVG */
        .whatsapp-icon {
            width: 32px;
            height: 32px;
            fill: white;
        }

        /* Bottom Navigation Mobile */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid var(--gray-200);
            box-shadow: 0 -2px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            padding: 8px 0 max(8px, env(safe-area-inset-bottom));
        }

        .bottom-nav-items {
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-width: 500px;
            margin: 0 auto;
            padding: 0 16px;
        }

        .bottom-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--gray-600);
            padding: 8px 12px;
            border-radius: 12px;
            transition: all 0.2s ease;
            min-width: 60px;
            position: relative;
        }

        .bottom-nav-item:hover,
        .bottom-nav-item.active {
            color: var(--primary);
            background: rgba(0, 51, 102, 0.08);
            text-decoration: none;
        }

        .bottom-nav-item i {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .bottom-nav-item span {
            font-size: 11px;
            font-weight: 500;
            line-height: 1;
        }

        .bottom-nav-item.cta {
            background: var(--primary);
            color: white;
            transform: translateY(-8px);
            box-shadow: 0 4px 12px rgba(0, 51, 102, 0.3);
            padding: 12px;
            border-radius: 16px;
        }

        .bottom-nav-item.cta:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-10px);
        }

        .bottom-nav-item.cta i {
            font-size: 24px;
            margin-bottom: 2px;
        }

        .bottom-nav-item.cta span {
            font-size: 10px;
            font-weight: 600;
        }

        /* Badge pour notifications */
        .nav-badge {
            position: absolute;
            top: 2px;
            right: 8px;
            background: var(--danger);
            color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .bottom-nav {
                display: block;
            }

            /* Masquer la navbar classique sur mobile */
            .navbar {
                display: none;
            }

            /* Ajuster le padding du body pour le bottom nav */
            body {
                padding-top: 0;
                padding-bottom: 80px;
            }

            /* Ajuster le bouton d'urgence */
            .emergency-float {
                width: 50px;
                height: 50px;
                bottom: 90px;
                right: 20px;
                font-size: 24px;
            }

            /* Ajuster les sections pour mobile */
            .hero-section {
                padding-top: 20px;
                min-height: 70vh;
            }

            .services-section,
            .guarantee-section,
            .testimonials-section,
            .contact-section {
                padding: 60px 0;
            }
        }

        /* Affichage desktop */
        @media (min-width: 769px) {
            .bottom-nav {
                display: none !important;
            }

            .navbar {
                display: flex !important;
            }

            body {
                padding-top: 80px;
                padding-bottom: 0;
            }
        }

        /* Tooltip optionnel */
        .emergency-float::after {
            content: "Urgence - Appelez le 17";
            position: absolute;
            right: 70px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #333;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .emergency-float:hover::after {
            opacity: 1;
            visibility: visible;
        }
    </style>
    @stack('css')
</head>
<body>
<header class="navbar-header">
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset("images/logogendarmerie.jpg") }}" width="50" alt="Gendarmerie Logo" class="me-2">
                <span class="brand-text">GENDARMERIE</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="bi bi-house-door me-1"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#services">
                            <i class="bi bi-shield me-1"></i> Types d'Escortes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#exigences-grid">
                            <i class="bi bi-file-text me-1"></i> Exigences
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#contact">
                            <i class="bi bi-envelope me-1"></i> Contact
                        </a>
                    </li>
                </ul>

                <div class="nav-cta">
                    <a href="{{ route('front.reclamation.create') }}" class="btn btn-primary-custom btn-assistance {{ Route::is('front.reclamation.create') ? 'disabled' : '' }}">
                        <i class="bi bi-shield-check me-1"></i> Demander une escorte
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
@yield('content')
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5>Gendarmerie Nationale</h5>
                <p>Service officiel de demande d'escorte pour la protection et l'accompagnement sécurisé sur le territoire national.</p>
                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5>Liens rapides</h5>
                <ul>
                    <li><a href="#accueil">Accueil</a></li>
                    <li><a href="#services">Types d'Escortes</a></li>
                    <li><a href="#exigences-grid">Exigences</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5>Services d'Escorte</h5>
                <ul>
                    <li><a href="#">Transport de fonds</a></li>
                    <li><a href="#">Personnalités</a></li>
                    <li><a href="#">Marchandises</a></li>
                    <li><a href="#">Convois spéciaux</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-4">
                <h5>Informations officielles</h5>
                <p>Restez informé des procédures et actualités de la Gendarmerie Nationale.</p>
                <div class="contact-info mt-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        <span>Urgences: 17</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-envelope me-2"></i>
                        <span>info@gendarmerie.sn</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; 2025 Gendarmerie Nationale du Sénégal. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="me-3">Mentions légales</a>
                    <a href="#" class="me-3">Politique de confidentialité</a>
                    <a href="#">CGV</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="tel:17"
       class="emergency-float"
       title="Urgence - Appelez le 17">
        <i class="bi bi-telephone-fill"></i>
    </a>

<!-- Bottom Navigation Mobile -->
<nav class="bottom-nav">
    <div class="bottom-nav-items">
        <a href="{{ url('/') }}" class="bottom-nav-item {{ Request::is('/') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>Accueil</span>
        </a>
        
        <a href="{{ url('/') }}#services" class="bottom-nav-item">
            <i class="bi bi-shield"></i>
            <span>Services</span>
        </a>
        
        <a href="{{ route('front.reclamation.create') }}" class="bottom-nav-item cta {{ Route::is('front.reclamation.create') ? 'active' : '' }}">
            <i class="bi bi-shield-check"></i>
            <span>Demande</span>
        </a>
        
        <a href="{{ url('/') }}#contact" class="bottom-nav-item">
            <i class="bi bi-envelope"></i>
            <span>Contact</span>
        </a>
        
        <a href="tel:17" class="bottom-nav-item">
            <i class="bi bi-telephone-fill"></i>
            <span>Urgence</span>
            <div class="nav-badge">!</div>
        </a>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offsetTop = target.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Active navigation links (desktop et mobile)
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');
    const bottomNavItems = document.querySelectorAll('.bottom-nav-item:not(.cta)');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            if (window.pageYOffset >= sectionTop) {
                current = section.getAttribute('id');
            }
        });

        // Desktop navigation
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });

        // Mobile bottom navigation
        bottomNavItems.forEach(item => {
            item.classList.remove('active');
            const href = item.getAttribute('href');
            if (href === `#${current}` || (href === '{{ url('/') }}' && current === '')) {
                item.classList.add('active');
            }
        });
    });

    // Gestion des clics sur le bottom nav mobile
    document.querySelectorAll('.bottom-nav-item[href*="#"]').forEach(item => {
        item.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.includes('#')) {
                e.preventDefault();
                const targetId = href.split('#')[1];
                const target = document.getElementById(targetId);
                if (target) {
                    const offsetTop = target.offsetTop - 20;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // Fade in animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.service-card, .guarantee-card, .testimonial-card').forEach(el => {
        el.classList.add('fade-in');
        observer.observe(el);
    });
</script>
@stack('scripts')
</body>
</html>
