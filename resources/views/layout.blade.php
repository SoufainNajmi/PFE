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
            <a href="/" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                <img src="{{ asset('asset/image/logo.png') }}" alt="Logo" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                Hanoti.
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="/products">Produits</a></li>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li><a href="/admin/dashboard">Tableau de Bord Admin</a></li>
                        <li><a href="{{ route('admin.support') }}">Messages Support</a></li>
                    @elseif(auth()->user()->role === 'fournisseur')
                        <li><a href="/fournisseur/dashboard">Mon Espace Fournisseur</a></li>
                        <li><a href="{{ route('fournisseur.invoices') }}">Mes Factures</a></li>
                        <li><a href="{{ route('support.create') }}">Contacter le Support</a></li>
                    @else
                        <li><a href="/client/order/create">Passer une commande</a></li>
                        <li><a href="/client/orders">Mes Commandes</a></li>
                        <li><a href="{{ route('client.invoices') }}">Mes Factures</a></li>
                        <li><a href="/client/cart">Mon Panier</a></li>
                        <li><a href="{{ route('support.create') }}">Contacter le Support</a></li>
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

    <footer style="background: rgba(15, 23, 42, 0.9); backdrop-filter: blur(15px); padding: 4rem 5% 2rem; border-top: 1px solid var(--glass-border); margin-top: auto;">
        <div class="footer-content grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 3rem; text-align: left; margin-bottom: 3rem;">
            <!-- Colonne 1: À propos -->
            <div class="footer-col" style="animation: fadeInUp 0.8s ease;">
                <a href="/" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; margin-bottom: 1.5rem;">
                    <img src="{{ asset('asset/image/logo.png') }}" alt="Logo" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                    <span style="font-size: 1.8rem; font-weight: 800; background: linear-gradient(to right, var(--primary), var(--secondary)); -webkit-background-clip: text; color: transparent;">Hanoti.</span>
                </a>
                <p style="color: var(--text-muted); line-height: 1.6; margin-bottom: 1.5rem;">
                    La plateforme B2B de référence au Maroc. Connectez-vous, commandez et développez votre activité en toute simplicité.
                </p>
                <!-- Icones réseaux sociaux -->
                <div class="social-icons" style="display: flex; gap: 1rem;">
                    <a href="#" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; border: 1px solid var(--glass-border); color: #fff; transition: all 0.3s ease;" onmouseover="this.style.background='var(--primary)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.transform='translateY(0)'">
                       <!-- SVG FB -->
                       <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4v-8.5z"/></svg>
                    </a>
                    <a href="#" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; border: 1px solid var(--glass-border); color: #fff; transition: all 0.3s ease;" onmouseover="this.style.background='var(--secondary)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.transform='translateY(0)'">
                       <!-- SVG IG -->
                       <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="#" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; border: 1px solid var(--glass-border); color: #fff; transition: all 0.3s ease;" onmouseover="this.style.background='var(--tertiary)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.transform='translateY(0)'">
                       <!-- SVG Twitter / X -->
                       <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.195 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Colonne 2: Liens Rapides -->
            <div class="footer-col" style="animation: fadeInUp 0.8s ease; animation-delay: 0.1s; animation-fill-mode: both;">
                <h4 style="font-size: 1.2rem; color: #fff; margin-bottom: 1.5rem; position: relative; padding-bottom: 0.5rem; display: inline-block;">
                    Liens Rapides
                    <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: var(--primary); border-radius: 2px;"></span>
                </h4>
                <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 0.8rem;">
                    <li><a href="/" style="color: var(--text-muted); transition: color 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'"><svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg> Accueil</a></li>
                    <li><a href="/products" style="color: var(--text-muted); transition: color 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'"><svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg> Catalogue Produits</a></li>
                    <li><a href="/register" style="color: var(--text-muted); transition: color 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'"><svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg> S'inscrire / Connexion</a></li>
                    <li><a href="#" style="color: var(--text-muted); transition: color 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'"><svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg> Assistance et Contact</a></li>
                </ul>
            </div>

            <!-- Colonne 3: Contact Info -->
            <div class="footer-col" style="animation: fadeInUp 0.8s ease; animation-delay: 0.2s; animation-fill-mode: both;">
                <h4 style="font-size: 1.2rem; color: #fff; margin-bottom: 1.5rem; position: relative; padding-bottom: 0.5rem; display: inline-block;">
                    Contactez-nous
                    <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: var(--secondary); border-radius: 2px;"></span>
                </h4>
                <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 1.2rem;">
                    <li style="display: flex; gap: 1rem; align-items: flex-start;">
                        <span style="color: var(--secondary); margin-top: 3px;"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></span>
                        <span style="color: var(--text-muted); line-height: 1.4;">Quartier Industriel, Casablanca<br>Maroc</span>
                    </li>
                    <li style="display: flex; gap: 1rem; align-items: flex-start;">
                        <span style="color: var(--secondary); margin-top: 3px;"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></span>
                        <span style="color: var(--text-muted);">contact@hanoti.ma</span>
                    </li>
                    <li style="display: flex; gap: 1rem; align-items: flex-start;">
                        <span style="color: var(--secondary); margin-top: 3px;"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></span>
                        <span style="color: var(--text-muted);">+212 5 22 00 00 00</span>
                    </li>
                </ul>
            </div>

            <!-- Colonne 4: Téléchargements / Emblèmes -->
            <div class="footer-col" style="animation: fadeInUp 0.8s ease; animation-delay: 0.3s; animation-fill-mode: both; display: flex; flex-direction: column; align-items: flex-start;">
                <h4 style="font-size: 1.2rem; color: #fff; margin-bottom: 1.5rem; position: relative; padding-bottom: 0.5rem; display: inline-block;">
                    Téléchargez l'application
                    <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: var(--tertiary); border-radius: 2px;"></span>
                </h4>
                <div style="display: flex; flex-direction: column; gap: 1rem; width: 100%;">
                    <img src="{{ asset('asset/imgfooter.png') }}" alt="Application App Store" style="height: auto; max-width: 140px; object-fit: contain; border-radius: 8px; transition: transform 0.3s ease; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.3);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="{{ asset('asset/imgfooter1.png') }}" alt="Application Google Play" style="height: auto; max-width: 140px; object-fit: contain; border-radius: 8px; transition: transform 0.3s ease; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.3);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                </div>
            </div>
        </div>
        
        <div class="footer-bottom" style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; text-align: left;">
            <p style="margin: 0; color: var(--text-muted); font-size: 0.95rem;">&copy; 2026 Hanoti - Projet de Fin d'Études BTS. Tous droits réservés.</p>
            <div style="display: flex; gap: 1.5rem; font-size: 0.9rem;">
                <a href="#" style="color: var(--text-muted); text-decoration: none;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">Conditions d'utilisation</a>
                <span style="color: var(--glass-border);">|</span>
                <a href="#" style="color: var(--text-muted); text-decoration: none;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">Politique de confidentialité</a>
            </div>
        </div>
    </footer>
</body>
</html>
