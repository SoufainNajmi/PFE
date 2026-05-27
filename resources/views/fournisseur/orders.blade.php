@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Commandes Reçues</h2>
</div>

<div class="glass-panel">
    @if($orders->isEmpty())
        <p style="color: var(--text-muted); text-align: center;">Aucune commande reçue pour le moment.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>N° Commande</th>
                    <th>Client (Moul Hanout)</th>
                    <th>Date</th>
                    <th>Produits</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Facture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $order->client->name }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <ul style="list-style: none; padding: 0; margin: 0; font-size: 0.875rem; color: var(--text-muted);">
                            @foreach($order->items as $item)
                                @if($item->product && $item->product->fournisseur_id == auth()->id())
                                    <li>{{ $item->quantity }}x {{ $item->product->name }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ number_format($order->total_price, 2) }} DH</td>
                    <td>
                        @if($order->status === 'pending')
                            <span class="badge badge-pending">En attente</span>
                        @elseif($order->status === 'processing')
                            <span class="badge" style="background: rgba(99, 102, 241, 0.2); color: var(--primary);">En cours</span>
                        @elseif($order->status === 'completed')
                            <span class="badge badge-approved">Terminée</span>
                        @elseif($order->status === 'cancelled')
                            <span class="badge badge-rejected">Annulée</span>
                        @endif
                    </td>
                    <td>
                        @if($order->invoice)
                            <a href="{{ route('fournisseur.orders.invoice', $order->id) }}" class="btn" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; background: var(--secondary);" title="N° {{ $order->invoice->invoice_number }}">📄 Télécharger PDF</a>
                        @elseif($order->status === 'completed')
                            <span style="font-size: 0.8rem; color: var(--text-muted);">En génération...</span>
                        @else
                            <span style="font-size: 0.8rem; color: var(--text-muted);">-</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('fournisseur.orders.status', $order->id) }}" method="POST" style="display: flex; gap: 0.5rem; align-items: center;">
                            @csrf
                            <select name="status" class="form-control" style="padding: 0.25rem; font-size: 0.875rem; width: auto;" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>En cours</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Terminée</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
