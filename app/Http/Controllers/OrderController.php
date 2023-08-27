<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems', 'customer', 'orderItems.dish')->get();
        return response()->json(['orders' => $orders], 200);
    }

    public function show(Order $order)
    {
        $order->load('orderItems', 'customer', 'orderItems.dish');
        return response()->json(['order' => $order], 200);
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());

        return response()->json(['message' => 'Order created successfully', 'orderId' => $order->id], 201);
    }
     // Delete an order by ID
     public function destroy($id)
     {
         $order = Order::find($id);
 
         if (!$order) {
             return response()->json(['message' => 'Order not found.'], 404);
         }
 
         $order->delete();
         return response()->json(['message' => 'Order deleted successfully.']);
     }
}
