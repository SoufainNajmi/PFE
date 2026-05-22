@extends('layout')

@section('content')
<div class="glass-panel animate-fade-in" style="display: flex; gap: 2rem; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 300px;">
        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/600x400/1e293b/ffffff?text=Produit' }}" alt="{{ $product->name }}" style="width: 100%; border-radius: 1rem; border: 1px solid var(--glass-border);">
    </div>
    <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column; justify-content: center;">
        <h2 style="font-size: 2.5rem; margin-bottom: 0.5rem;">{{ $product->name }}</h2>
        @if($product->category)
        <span class="badge" style="background: var(--dark-lighter); margin-bottom: 1rem; align-self: flex-start;">{{ $product->category->name }}</span>
        @endif
        
        <h3 style="color: var(--success); font-size: 2rem; margin-bottom: 1.5rem;">{{ number_format($product->price, 2) }} DH</h3>
        
        <p style="color: var(--text-muted); line-height: 1.6; margin-bottom: 2rem;">
            {{ $product->description ?: 'Aucune description disponible pour ce produit.' }}
        </p>
        
        <div style="background: rgba(0,0,0,0.2); padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem;">
            <p><strong>Fournisseur:</strong> {{ $product->fournisseur->name }}</p>
            <p><strong>Stock disponible:</strong> {{ $product->stock }} unités</p>
        </div>

        @auth
            @if(auth()->user()->role === 'client')
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn" style="width: 100%; font-size: 1.1rem; padding: 1rem;">Ajouter au panier</button>
            </form>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn" style="text-align: center; font-size: 1.1rem; padding: 1rem;">Connectez-vous pour ajouter</a>
        @endauth
    </div>
</div>
@endsection
