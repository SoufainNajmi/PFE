<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $pendingOrders = Order::whereHas('items', function($query) {
            $query->whereHas('product', function($q) {
                $q->where('fournisseur_id', Auth::id());
            });
        })->where('status', 'pending')
          ->with(['client', 'items.product'])
          ->latest()
          ->get();

        return view('fournisseur.dashboard', compact('productsCount', 'ordersCount', 'recentProducts', 'pendingOrders'));
    }

    public function orders()
    {
        $orders = Order::whereHas('items', function($query) {
            $query->whereHas('product', function($q) {
                $q->where('fournisseur_id', Auth::id());
            });
        })->with(['client', 'items.product', 'invoice'])->latest()->get();

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

    public function downloadInvoice($id)
    {
        $order = Order::whereHas('items', function($query) {
            $query->whereHas('product', function($q) {
                $q->where('fournisseur_id', Auth::id());
            });
        })->with(['client', 'items.product', 'invoice'])->findOrFail($id);

        if (!$order->invoice) {
            return back()->with('error', 'Facture non disponible.');
        }

        $pdf = Pdf::loadView('invoices.pdf', compact('order'));
        return $pdf->download('facture_' . $order->invoice->invoice_number . '.pdf');
    }

    public function invoices()
    {
        $orders = Order::whereHas('items', function($query) {
            $query->whereHas('product', function($q) {
                $q->where('fournisseur_id', Auth::id());
            });
        })->whereHas('invoice')->with(['client', 'invoice'])->latest()->get();

        return view('fournisseur.invoices', compact('orders'));
    }
}
