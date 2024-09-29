<?php

namespace App\Http\Controllers;

use App\Models\ItemSale;
use Illuminate\Http\Request;

class SaleItemController extends Controller
{
    //

    public static function create($sale_id, $product_id, $qty)
    {
        try {
            // Buat item penjualan baru
            $item = ItemSale::create([
                'sale_id'      => $sale_id,
                'product_id'   => $product_id,
                'qty'          => $qty,
            ]);
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
