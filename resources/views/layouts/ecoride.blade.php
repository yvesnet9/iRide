<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - EcoRide</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        /* Fixe la navbar en haut */
        .navbar-fixed {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        /* Ajoute un espace pour éviter que le contenu passe sous la navbar */
        body {
            padding-top: 70px;
            padding-bottom: 70px; /* pour footer */
        }

        /* Fixe le footer en bas */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #111827;
            color: white;
            text-align: center;
            padding: 10px 0;
            z-index: 1000;
        }

        /* Contenu scrollable */
        .content-wrapper {
            min-height: calc(100vh - 140px); /* navbar 70px + footer 70px */
            overflow-y: auto;
        }
    </style>
</head>
<body>

    {{-- NAVBAR FIXE --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm navbar-fixed px-3">
        <a class="navbar-brand text-success fw-bold" href="{{ route('ecoride.home') }}">
            EcoRide
        </a>

        <div class="ms-auto">
            <a href="{{ route('ecoride.home') }}" class="me-3">Accueil</a>
            <a href="{{ route('ecoride.search') }}" class="me-3">Covoiturages</a>

            @auth
                <a href="/dashboard" class="me-3">Dashboard</a>
                <a href="/logout">Déconnexion</a>
            @else
                <a href="/login">Connexion</a>
            @endauth
        </div>
    </nav>

    {{-- CONTENU (scrollable) --}}
    <div class="content-wrapper container py-4">
        @yield('content')
    </div>

    {{-- FOOTER FIXE --}}
    <footer>
        EcoRide © 2025 — Contact : contact@ecoride.fr  
    </footer>

</body>
</html>
