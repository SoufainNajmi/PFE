@extends('layout')

@section('content')
<style>


 .hero-section{
        background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bWFya2V0fGVufDB8fDB8fHww&auto=format&fit=crop&w=800&q=60');
        background-size: cover;
        background-position: center;
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
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem !important;
        }
        .grid {
            gap: 1.5rem !important;
        }
        .card {
            margin: 0 1rem;
        }
        .glow-circle {
            width: 150px;
            height: 150px;
            filter: blur(60px);
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
</style>

<!-- Decorative Background Elements -->
<div class="glow-circle glow-1"> </div>
<div class="glow-circle glow-2"></div>

<section class="hero-section">
    <div class="glass-panel animate-zoom" style="max-width: 900px; padding: 4rem 2rem; background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); text-align: center;">
        <h1 class="hero-title" style="font-size: 3rem; font-weight: 800; background: linear-gradient(135deg, #fff, #a5b4fc, #c084fc); background-size: 200% auto; -webkit-background-clip: text; background-clip: text; color: transparent; animation: gradientShift 6s ease infinite;">Révolutionnez votre approvisionnement.</h1>
        <p class="hero-subtitle" style="font-size: 1.2rem; margin-top: 1.5rem; color: var(--text-muted); max-width: 700px; margin-left: auto; margin-right: auto;">
            Hanoti connecte instantanément les détaillants (Moul Hanout) aux meilleurs grossistes. Simplifiez vos commandes, suivez vos livraisons et développez votre commerce avec notre plateforme B2B innovante.
        </p>
        <div style="display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap; margin-top: 2.5rem;">
            <a href="/products" class="btn pulse-animation" style="font-size: 1.1rem; padding: 1rem 2rem; border-radius: 3rem; background: linear-gradient(135deg, #4f46e5, #7c3aed); border: none;">Explorer le Catalogue →</a>
            @guest
                <a href="/register" class="btn" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); font-size: 1.1rem; padding: 1rem 2rem; border-radius: 3rem; color: var(--text-main);">Commencer gratuitement ✨</a>
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
        <div class="card reveal delay-1" style="background: linear-gradient(180deg, rgba(30, 41, 59, 0.8) 0%, rgba(29, 80, 199, 0.9) 100%); border-radius: 1.5rem; overflow: hidden;">
            <div class="card-body" style="padding: 2rem;">
                <div class="feature-icon" style="color: var(--tertiary);">🛒</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">Pour le Détaillant</h3>
                <p style="color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.6;">
                    Fini les ruptures de stock. Commandez vos produits à n'importe quelle heure, comparez les prix des fournisseurs et suivez l'état de vos livraisons en temps réel.
                </p>
                <a href="/register?role=client" style="font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; color: var(--tertiary);">Devenir Client →</a>
            </div>
        </div>

        <div class="card reveal delay-2" style="background: linear-gradient(180deg, rgba(30, 41, 59, 0.8) 0%, rgba(40, 97, 230, 0.9) 100%); border-radius: 1.5rem;">
            <div class="card-body" style="padding: 2rem;">
                <div class="feature-icon" style="color: var(--primary);">📦</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">Pour le Grossiste</h3>
                <p style="color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.6;">
                    Digitalisez vos ventes. Atteignez un réseau national de boutiques, gérez votre catalogue en quelques clics et automatisez la facturation de vos commandes.
                </p>
                <a href="/register?role=fournisseur" style="font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">Devenir Fournisseur →</a>
            </div>
        </div>

        <div class="card reveal delay-3" style="background: linear-gradient(180deg, rgba(30, 41, 59, 0.8) 0%, rgba(37, 84, 195, 0.9) 100%); border-radius: 1.5rem;">
            <div class="card-body" style="padding: 2rem;">
                <div class="feature-icon" style="color: var(--success);">🔒</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">Transactions Sécurisées</h3>
                <p style="color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.6;">
                    Vos données commerciales sont précieuses. Notre infrastructure garantit la confidentialité totale de vos prix, clients et historiques de commandes.
                </p>
                <span style="font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; color: var(--success);">✓ Fiabilité garantie</span>
            </div>
        </div>
    </div>
</section>

<section class="glass-panel reveal delay-4" style="text-align: center; background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(236, 72, 153, 0.15) 100%); margin-bottom: 4rem; padding: 3rem 2rem; border-radius: 2rem;">
    <h2 style="font-size: 2rem; margin-bottom: 1.5rem;">Prêt à moderniser votre commerce ?</h2>
    <p style="color: var(--text-muted); margin-bottom: 2rem; font-size: 1.1rem;">Rejoignez des centaines de professionnels qui utilisent déjà Hanoti au quotidien.</p>
    <a href="/register" class="btn" style="font-size: 1.1rem; padding: 1rem 2.5rem; border-radius: 3rem; background: linear-gradient(135deg, #8b5cf6, #ec4899);">Créer mon compte maintenant 🚀</a>
</section>

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
