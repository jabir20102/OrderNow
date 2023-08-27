<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function store(Request $request)
    {
        $orderItem = OrderItem::create($request->all());

        return response()->json(['message' => 'Order item created successfully', 'order_item' => $orderItem], 201);
    }
    
}
