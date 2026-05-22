<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('fournisseur')->get();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with(['fournisseur', 'category'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('fournisseur.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image');
        $data['fournisseur_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('fournisseur.dashboard')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit($id)
    {
        $product = Product::where('fournisseur_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('fournisseur.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('fournisseur_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('fournisseur.dashboard')->with('success', 'Produit mis à jour.');
    }

    public function destroy($id)
    {
        $product = Product::where('fournisseur_id', Auth::id())->findOrFail($id);
        $product->delete();

        return redirect()->route('fournisseur.dashboard')->with('success', 'Produit supprimé.');
    }
}
