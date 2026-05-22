@extends('layout')

@section('content')
<div class="glass-panel animate-fade-in" style="max-width: 500px; margin: 0 auto;">
    <h2 style="text-align: center; margin-bottom: 2rem;">Connexion</h2>
    <form action="/login" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Adresse Email</label>
            <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
            @error('email')
                <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
            <a href="/register" style="font-size: 0.875rem;">Créer un compte</a>
            <button type="submit" class="btn">Se connecter</button>
        </div>
    </form>
</div>
@endsection
