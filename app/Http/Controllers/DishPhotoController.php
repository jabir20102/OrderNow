<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishPhotos;
use App\Models\Restaurant;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DishPhotoController extends Controller
{
    public function index($id)
    {
        $dish=Dish::find($id);
        return view('dishes.photos', compact('dish'));
    }

    public function store(Request $request,Dish $dish)
    {
        // $restaurant_id=Auth::id();
        // $restaurant=Restaurant::find($restaurant_id); 
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('photos', 'public');

        $dish->photos()->create([
            'path' => $imagePath,
        ]);

        return redirect()->route('dishes.photos.index',$dish->id)->with('success', 'Photo added successfully.');
    }

    public function destroy(DishPhotos $photo)
    {
        
         $image_path=public_path('storage/' . $photo->path);
        if(file_exists($image_path)){
            unlink($image_path);
            $photo->delete();
            return redirect()->back()->with('success', 'Photo deleted successfully.');
          }
          return redirect()->back()->with('error', 'Photo not  deleted.');
        
    }
}
