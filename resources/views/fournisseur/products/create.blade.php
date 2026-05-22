@extends('layout')

@section('content')
<div class="glass-panel animate-fade-in" style="max-width: 800px; margin: 0 auto;">
    <h2 style="margin-bottom: 2rem;">Ajouter un Produit</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid">
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="name">Nom du produit</label>
                <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
            </div>
            
            <div class="form-group">
                <label for="price">Prix unitaire (DH)</label>
                <input type="number" step="0.01" id="price" name="price" class="form-control" required value="{{ old('price') }}">
            </div>
            
            <div class="form-group">
                <label for="stock">Stock disponible</label>
                <input type="number" id="stock" name="stock" class="form-control" required value="{{ old('stock') }}">
            </div>
            
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="category_id">Catégorie</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>
            
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="image">Image du produit</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
            </div>
        </div>
        
        <div style="margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('fournisseur.dashboard') }}" class="btn" style="background: transparent; border: 1px solid var(--glass-border);">Annuler</a>
            <button type="submit" class="btn">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
