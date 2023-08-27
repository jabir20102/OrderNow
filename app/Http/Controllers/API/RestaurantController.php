<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('photos')->get();
        return response()->json($restaurants);
    }

    public function show($id)
    {
        $restaurant = Restaurant::where('id',$id)
        ->with('photos')
        ->with('dishes')
        ->first();
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }
        return response()->json($restaurant);
    }
    public function dishes($id)
    {
        $dishes = Dish::where('restaurant_id', $id)
        // ->with('reviews')  later on implented
        ->get();
        
        return response()->json($dishes);
    }
    public function best_dishes()
    {
        $dishes = Dish::where('price','<', 200)
        // ->with('reviews')  later on implented
        ->with('restaurant') 
        ->get();
        
        return response()->json($dishes);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'address' => 'required',
        // ]);

        // $restaurant = Restaurant::create($request->all());
        // return response()->json($restaurant, 201);
    }

    public function update(Request $request, $id)
    {
        // $restaurant = Restaurant::find($id);
        // if (!$restaurant) {
        //     return response()->json(['message' => 'Restaurant not found'], 404);
        // }

        // $request->validate([
        //     'name' => 'required',
        //     'address' => 'required',
        // ]);

        // $restaurant->update($request->all());
        // return response()->json($restaurant);
    }

    public function destroy($id)
    {
        // $restaurant = Restaurant::find($id);
        // if (!$restaurant) {
        //     return response()->json(['message' => 'Restaurant not found'], 404);
        // }

        // $restaurant->delete();
        // return response()->json(['message' => 'Restaurant deleted successfully']);
    }
}
