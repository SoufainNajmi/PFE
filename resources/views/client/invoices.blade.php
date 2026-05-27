@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Mes Factures (Client)</h2>
</div>

<div class="glass-panel">
    @if($orders->isEmpty())
        <p style="color: var(--text-muted); text-align: center;">Aucune facture disponible pour le moment.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>N° Facture</th>
                    <th>N° Commande</th>
                    <th>Date d'émission</th>
                    <th>Montant Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td><strong>{{ $order->invoice->invoice_number }}</strong></td>
                    <td>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $order->invoice->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($order->invoice->total, 2) }} DH</td>
                    <td>
                        <a href="{{ route('client.orders.invoice', $order->id) }}" class="btn" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; background: var(--secondary);" title="Télécharger PDF">📄 Télécharger</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
