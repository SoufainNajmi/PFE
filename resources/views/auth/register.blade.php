@extends('layout')

@section('content')
<div class="glass-panel animate-fade-in" style="max-width: 500px; margin: 0 auto;">
    <h2 style="text-align: center; margin-bottom: 2rem;">Créer un compte</h2>
    <form action="/register" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom complet / Raison sociale</label>
            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
            @error('name')
                <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Adresse Email</label>
            <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
            @error('email')
                <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="role">Je suis un...</label>
            <select id="role" name="role" class="form-control" required>
                <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Client (Moul Hanout)</option>
                <option value="fournisseur" {{ request('role') == 'fournisseur' ? 'selected' : '' }}>Fournisseur (Grossiste)</option>
            </select>
            @error('role')
                <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
            <a href="/login" style="font-size: 0.875rem;">Déjà inscrit ? Connexion</a>
            <button type="submit" class="btn">S'inscrire</button>
        </div>
    </form>
</div>
@endsection
