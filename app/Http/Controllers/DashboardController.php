<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function getAll()
    {
        try {
            $products = Product::count();
            $customers = Customer::count();
            $transactions = Sale::count();

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'data' => [
                    'products' => $products,
                    'customers' => $customers,
                    'transactions' => $transactions
                ],
                'message' => 'Success get dashboard',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'status_code' => 400,
                    'success' => false,
                    'data' => [],
                ],
                400
            );
        }
    }
}
