@extends('layout')

@section('content')
<style>


 .hero-section{
        /* Image uploadée comme background avec un effet d'overlay */
       background-image: url('{{ asset("asset/image/back2.png") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
            /* Ajout d'une légère animation de gradient pour dynamiser le background */




 }
    /* ========== ANIMATIONS & KEYFRAMES ========== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4);
        }
        70% {
            box-shadow: 0 0 0 15px rgba(99, 102, 241, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
        }
    }

    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    @keyframes glowPulse {
        0% {
            opacity: 0.3;
            transform: translate(-50%, -50%) scale(1);
        }
        100% {
            opacity: 0.6;
            transform: translate(-50%, -50%) scale(1.2);
        }
    }

    /* ========== CLASSES D'ANIMATION ========== */
    .animate-fade-up {
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards;
    }

    .animate-fade-left {
        opacity: 0;
        animation: fadeInLeft 0.8s ease forwards;
    }

    .animate-fade-right {
        opacity: 0;
        animation: fadeInRight 0.8s ease forwards;
    }

    .animate-zoom {
        opacity: 0;
        animation: zoomIn 0.6s ease forwards;
    }

    .delay-1 {
        animation-delay: 0.2s;
    }
    .delay-2 {
        animation-delay: 0.4s;
    }
    .delay-3 {
        animation-delay: 0.6s;
    }
    .delay-4 {
        animation-delay: 0.8s;
    }

    /* Éléments visibles après scroll (reveal) */
    .reveal {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* ========== AMÉLIORATIONS VISUELLES ========== */
    .hero-section {
        position: relative;
        overflow: hidden;
    }

    .glow-circle {
        position: fixed;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        filter: blur(100px);
        z-index: -1;
        animation: float 8s ease-in-out infinite;
    }

    .glow-1 {
        background: rgba(99, 102, 241, 0.4);
        top: 10%;
        left: -100px;
        animation-delay: 0s;
    }

    .glow-2 {
        background: rgba(236, 72, 153, 0.3);
        bottom: 10%;
        right: -100px;
        animation-delay: 2s;
    }

    /* Cartes améliorées */
    .card {
        transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(4px);
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.6s ease;
        pointer-events: none;
    }

    .card:hover::before {
        left: 100%;
    }

    .card:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.5);
        border-color: rgba(255,255,255,0.3);
    }

    .feature-icon {
        font-size: 3rem;
        margin-bottom: 1.2rem;
        transition: transform 0.3s ease;
        display: inline-block;
    }

    .card:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
    }

    /* Boutons améliorés */
    .btn {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        z-index: 1;
    }

    .btn::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        transform: translate(-50%, -50%);
        transition: width 0.5s ease, height 0.5s ease;
        z-index: -1;
    }

    .btn:hover::after {
        width: 300px;
        height: 300px;
    }

    .btn:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.3);
    }

    .btn:active {
        transform: scale(0.98);
    }

    /* Liens avec effet souligné */
    a:not(.btn) {
        position: relative;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    a:not(.btn)::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 0%;
        height: 2px;
        background: currentColor;
        transition: width 0.3s ease;
    }

    a:not(.btn):hover::after {
        width: 100%;
    }

    /* Glass panel amélioré */
    .glass-panel {
        backdrop-filter: blur(12px);
        border-radius: 2rem;
        transition: all 0.4s ease;
    }

    .glass-panel:hover {
        backdrop-filter: blur(16px);
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.3);
    }

    /* Badge ou texte animé */
    .pulse-animation {
        animation: pulse 2s infinite;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .hero-title {
            font-size: 2.5rem !important;
        }
        .about-title {
            font-size: 2.3rem !important;
        }
        .about-section, section {
            margin-top: 4rem !important;
            margin-bottom: 4rem !important;
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem !important;
        }
        .hero-subtitle {
            font-size: 1rem !important;
            padding: 0 1rem;
        }
        .grid {
            gap: 1.5rem !important;
        }
        .card {
            margin: 0 0.5rem;
        }
        .glow-circle {
            width: 150px;
            height: 150px;
            filter: blur(50px);
        }
        .glass-panel {
            padding: 2.5rem 1.5rem !important;
        }
        .flex-container {
            gap: 2rem !important;
        }
        .about-title {
            font-size: 2rem !important;
        }
        .stats-container {
            gap: 1rem !important;
        }
        .stats-container .card {
            min-width: 120px !important;
            padding: 1rem !important;
        }
        .stats-container span:first-child {
            font-size: 2rem !important;
        }
        h2 {
            font-size: 1.8rem !important;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 1.6rem !important;
        }
        .hero-buttons {
            flex-direction: column;
            gap: 1rem !important;
            width: 100%;
            padding: 0 1rem;
        }
        .hero-buttons .btn {
            width: 100%;
            text-align: center;
        }
        .glow-1 {
            left: -50px;
            top: 5%;
        }
        .glow-2 {
            right: -50px;
            bottom: 5%;
        }
        .admin-float-btn {
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            font-size: 1.4rem;
        }
        .glass-panel {
            padding: 2rem 1rem !important;
            border-radius: 1.5rem;
        }
        /* Ajustement du badge sur l'image pour écran très petit */
        .glass-panel.about-badge {
            bottom: -5%;
            right: -5%;
            padding: 1rem !important;
            align-items: center;
            gap: 0.5rem;
        }
        .glass-panel.about-badge div:first-child {
            width: 35px !important;
            height: 35px !important;
            font-size: 1.2rem !important;
        }
        .glass-panel.about-badge h4 {
            font-size: 1rem !important;
        }
        .stats-container {
            flex-direction: column;
        }
        .stats-container .card {
            width: 100%;
            margin: 0;
        }
    }

    /* Support reduced motion */
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
            scroll-behavior: auto !important;
        }
    }

    /* Floating Admin Shape */
    .admin-float-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 65px;
        height: 65px;
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(139, 92, 246, 0.4);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        z-index: 999;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5), 0 0 15px rgba(139, 92, 246, 0.2);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none;
    }

    .admin-float-btn:hover {
        transform: translateY(-8px) rotate(8deg);
        box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.6), 0 0 30px rgba(139, 92, 246, 0.5);
        border-color: rgba(139, 92, 246, 0.9);
        background: rgba(30, 41, 59, 0.9);
    }
</style>

<!-- Decorative Background Elements -->
<div class="glow-circle glow-1"> </div>
<div class="glow-circle glow-2"></div>

<section class="hero-section">
    <div class="glass-panel animate-zoom" style="max-width: 900px; padding: 4rem 2rem; background: rgba(48, 72, 109, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); text-align: center;">
        <div style="display: flex; justify-content: center; margin-bottom: 2rem;">
            <img src="{{ asset('asset/image/logo.png') }}" alt="Hanoti Logo" style="width: 130px; height: 130px; border-radius: 50%; object-fit: cover; border: 4px solid rgba(255, 255, 255, 0.2); box-shadow: 0 10px 30px rgba(0,0,0,0.4); animation: float 6s ease-in-out infinite;">
        </div>
        <h1 class="hero-title" style="font-size: 3rem; font-weight: 800; background: linear-gradient(135deg, #fff, #a5b4fc, #c084fc); background-size: 200% auto; -webkit-background-clip: text; background-clip: text; color: transparent; animation: gradientShift 6s ease infinite;">Révolutionnez votre approvisionnement.</h1>
        <p class="hero-subtitle" style="font-size: 1.2rem; margin-top: 1.5rem; color: var(--text-muted); max-width: 700px; margin-left: auto; margin-right: auto;">
            Hanoti connecte instantanément les détaillants (Moul Hanout) aux meilleurs grossistes. Simplifiez vos commandes, suivez vos livraisons et développez votre commerce avec notre plateforme B2B innovante.
        </p>
        <div class="hero-buttons" style="display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap; margin-top: 2.5rem;">
            <a href="/products" class="btn pulse-animation" style="font-size: 1.1rem; padding: 1rem 2rem; border-radius: 3rem; background: linear-gradient(135deg, #4f46e5, #7c3aed); border: none;">Explorer le Catalogue →</a>
            @guest
                <a href="/register" class="btn" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); font-size: 1.1rem; padding: 1rem 2rem; border-radius: 3rem; color: var(--text-main);">Commencer gratuitement </a>
            @endguest
        </div>
    </div>
</section>

<section style="margin-top: 2rem; margin-bottom: 6rem;">
    <div style="text-align: center; margin-bottom: 4rem;" class="reveal">
        <h2 style="font-size: 2.5rem; margin-bottom: 1rem; background: linear-gradient(120deg, #e0e7ff, #c7d2fe); -webkit-background-clip: text; background-clip: text; color: transparent;">Pourquoi choisir Hanoti ?</h2>
        <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">Une plateforme conçue spécifiquement pour les besoins du marché marocain, alliant simplicité, rapidité et sécurité.</p>
    </div>

    <div class="grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">

        <!-- Carte 1 : Détaillant -->
        <div class="card reveal delay-1" style="background: rgba(30, 41, 59, 0.6); border: 1px solid rgba(255,255,255,0.05); border-radius: 1.5rem; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 10px 30px -10px rgba(0,0,0,0.5);">
            <div style="height: 220px; overflow: hidden; position: relative;">
                <img src="{{ asset('asset/image/img1.png') }}" alt="Pour le Détaillant" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);" class="card-img-hover" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 50%; background: linear-gradient(to top, rgba(30, 41, 59, 1) 0%, transparent 100%); pointer-events: none;"></div>
                <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.5); backdrop-filter: blur(8px); width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 50%; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                    <span style="font-size: 1.3rem;">H</span>
                </div>
            </div>
            <div class="card-body" style="padding: 2rem; padding-top: 1rem; flex: 1; display: flex; flex-direction: column;">
                <h3 style="font-size: 1.6rem; margin-bottom: 1rem; color: #fff;">Pour le Détaillant</h3>
                <p style="color: var(--text-muted); margin-bottom: 2rem; line-height: 1.6; flex: 1;">
                    Fini les ruptures de stock. Commandez vos produits à n'importe quelle heure, comparez les prix des fournisseurs et suivez l'état de vos livraisons en temps réel.
                </p>
                <div style="margin-top: auto;">
                    <a href="/register?role=client" style="font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; color: var(--tertiary); transition: all 0.3s ease; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 0.5px;" onmouseover="this.style.gap='0.8rem'" onmouseout="this.style.gap='0.5rem'">Devenir Client <span style="font-size: 1.2rem;">→</span></a>
                </div>
            </div>
        </div>

        <!-- Carte 2 : Grossiste -->
        <div class="card reveal delay-2" style="background: rgba(30, 41, 59, 0.6); border: 1px solid rgba(255,255,255,0.05); border-radius: 1.5rem; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 10px 30px -10px rgba(0,0,0,0.5);">
            <div style="height: 220px; overflow: hidden; position: relative;">
                <img src="{{ asset('asset/image/img2.png') }}" alt="Pour le Grossiste" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);" class="card-img-hover" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 50%; background: linear-gradient(to top, rgba(30, 41, 59, 1) 0%, transparent 100%); pointer-events: none;"></div>
                <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.5); backdrop-filter: blur(8px); width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 50%; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                    <span style="font-size: 1.3rem;">H</span>
                </div>
            </div>
            <div class="card-body" style="padding: 2rem; padding-top: 1rem; flex: 1; display: flex; flex-direction: column;">
                <h3 style="font-size: 1.6rem; margin-bottom: 1rem; color: #fff;">Pour le Grossiste</h3>
                <p style="color: var(--text-muted); margin-bottom: 2rem; line-height: 1.6; flex: 1;">
                    Digitalisez vos ventes. Atteignez un réseau national de boutiques, gérez votre catalogue en quelques clics et automatisez la facturation de vos commandes.
                </p>
                <div style="margin-top: auto;">
                    <a href="/register?role=fournisseur" style="font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; color: var(--primary); transition: all 0.3s ease; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 0.5px;" onmouseover="this.style.gap='0.8rem'" onmouseout="this.style.gap='0.5rem'">Devenir Fournisseur <span style="font-size: 1.2rem;">→</span></a>
                </div>
            </div>
        </div>

        <!-- Carte 3 : Transactions Sécurisées -->
        <div class="card reveal delay-3" style="background: rgba(30, 41, 59, 0.6); border: 1px solid rgba(255,255,255,0.05); border-radius: 1.5rem; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 10px 30px -10px rgba(0,0,0,0.5);">
            <div style="height: 220px; overflow: hidden; position: relative;">
                <img src="{{ asset('asset/image/img3.png') }}" alt="Transactions Sécurisées" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);" class="card-img-hover" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 50%; background: linear-gradient(to top, rgba(30, 41, 59, 1) 0%, transparent 100%); pointer-events: none;"></div>
                <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.5); backdrop-filter: blur(8px); width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 50%; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                    <span style="font-size: 1.3rem;">H</span>
                </div>
            </div>
            <div class="card-body" style="padding: 2rem; padding-top: 1rem; flex: 1; display: flex; flex-direction: column;">
                <h3 style="font-size: 1.6rem; margin-bottom: 1rem; color: #fff;">Transactions Sécurisées</h3>
                <p style="color: var(--text-muted); margin-bottom: 2rem; line-height: 1.6; flex: 1;">
                  Notre infrastructure garantit la confidentialité totale de vos prix, clients et historiques de commandes.
                </p>
                <div style="margin-top: auto;">
                    <span style="font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; color: var(--success); background: rgba(16, 185, 129, 0.1); padding: 0.4rem 1rem; border-radius: 2rem; border: 1px solid rgba(16, 185, 129, 0.2); font-size: 0.9rem;">✓ Fiabilité garantie</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section" style="margin-top: 6rem; margin-bottom: 8rem; position: relative; overflow: visible;">
    <div class="flex-container" style="display: flex; flex-wrap: wrap; align-items: center; gap: 4rem;">

        <!-- Image avec animation moderne -->
        <div style="flex: 1; min-width: 300px; position: relative;" class="reveal delay-1">
            <!-- Arrière-plan décoratif pour l'image -->
            <div style="position: absolute; top: -15%; left: -15%; width: 130%; height: 130%; background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 60%); z-index: -1; animation: pulse 4s infinite;"></div>

            <!-- Image animée -->
            <img src="{{ asset('asset/image/back.png') }}" alt="À propos de Hanoti" style="width: 100%; border-radius: 2rem; box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.6); border: 1px solid rgba(255, 255, 255, 0.15); animation: float 6s ease-in-out infinite; transform: perspective(1000px) rotateY(-5deg) translateY(0); transition: transform 0.5s ease;" onmouseover="this.style.transform='perspective(1000px) rotateY(0deg) scale(1.02)'" onmouseout="this.style.transform='perspective(1000px) rotateY(-5deg) scale(1) translateY(0)'">

            <!-- Badge flottant sur l'image -->
            <div class="glass-panel about-badge" style="position: absolute; bottom: 10%; right: -10%; padding: 1.5rem; background: rgba(30, 41, 59, 0.7); display: flex; align-items: center; gap: 1rem; animation: float 5s ease-in-out infinite reverse; border: 1px solid rgba(255,255,255,0.1);">
                <div style="background: linear-gradient(135deg, #4f46e5, #7c3aed); border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">H</div>
                <div>
                    <h4 style="margin: 0; font-size: 1.2rem; font-weight: 700; color: white;">#1 Plateforme</h4>
                    <span style="font-size: 0.9rem; color: var(--text-muted);">B2B au Maroc</span>
                </div>
            </div>
        </div>

        <!-- Textes et statistiques -->
        <div style="flex: 1; min-width: 300px;" class="reveal delay-2">
            <span style="display: inline-block; padding: 0.5rem 1rem; background: rgba(99, 102, 241, 0.2); color: #a5b4fc; border-radius: 2rem; font-size: 0.9rem; font-weight: 600; margin-bottom: 1rem; border: 1px solid rgba(99, 102, 241, 0.3);"> Notre Mission</span>
            <h2 class="about-title" style="font-size: 2.8rem; margin-bottom: 1.5rem; background: linear-gradient(135deg, #fff, #a5b4fc); -webkit-background-clip: text; background-clip: text; color: transparent; line-height: 1.2;">Réinventer le Commerce de Proximité</h2>

            <p style="color: var(--text-muted); font-size: 1.15rem; line-height: 1.8; margin-bottom: 1.5rem;">
                Hanoti est né d'une vision très claire : moderniser et faciliter les échanges commerciaux entre les détaillants (Moul Hanout) et les grossistes du Maroc.
            </p>
            <p style="color: var(--text-muted); font-size: 1.15rem; line-height: 1.8; margin-bottom: 2rem;">
                Nous combinons la force du digital avec l'authenticité de notre marché traditionnel. Le résultat ? Une fluidité inédite, des coûts maîtrisés, et la garantie d'une croissance mutuelle pour tous les acteurs.
            </p>

            <div class="stats-container" style="display: flex; gap: 1.5rem; margin-top: 2.5rem; flex-wrap: wrap;">
                <div class="card" style="flex: 1; text-align: center; background: rgba(30, 41, 59, 0.4); padding: 1.5rem; border-radius: 1.5rem; border: 1px solid rgba(255,255,255,0.05); min-width: 140px;">
                    <span style="display: block; font-size: 2.8rem; font-weight: 800; background: linear-gradient(135deg, #60a5fa, #3b82f6); -webkit-background-clip: text; background-clip: text; color: transparent; margin-bottom: 0.5rem;">100%</span>
                    <span style="color: var(--text-muted); font-size: 0.95rem; font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Digital</span>
                </div>
                <div class="card" style="flex: 1; text-align: center; background: rgba(30, 41, 59, 0.4); padding: 1.5rem; border-radius: 1.5rem; border: 1px solid rgba(255,255,255,0.05); min-width: 140px; animation-delay: 0.2s;">
                    <span style="display: block; font-size: 2.8rem; font-weight: 800; background: linear-gradient(135deg, #f472b6, #db2777); -webkit-background-clip: text; background-clip: text; color: transparent; margin-bottom: 0.5rem;">24/7</span>
                    <span style="color: var(--text-muted); font-size: 0.95rem; font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Disponible</span>
                </div>
            </div>

            <div style="margin-top: 2rem;">
               <a href="/register" style="display: inline-flex; align-items: center; gap: 0.75rem; color: #fff; font-weight: 600; text-decoration: none; padding-bottom: 4px; border-bottom: 2px solid #6366f1; transition: all 0.3s ease;" onmouseover="this.style.gap='1.2rem'; this.style.color='#a5b4fc';" onmouseout="this.style.gap='0.75rem'; this.style.color='#fff';">
                   Découvrez notre histoire <span style="font-size: 1.2rem;">→</span>
               </a>
            </div>
        </div>
    </div>
</section>

<section class="glass-panel reveal delay-4" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(236, 72, 153, 0.15) 100%); margin-bottom: 4rem; padding: 0; border-radius: 2rem; overflow: hidden;">
    <div style="display: flex; flex-wrap: wrap; align-items: stretch;">
        <div style="flex: 1 1 400px; padding: 4rem 3rem; display: flex; flex-direction: column; justify-content: center;">
            <h2 style="font-size: 2.2rem; margin-bottom: 1.5rem; line-height: 1.3;">Prêt à moderniser votre commerce ?</h2>
            <p style="color: var(--text-muted); margin-bottom: 2.5rem; font-size: 1.15rem; line-height: 1.6;">Rejoignez des centaines de professionnels qui utilisent déjà Hanoti au quotidien pour booster leur activité.</p>
            <div>
                <a href="/register" class="btn pulse-animation" style="font-size: 1.1rem; padding: 1rem 2.5rem; border-radius: 3rem; background: linear-gradient(135deg, #8b5cf6, #ec4899); border: none; color: white;">Créer mon compte maintenant </a>
            </div>
        </div>
        <div style="flex: 1 1 400px; position: relative; min-height: 350px; overflow: hidden;">
            <img src="{{ asset('asset/image/img5.png') }}" alt="Rejoignez Hanoti" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; transition: transform 0.8s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(30, 41, 59, 1) 0%, transparent 30%); pointer-events: none;"></div>
        </div>
    </div>
</section>

<!-- Forme pour l'accès Admin -->
<a href="{{ auth()->check() && auth()->user()->role === 'admin' ? '/admin/dashboard' : '/login' }}" class="admin-float-btn" title="Accès Dashboard Admin">
    🛡️
</a>

<script>
    // Révélation au scroll (Intersection Observer)
    document.addEventListener('DOMContentLoaded', function() {
        const reveals = document.querySelectorAll('.reveal');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2, rootMargin: '0px 0px -50px 0px' });

        reveals.forEach(reveal => {
            observer.observe(reveal);
        });

        // Appliquer les animations d'entrée immédiates sur les éléments avec classes d'animation
        document.querySelectorAll('.animate-fade-up, .animate-fade-left, .animate-fade-right, .animate-zoom').forEach(el => {
            el.style.opacity = '1';
        });
    });

    // Effet de suivi de souris pour les glow circles (optionnel, ajoute du dynamisme)
    document.addEventListener('mousemove', function(e) {
        const glow1 = document.querySelector('.glow-1');
        const glow2 = document.querySelector('.glow-2');
        if (glow1 && glow2) {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            glow1.style.transform = `translate(${x * 20}px, ${y * 20}px)`;
            glow2.style.transform = `translate(${-x * 20}px, ${-y * 20}px)`;
        }
    });
</script>
@endsection
