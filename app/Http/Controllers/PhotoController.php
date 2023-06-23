<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    public function index()
    {
        $restaurant_id=Auth::id();
        $restaurant=Restaurant::find($restaurant_id);
        $photos = $restaurant->photos;
        return view('photos.index', compact('restaurant', 'photos'));
    }

    public function store(Request $request)
    {
        $restaurant_id=Auth::id();
        $restaurant=Restaurant::find($restaurant_id); 
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('photos', 'public');

        $restaurant->photos()->create([
            'url' => $imagePath,
        ]);

        return redirect()->route('restaurant.photos.index', $restaurant->id)->with('success', 'Photo added successfully.');
    }

    public function destroy(Photo $photo)
    {
        
         $image_path=public_path('storage/' . $photo->url);
        if(file_exists($image_path)){
            unlink($image_path);
            $photo->delete();
            return redirect()->back()->with('success', 'Photo deleted successfully.');
          }
          return redirect()->back()->with('error', 'Photo not  deleted.');
        
    }
}
