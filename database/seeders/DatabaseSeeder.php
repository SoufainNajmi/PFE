<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin Hanoti',
            'email' => 'admin@hanoti.com',
            'password' => '123456789', // Pas besoin de Hash::make car le modèle User s'en charge avec 'casts'
            'role' => 'admin',
            'status' => 'approved',
        ]);

        $categories = [
            'Boissons',
            'Épicerie Sucrée',
            'Épicerie Salée',
            'Produits Laitiers',
            'Entretien et Hygiène'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name' => $category,
                'description' => 'Produits de la catégorie ' . $category
            ]);
        }
    }
}
