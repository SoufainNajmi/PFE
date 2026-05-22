<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
        'fournisseur_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(User::class, 'fournisseur_id');
    }
}
