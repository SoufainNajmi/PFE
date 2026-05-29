@extends('layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Messages du Support</h2>
</div>

<div class="glass-panel">
    @if($tickets->isEmpty())
        <p style="color: var(--text-muted); text-align: center;">Aucun message de support pour le moment.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Utilisateur</th>
                    <th>Rôle</th>
                    <th>Sujet</th>
                    <th>Message</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td style="white-space: nowrap;">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <strong>{{ $ticket->user->name }}</strong>
                        </div>
                        <span style="font-size: 0.8rem; color: var(--text-muted);">{{ $ticket->user->email }}</span>
                    </td>
                    <td>
                        <span class="badge" style="background: var(--dark-lighter); border: 1px solid var(--glass-border);">
                            {{ ucfirst($ticket->user->role) }}
                        </span>
                    </td>
                    <td style="font-weight: 500;">{{ $ticket->subject }}</td>
                    <td style="max-width: 300px; white-space: normal; line-height: 1.4;">
                        {{ $ticket->message }}
                    </td>
                    <td>
                        @if($ticket->status === 'resolved')
                            <span class="badge bg-success">Résolu</span>
                        @else
                            <span class="badge bg-warning" style="background: #f59e0b; color: white;">En attente</span>
                        @endif
                    </td>
                    <td>
                        @if($ticket->status === 'pending')
                        <form action="{{ route('admin.support.resolve', $ticket->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn" style="background: var(--success); padding: 0.25rem 0.75rem; font-size: 0.875rem;">Marquer Résolu</button>
                        </form>
                        @else
                        <span style="color: var(--text-muted); font-size: 0.875rem;">Fermé</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
