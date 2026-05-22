@extends('layout')

@section('content')
<div class="glass-panel animate-fade-in" style="max-width: 800px; margin: 0 auto;">
    <h2 style="margin-bottom: 2rem;">Modifier le Produit</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid">
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="name">Nom du produit</label>
                <input type="text" id="name" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
            </div>
            
            <div class="form-group">
                <label for="price">Prix unitaire (DH)</label>
                <input type="number" step="0.01" id="price" name="price" class="form-control" required value="{{ old('price', $product->price) }}">
            </div>
            
            <div class="form-group">
                <label for="stock">Stock disponible</label>
                <input type="number" id="stock" name="stock" class="form-control" required value="{{ old('stock', $product->stock) }}">
            </div>
            
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="category_id">Catégorie</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
            </div>
            
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="image">Image du produit (Laissez vide pour conserver l'actuelle)</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                @if($product->image)
                    <div style="margin-top: 1rem;">
                        <img src="{{ asset('storage/'.$product->image) }}" width="100" style="border-radius: 0.5rem;">
                    </div>
                @endif
            </div>
        </div>
        
        <div style="margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('fournisseur.dashboard') }}" class="btn" style="background: transparent; border: 1px solid var(--glass-border);">Annuler</a>
            <button type="submit" class="btn">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
