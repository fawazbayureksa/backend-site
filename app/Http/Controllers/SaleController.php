<?php

namespace App\Http\Controllers;

use App\Models\ItemSale;
use App\Models\Sale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    //
    public function create(Request $request)
    {
        $request->validate([
            'customer_id'   => 'required',
            'sub_total'     => 'required',
            'products'      => 'required|array',
        ]);

        $invoice_id = 'INV-' . substr(str_shuffle(MD5(microtime())), 0, 10);

        try {
            $sale = Sale::create([
                'invoice_id' => $invoice_id,
                'date' => now(),
                'customer_id' => $request->customer_id,
                'sub_total' => $request->sub_total,
            ]);

            foreach ($request->products as $product) {
                try {
                    SaleItemController::create($sale->id, $product['product_id'], $product['quantity']);
                } catch (\Exception $e) {
                    Log::info("message : " . $e->getMessage());
                }
            }

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success Create sale',
                'data' => $sale,
            ], 200);
        } catch (Exception $e) {
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


    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id'   => 'required',
            'sub_total'     => 'required',
            'products'      => 'required|array',
        ]);

        $invoice_id = 'INV-' . substr(str_shuffle(MD5(microtime())), 0, 10);

        try {
            $sale = Sale::find($id);
            $sale->invoice_id    = $invoice_id;
            $sale->date          = now();
            $sale->customer_id   = $request->customer_id;
            $sale->sub_total     = $request->sub_total;
            $sale->save();

            ItemSale::where('sale_id', $sale->id)->delete();

            foreach ($request->products as $product) {
                try {
                    SaleItemController::create($sale->id, $product['product_id'], $product['quantity']);
                } catch (\Exception $e) {
                    Log::info("message : " . $e->getMessage());
                }
            }

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success Update sale',
                'data' => $sale,
            ], 200);
        } catch (Exception $e) {
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

    public function destroy($id)
    {
        try {
            $sale = Sale::find($id);

            if (!$sale) {
                return response()->json([
                    'status_code' => 404,
                    'success' => false,
                    'message' => 'Sale with id ' . $id . ' not found',
                    'data' => [],
                ], 404);
            }

            $sale->delete();

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success Delete sale',
                'data' => [],
            ], 200);
        } catch (Exception $e) {
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

    public function getAll()
    {
        try {
            $sales = Sale::with('item_sale.product', 'customer')->get();

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success get all sale',
                'data' => $sales,
            ], 200);
        } catch (Exception $e) {
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
