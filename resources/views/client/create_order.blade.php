@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Passer une commande</h2>
</div>

<div class="glass-panel" style="margin-bottom: 2rem;">
    <form action="{{ route('client.order.create') }}" method="GET" style="display: flex; gap: 1rem; align-items: center;">
        <label for="fournisseur_id" style="font-weight: 500;">Sélectionner un fournisseur :</label>
        <select name="fournisseur_id" id="fournisseur_id" class="form-input" style="flex: 1;" onchange="this.form.submit()">
            <option value="">-- Choisissez un fournisseur --</option>
            @foreach($fournisseurs as $fournisseur)
                <option value="{{ $fournisseur->id }}" {{ ($selectedFournisseur && $selectedFournisseur->id == $fournisseur->id) ? 'selected' : '' }}>
                    {{ $fournisseur->name }}
                </option>
            @endforeach
        </select>
    </form>
</div>

@if($selectedFournisseur)
    <div class="glass-panel">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3>Produits de {{ $selectedFournisseur->name }}</h3>
            @if(!$products->isEmpty())
                <input type="text" id="searchInput" placeholder="Rechercher un produit..." class="form-input" style="max-width: 300px;" onkeyup="filterProducts()">
            @endif
        </div>
        
        @if($products->isEmpty())
            <p style="color: var(--text-muted); text-align: center;">Ce fournisseur n'a pas encore de produits.</p>
        @else
            <form action="{{ route('client.order.store') }}" method="POST">
                @csrf
                <input type="hidden" name="fournisseur_id" value="{{ $selectedFournisseur->id }}">
                
                <table id="productsTable">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Stock Disponible</th>
                            <th>Quantité à commander</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td style="display: flex; align-items: center; gap: 1rem;">
                                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/100x100/1e293b/ffffff?text=Img' }}" width="50" height="50" style="border-radius: 0.5rem; object-fit: cover;">
                                {{ $product->name }}
                            </td>
                            <td>{{ number_format($product->price, 2) }} DH</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <input type="number" name="products[{{ $product->id }}]" min="0" max="{{ $product->stock }}" value="0" class="form-input" style="width: 100px;">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn">Confirmer la Commande</button>
                </div>
            </form>

            <script>
                function filterProducts() {
                    const input = document.getElementById('searchInput').value.toLowerCase();
                    const table = document.getElementById('productsTable');
                    const trs = table.getElementsByTagName('tr');

                    for (let i = 1; i < trs.length; i++) {
                        const td = trs[i].getElementsByTagName('td')[0];
                        if (td) {
                            const txtValue = td.textContent || td.innerText;
                            if (txtValue.toLowerCase().indexOf(input) > -1) {
                                trs[i].style.display = "";
                            } else {
                                trs[i].style.display = "none";
                            }
                        }       
                    }
                }
            </script>
        @endif
    </div>
@endif
@endsection
