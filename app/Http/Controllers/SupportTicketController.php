<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    public function create()
    {
        return view('support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Votre message a été envoyé au support avec succès. Nous vous répondrons dans les plus brefs délais.');
    }

    public function index()
    {
        $tickets = SupportTicket::with('user')->latest()->get();
        return view('admin.support.index', compact('tickets'));
    }

    public function resolve($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $ticket->status = 'resolved';
        $ticket->save();

        return back()->with('success', 'Le ticket a été marqué comme résolu.');
    }
}
