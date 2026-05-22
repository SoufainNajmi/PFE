@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Nos Produits</h2>
</div>

<div class="grid">
    @forelse($products as $product)
    <div class="card animate-fade-in">
        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/600x400/1e293b/ffffff?text=Produit' }}" alt="{{ $product->name }}">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                <h3 style="margin-bottom: 0;">{{ $product->name }}</h3>
                <span style="font-weight: bold; color: var(--success); font-size: 1.25rem;">{{ number_format($product->price, 2) }} DH</span>
            </div>
            <p style="color: var(--text-muted); margin-bottom: 1rem; font-size: 0.875rem;">
                Fournisseur: {{ $product->fournisseur->name }} <br>
                Stock: {{ $product->stock }}
            </p>
            <div style="display: flex; gap: 0.5rem;">
                <a href="{{ route('products.show', $product->id) }}" class="btn" style="flex: 1; text-align: center; background: var(--dark-lighter); border: 1px solid var(--glass-border);">Détails</a>
                @auth
                    @if(auth()->user()->role === 'client')
                    <form action="{{ route('cart.add') }}" method="POST" style="flex: 1;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn" style="width: 100%;">Ajouter au panier</button>
                    </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn" style="flex: 1; text-align: center;">Ajouter</a>
                @endauth
            </div>
        </div>
    </div>
    @empty
    <div class="glass-panel" style="grid-column: 1 / -1; text-align: center;">
        <p style="color: var(--text-muted);">Aucun produit disponible pour le moment.</p>
    </div>
    @endforelse
</div>
@endsection
