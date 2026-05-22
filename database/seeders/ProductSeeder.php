<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a Fournisseur
        $fournisseur = \App\Models\User::firstOrCreate(
            ['email' => 'fournisseur@hanoti.com'],
            [
                'name' => 'Grossiste Casablanca',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'fournisseur',
                'status' => 'approved',
            ]
        );

        $categories = \App\Models\Category::all();

        $products = [
            [
                'name' => 'Thé Vert Sultan (Pack de 10)',
                'description' => 'Thé vert authentique pour la préparation du thé à la menthe marocain. Qualité supérieure.',
                'price' => 120.50,
                'stock' => 500,
                'category' => 'Boissons'
            ],
            [
                'name' => 'Sucre en Morceaux Ennmer',
                'description' => 'Pack de sucre en morceaux 1Kg. Indispensable pour l\'épicerie.',
                'price' => 6.00,
                'stock' => 1000,
                'category' => 'Épicerie Sucrée'
            ],
            [
                'name' => 'Huile de Tournesol Lesieur 5L',
                'description' => 'Bidon d\'huile de table Lesieur de 5 Litres, riche en vitamines.',
                'price' => 85.00,
                'stock' => 300,
                'category' => 'Épicerie Salée'
            ],
            [
                'name' => 'Lait UHT Jaouda (Carton de 6)',
                'description' => 'Lait entier longue conservation. Pack de 6 bouteilles d\'1 litre.',
                'price' => 45.00,
                'stock' => 200,
                'category' => 'Produits Laitiers'
            ],
            [
                'name' => 'Savon Tide 500g',
                'description' => 'Lessive en poudre Tide pour lavage à la main et machine.',
                'price' => 12.00,
                'stock' => 800,
                'category' => 'Entretien et Hygiène'
            ],
            [
                'name' => 'Café Dubois 250g',
                'description' => 'Café moulu fort et aromatique, parfait pour le petit déjeuner.',
                'price' => 15.50,
                'stock' => 400,
                'category' => 'Boissons'
            ],
        ];

        foreach ($products as $prodData) {
            $cat = $categories->where('name', $prodData['category'])->first();
            
            \App\Models\Product::create([
                'name' => $prodData['name'],
                'description' => $prodData['description'],
                'price' => $prodData['price'],
                'stock' => $prodData['stock'],
                'category_id' => $cat ? $cat->id : 1,
                'fournisseur_id' => $fournisseur->id,
            ]);
        }
    }
}
