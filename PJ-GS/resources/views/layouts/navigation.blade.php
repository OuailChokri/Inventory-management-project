<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for Navigation */
        nav {
            background: #f8f9fa; /* Couleur de fond */
            color: #333; /* Couleur du texte */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre légère */
        }
        nav .logo {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem; /* Ajout de padding */
        }
        nav .navigation-links {
            display: flex;
            align-items: center;
            gap: 1rem; /* Espacement entre les éléments */
            margin-right: auto; /* Marge à droite */
        }
        nav .navigation-links button {
            color: #333; /* Couleur du texte */
            background-color: transparent; /* Fond transparent */
            border: none; /* Suppression de la bordure */
            cursor: pointer; /* Curseur pointer */
            font-weight: bold; /* Police en gras */
            text-decoration: none; /* Suppression du soulignement */
            padding: 0; /* Suppression du padding */
        }
        nav .settings-dropdown {
            display: flex;
            align-items: center;
            margin-left: 1rem; /* Pour pousser vers la droite */
        }
        nav .settings-dropdown button {
            color: #333; /* Couleur du bouton */
            background-color: transparent; /* Fond transparent */
            border: none; /* Suppression de la bordure */
            cursor: pointer; /* Curseur pointer */
        }
        nav .hamburger-menu button {
            color: #333; /* Couleur du bouton */
            background-color: transparent; /* Fond transparent */
            border: none; /* Suppression de la bordure */
            cursor: pointer; /* Curseur pointer */
        }
        nav .responsive-menu {
            display: none;
            flex-direction: column; /* Affichage en colonne */
            background-color: #f8f9fa; /* Couleur de fond */
            padding: 1rem; /* Ajout de padding */
        }
        nav .responsive-menu a {
            color: #333; /* Couleur du lien */
            text-decoration: none; /* Suppression du soulignement */
            font-weight: bold; /* Police en gras */
            margin-bottom: 0.5rem; /* Marge en bas de chaque lien */
        }
        .dashboard-right-btn {
            background-color: blueviolet;
            color: white; /* Couleur du texte */
            padding: 0.5rem 1rem; /* Ajout de padding */
            border: none; /* Suppression de la bordure */
            border-radius: 0.25rem; /* Coins arrondis */
            cursor: pointer; /* Curseur pointer */
        }
        .dashboard-right-btn:hover {
            background-color: whitesmoke; /* Couleur de fond au survol */
        }
    </style>
</head>
<body>
    <nav x-data="{ open: false }" class="border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <!-- Logo -->
            <div class="logo">
                <a href="{{ route('dashboard.index') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links -->
            
            
            <div style="text-align: end; ">
    <a href="{{ route('dashboard.index') }}" class="dashboard-right-btn">
        {{ __('Dashboard') }}
    </a>
</div>
            

          

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Alpine.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>

    
</body>
</html>
