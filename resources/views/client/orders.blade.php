@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Mes Commandes</h2>
    <a href="{{ route('client.order.create') }}" class="btn">Nouvelle Commande</a>
</div>

<div class="glass-panel">
    @if($orders->isEmpty())
        <p style="color: var(--text-muted); text-align: center;">Vous n'avez passé aucune commande.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>N° Commande</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Facture</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
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
                            <span style="color: var(--text-muted); font-size: 0.875rem;">{{ $order->invoice->invoice_number }}</span>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
