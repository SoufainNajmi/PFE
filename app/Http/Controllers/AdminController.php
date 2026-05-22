<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingFournisseurs = User::where('role', 'fournisseur')->where('status', 'pending')->get();
        $approvedFournisseurs = User::where('role', 'fournisseur')->where('status', 'approved')->get();
        $clients = User::where('role', 'client')->get();
        $ordersCount = Order::count();
        $revenue = Order::where('status', 'completed')->sum('total_price');

        return view('admin.dashboard', compact('pendingFournisseurs', 'approvedFournisseurs', 'clients', 'ordersCount', 'revenue'));
    }

    public function approveFournisseur($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'approved']);
        return back()->with('success', 'Fournisseur approuvé avec succès.');
    }

    public function rejectFournisseur($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'rejected']);
        return back()->with('success', 'Fournisseur rejeté.');
    }
}
