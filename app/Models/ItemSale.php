<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSale extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sale_id',
        'product_id',
        'qty',
    ];
    // Relasi dengan model Penjualan
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    // Relasi dengan model Barang
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
