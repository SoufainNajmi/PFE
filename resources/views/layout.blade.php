<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanoti - E-Commerce B2B</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <a href="/">Hanoti.</a>
        </div>
        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="/products">Produits</a></li>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li><a href="/admin/dashboard">Tableau de Bord Admin</a></li>
                    @elseif(auth()->user()->role === 'fournisseur')
                        <li><a href="/fournisseur/dashboard">Mon Espace Fournisseur</a></li>
                    @else
                        <li><a href="/client/order/create">Passer une commande</a></li>
                        <li><a href="/client/orders">Mes Commandes</a></li>
                        <li><a href="/client/cart">Mon Panier</a></li>
                    @endif
                    <li>
                        <form action="/logout" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn" style="padding: 0.5rem 1rem;">Déconnexion</button>
                        </form>
                    </li>
                @else
                    <li><a href="/login" class="btn">Connexion</a></li>
                    <li><a href="/register" class="btn" style="background: var(--dark-lighter); border: 1px solid var(--glass-border);">Inscription</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main>
        @if(session('success'))
            <div class="alert alert-success animate-fade-in">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger animate-fade-in">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>&copy; 2026 Hanoti - Projet de Fin d'Études BTS. Tous droits réservés.</p>
    </footer>
</body>
</html>
