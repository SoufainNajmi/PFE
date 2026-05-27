<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientController extends Controller
{
    public function orders()
    {
        $orders = Order::where('client_id', Auth::id())->with('invoice')->latest()->get();
        return view('client.orders', compact('orders'));
    }

    public function createOrder(Request $request)
    {
        $fournisseurs = User::where('role', 'fournisseur')->where('status', 'approved')->get();
        $selectedFournisseur = null;
        $products = [];

        if ($request->has('fournisseur_id') && $request->fournisseur_id != '') {
            $selectedFournisseur = User::findOrFail($request->fournisseur_id);
            $products = Product::where('fournisseur_id', $selectedFournisseur->id)->get();
        }

        return view('client.create_order', compact('fournisseurs', 'selectedFournisseur', 'products'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'fournisseur_id' => 'required|exists:users,id',
            'products' => 'required|array',
            'products.*' => 'integer|min:0'
        ]);

        $totalPrice = 0;
        $orderItems = [];

        foreach ($request->products as $productId => $quantity) {
            if ($quantity > 0) {
                $product = Product::where('id', $productId)->where('fournisseur_id', $request->fournisseur_id)->first();
                if ($product) {
                    $totalPrice += $product->price * $quantity;
                    $orderItems[] = [
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price
                    ];
                    // Optionnel: décrémenter le stock
                    // $product->decrement('stock', $quantity);
                }
            }
        }

        if (count($orderItems) === 0) {
            return back()->with('error', 'Veuillez sélectionner au moins un produit avec une quantité valide.');
        }

        $order = Order::create([
            'client_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        return redirect()->route('client.orders')->with('success', 'Commande passée avec succès auprès du fournisseur!');
    }

    public function downloadInvoice($id)
    {
        $order = Order::with(['client', 'items.product', 'invoice'])->findOrFail($id);

        if ($order->client_id !== Auth::id()) {
            abort(403);
        }

        if (!$order->invoice) {
            return back()->with('error', 'Facture non disponible.');
        }

        $pdf = Pdf::loadView('invoices.pdf', compact('order'));
        return $pdf->download('facture_' . $order->invoice->invoice_number . '.pdf');
    }

    public function invoices()
    {
        $orders = Order::where('client_id', Auth::id())->whereHas('invoice')->with(['invoice'])->latest()->get();
        return view('client.invoices', compact('orders'));
    }
}
