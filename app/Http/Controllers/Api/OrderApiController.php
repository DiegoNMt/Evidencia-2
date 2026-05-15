<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC SEARCH
    |--------------------------------------------------------------------------
    */

    public function search(Request $request)
    {
        //dd($request->all()); // Debugging line to check incoming request data
        
        $request->validate([
            'invoice_number' => 'required'
        ]);

        $order = Order::with('customer')
            ->where('invoice_number', $request->invoice_number)
            ->first();

        if (!$order) {

            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([

            'success' => true,

            'order' => [

                'id' => $order->id,

                'invoice_number' => $order->invoice_number,

                'customer' => $order->customer->name ?? null,

                'status' => $order->status,

                'order_date' => $order->order_date,

                'description' => $order->description,

                'route_photo' => $order->photos()
                    ->where('photo_type', 'loaded')
                    ->value('photo_path'),

                'delivery_photo' => $order->photos()
                    ->where('photo_type', 'unloaded')
                    ->value('photo_path'),

            ]

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | PROTECTED ROUTES
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return response()->json(
            Order::with('customer')->get()
        );
    }

    public function show($id)
    {
        $order = Order::with('customer')->find($id);

        if (!$order) {

            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json($order);
    }

    public function changeStatus(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {

            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'Status updated successfully',
            'order' => $order
        ]);
    }

    public function uploadPhoto(Request $request, $id)
    {
        return response()->json([
            'message' => 'Photo upload endpoint ready'
        ]);
    }
}