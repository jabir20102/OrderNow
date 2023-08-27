<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    
    public function index()
    {
        $id=  Auth::id();
        $dishes = Dish::where('restaurant_id', $id)
        ->get();
        return view('dishes.index', compact('dishes'));  
    }

    
    public function create()
    {
        return view('dishes.store');
    }

    
public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'ingredients' => 'required',
        'price' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'restaurant_id' => 'required',
    ]);

    $imagePath = $request->file('image')->store('photos', 'public');
    $validatedData['image'] = $imagePath;

    $dish = Dish::create($validatedData);

    return redirect()->route('dishes.index', $dish->id)
        ->with('success', 'Dish added successfully.');
}

}
