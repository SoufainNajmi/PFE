@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Mon Panier</h2>
</div>

<div class="glass-panel">
    @if(session('cart') && count(session('cart')) > 0)
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $details)
                <tr>
                    <td style="display: flex; align-items: center; gap: 1rem;">
                        <img src="{{ $details['image'] ? asset('storage/'.$details['image']) : 'https://placehold.co/100x100/1e293b/ffffff?text=Img' }}" width="50" height="50" style="border-radius: 0.5rem; object-fit: cover;">
                        {{ $details['name'] }}
                    </td>
                    <td>{{ number_format($details['price'], 2) }} DH</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>{{ number_format($details['price'] * $details['quantity'], 2) }} DH</td>
                    <td>
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">Retirer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
            <div style="background: var(--dark-lighter); padding: 1.5rem; border-radius: 0.5rem; min-width: 300px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: var(--text-muted);">Total</span>
                    <strong style="font-size: 1.5rem; color: var(--success);">{{ number_format($total, 2) }} DH</strong>
                </div>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn" style="width: 100%;">Valider la Commande</button>
                </form>
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 3rem;">
            <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Votre panier est actuellement vide.</p>
            <a href="{{ route('products.index') }}" class="btn">Continuer mes achats</a>
        </div>
    @endif
</div>
@endsection
