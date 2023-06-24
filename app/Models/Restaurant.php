<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','address','contact'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}