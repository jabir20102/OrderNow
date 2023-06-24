<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishPhotos extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'path'];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
