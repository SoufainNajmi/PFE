@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Tableau de Bord Fournisseur</h2>
    <a href="{{ route('products.create') }}" class="btn">Ajouter un produit</a>
</div>

<div class="grid" style="margin-bottom: 2rem;">
    <div class="glass-panel" style="padding: 1.5rem;">
        <h4 style="color: var(--text-muted); margin-bottom: 0.5rem;">Mes Produits</h4>
        <h2 style="font-size: 2.5rem; color: var(--primary);">{{ $productsCount }}</h2>
    </div>
    <div class="glass-panel" style="padding: 1.5rem;">
        <h4 style="color: var(--text-muted); margin-bottom: 0.5rem;">Commandes Reçues</h4>
        <h2 style="font-size: 2.5rem; color: var(--success);">{{ $ordersCount }}</h2>
    </div>
</div>

<div class="glass-panel" style="margin-bottom: 2rem;">
    <h3>Mes Derniers Produits</h3>
    @if($recentProducts->isEmpty())
        <p style="color: var(--text-muted);">Vous n'avez pas encore ajouté de produits.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentProducts as $product)
                <tr>
                    <td>
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/100x100/1e293b/ffffff?text=Img' }}" width="50" height="50" style="border-radius: 0.5rem; object-fit: cover;">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }} DH</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; background: var(--secondary);">Modifier</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
