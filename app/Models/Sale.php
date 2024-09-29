<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'customer_id',
        'sub_total',
        'date',
    ];

    public function item_sale()
    {
        return $this->hasMany(ItemSale::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
