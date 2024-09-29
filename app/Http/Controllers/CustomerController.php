<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function create(Request $request)
    {

        try {
            $request->validate([
                'name'     => 'required',
                'domicile' => 'required',
                'gender'   => 'required',
            ]);

            $customer                = new Customer();
            $customer->name          = $request->name;
            $customer->domicile      = $request->domicile;
            $customer->gender        = $request->gender;
            $customer->save();

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success Create Customer',
                'data' => $customer,
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
        try {
            $request->validate([
                'name'     => 'required',
                'domicile' => 'required',
                'gender'   => 'required',
            ]);

            $customer                = Customer::find($id);
            $customer->name          = $request->name;
            $customer->domicile      = $request->domicile;
            $customer->gender        = $request->gender;
            $customer->save();

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success Update Customer',
                'data' => $customer,
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
            $customer = Customer::find($id);

            if (!$customer) {
                return response()->json([
                    'status_code' => 404,
                    'success' => false,
                    'message' => 'Customer with id ' . $id . ' not found',
                    'data' => [],
                ], 404);
            }

            $customer->delete();

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success Delete Customer',
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

            $customers = Customer::all();

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Success get all customer',
                'data' => $customers,
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
