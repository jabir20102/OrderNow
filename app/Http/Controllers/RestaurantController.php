<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function dashboard()
    {
        $id=  Auth::id();
        $orders = Order::where('restaurant_id', $id)
        ->where('status', 0)
        ->get();
        return view('dashboard', compact('orders'));
    }

    public function edit()
    {
        $id=  Auth::id();
        $restaurant = Restaurant::find($id);
        return view('restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $restaurant->update($request->only(['name', 'description', 'address', 'contact']));
        return redirect()
        ->route('restaurants.edit', $restaurant)
        ->with('success', 'Restaurant details updated successfully.');
    }
}
