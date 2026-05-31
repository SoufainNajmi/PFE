@extends('layout')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <h2 style="margin-bottom: 2rem; text-align: center;">Contacter le Support Administrateur</h2>

    <div class="glass-panel">
        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">
            Besoin d'aide ? Une question sur votre espace ou une commande ? Envoyez-nous un message et notre équipe vous répondra dans les plus brefs délais.
        </p>

        <form action="{{ route('support.store') }}" method="POST">
            @csrf
            
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="subject" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Sujet</label>
                <input type="text" id="subject" name="subject" class="form-input" style="width: 100%;" required placeholder="Ex: Problème avec une commande, question générale...">
                @error('subject')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 2rem;">
                <label for="message" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Votre message</label>
                <textarea id="message" name="message" class="form-input" rows="6" style="width: 100%; resize: vertical;" required placeholder="Détaillez votre demande ici..."></textarea>
                @error('message')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" class="btn" style="width: 100%;">Envoyer le message</button>
            </div>
        </form>
    </div>
</div>
@endsection
