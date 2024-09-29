<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function create(Request $request)
    {
        try {
            $request->validate([
                'code'     => 'required',
                'product_name' => 'required',
                'category'   => 'required',
                'price'   => 'required',
            ]);

            $product                = new Product();
            $product->code          = $request->code;
            $product->product_name  = $request->product_name;
            $product->category      = $request->category;
            $product->price         = $request->price;
            $product->save();

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success Create product',
                'data' => $product,
            ], 200)->header('Access-Control-Allow-Origin', '*');
        } catch (Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'status_code' => 400,
                    'success' => false,
                    'data' => [],
                ],
                400
            )->header('Access-Control-Allow-Origin', '*');
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'code'     => 'required',
                'product_name' => 'required',
                'category'   => 'required',
                'price'   => 'required',
            ]);

            $product                = Product::find($id);
            $product->code          = $request->code;
            $product->product_name  = $request->product_name;
            $product->category      = $request->category;
            $product->price         = $request->price;
            $product->save();

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success Update product',
                'data' => $product,
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
            $product = Product::find($id);
            $product->delete();

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success Delete product',
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
            $products = Product::all();
            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success get all product',
                'data' => $products,
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
