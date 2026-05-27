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
    <div class="glass-panel" style="padding: 1.5rem; position: relative;">
        <h4 style="color: var(--text-muted); margin-bottom: 0.5rem;">Commandes Reçues</h4>
        <h2 style="font-size: 2.5rem; color: var(--success);">{{ $ordersCount }}</h2>
        <a href="{{ route('fournisseur.orders') }}" class="btn" style="position: absolute; right: 1.5rem; top: 1.5rem; background: var(--secondary); padding: 0.5rem 1rem;">Voir l'historique</a>
    </div>
</div>

@if($pendingOrders && $pendingOrders->count() > 0)
<div class="glass-panel" style="margin-bottom: 2rem; border-left: 4px solid var(--primary);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h3 style="margin: 0; display: flex; align-items: center; gap: 0.5rem;">
            🔔 Nouvelles commandes à valider
            <span class="badge badge-pending">{{ $pendingOrders->count() }}</span>
        </h3>
    </div>
    <div style="display: flex; flex-direction: column; gap: 1rem;">
        @foreach($pendingOrders as $order)
        <div style="background: rgba(255, 255, 255, 0.03); border-radius: 0.5rem; padding: 1rem; display: flex; justify-content: space-between; align-items: center; border: 1px solid rgba(255, 255, 255, 0.05);">
            <div>
                <strong style="font-size: 1.1rem; color: var(--primary);">Commande #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong>
                <p style="margin: 0.25rem 0 0 0; font-size: 0.9rem; color: var(--text-muted);">
                    Reçue de <strong>{{ $order->client->name }}</strong> le {{ $order->created_at->format('d/m/Y H:i') }}
                </p>
                <div style="margin-top: 0.5rem; font-size: 0.85rem;">
                    @foreach($order->items as $item)
                        @if($item->product && $item->product->fournisseur_id == auth()->id())
                            <span style="background: rgba(255,255,255,0.1); padding: 0.1rem 0.4rem; border-radius: 0.25rem; margin-right: 0.25rem;">{{ $item->quantity }}x {{ $item->product->name }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
            <div style="text-align: right; min-width: 150px;">
                <div style="font-weight: bold; margin-bottom: 0.5rem; font-size: 1.1rem;">{{ number_format($order->total_price, 2) }} DH</div>
                <form action="{{ route('fournisseur.orders.status', $order->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="processing">
                    <button type="submit" class="btn" style="background: var(--success); border: none; padding: 0.5rem 1rem; width: 100%;">Valider la commande ✓</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

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
