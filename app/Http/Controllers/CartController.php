<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('client.cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Produit ajouté au panier!');
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return back()->with('success', 'Produit retiré du panier.');
        }
    }

    public function checkout()
    {
        $cart = session()->get('cart');
        if(!$cart) {
            return back()->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'client_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending'
        ]);

        foreach($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
            
            // Optionally decrement stock here
            $product = Product::find($id);
            if ($product) {
                $product->decrement('stock', $details['quantity']);
            }
        }

        session()->forget('cart');

        return redirect()->route('client.orders')->with('success', 'Commande passée avec succès!');
    }
}
