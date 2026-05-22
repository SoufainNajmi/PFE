<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'invoice_number', 'total', 'generated_at'];

    public $timestamps = true;

    protected function casts(): array
    {
        return [
            'generated_at' => 'datetime',
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
