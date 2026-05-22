<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class FournisseurController extends Controller
{
    public function dashboard()
    {
        $productsCount = Product::where('fournisseur_id', Auth::id())->count();
        $ordersCount = Order::whereHas('items', function($query) {
            $query->whereHas('product', function($q) {
                $q->where('fournisseur_id', Auth::id());
            });
        })->count();

        $recentProducts = Product::where('fournisseur_id', Auth::id())->latest()->take(5)->get();

        return view('fournisseur.dashboard', compact('productsCount', 'ordersCount', 'recentProducts'));
    }

    public function orders()
    {
        $orders = Order::whereHas('items', function($query) {
            $query->whereHas('product', function($q) {
                $q->where('fournisseur_id', Auth::id());
            });
        })->with(['client', 'items.product'])->latest()->get();

        return view('fournisseur.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        // If completed, generate an invoice
        if ($request->status === 'completed' && !$order->invoice) {
            $order->invoice()->create([
                'invoice_number' => 'INV-' . strtoupper(uniqid()),
                'total' => $order->total_price
            ]);
        }

        return back()->with('success', 'Statut de la commande mis à jour.');
    }
}
