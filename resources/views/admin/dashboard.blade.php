@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Tableau de Bord Administrateur</h2>
</div>

<div class="grid" style="margin-bottom: 2rem;">
    <div class="glass-panel" style="padding: 1.5rem;">
        <h4 style="color: var(--text-muted); margin-bottom: 0.5rem;">Total Commandes</h4>
        <h2 style="font-size: 2.5rem; color: var(--primary);">{{ $ordersCount }}</h2>
    </div>
    <div class="glass-panel" style="padding: 1.5rem;">
        <h4 style="color: var(--text-muted); margin-bottom: 0.5rem;">Revenus (Commandes Terminées)</h4>
        <h2 style="font-size: 2.5rem; color: var(--success);">{{ number_format($revenue, 2) }} DH</h2>
    </div>
    <div class="glass-panel" style="padding: 1.5rem;">
        <h4 style="color: var(--text-muted); margin-bottom: 0.5rem;">Clients Inscrits</h4>
        <h2 style="font-size: 2.5rem; color: var(--secondary);">{{ $clients->count() }}</h2>
    </div>
</div>

<div class="glass-panel" style="margin-bottom: 2rem;">
    <h3>Fournisseurs en attente de validation ({{ $pendingFournisseurs->count() }})</h3>
    @if($pendingFournisseurs->isEmpty())
        <p style="color: var(--text-muted);">Aucun fournisseur en attente.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nom / Raison Sociale</th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingFournisseurs as $fournisseur)
                <tr>
                    <td>{{ $fournisseur->name }}</td>
                    <td>{{ $fournisseur->email }}</td>
                    <td>{{ $fournisseur->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.fournisseurs.approve', $fournisseur->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn" style="background: var(--success); padding: 0.5rem 1rem; font-size: 0.875rem;">Approuver</button>
                        </form>
                        <form action="{{ route('admin.fournisseurs.reject', $fournisseur->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Rejeter</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div class="glass-panel">
    <h3>Fournisseurs Approuvés ({{ $approvedFournisseurs->count() }})</h3>
    @if($approvedFournisseurs->isEmpty())
        <p style="color: var(--text-muted);">Aucun fournisseur approuvé.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nom / Raison Sociale</th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($approvedFournisseurs as $fournisseur)
                <tr>
                    <td>{{ $fournisseur->name }}</td>
                    <td>{{ $fournisseur->email }}</td>
                    <td>{{ $fournisseur->created_at->format('d/m/Y H:i') }}</td>
                    <td><span class="badge badge-approved">Approuvé</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
