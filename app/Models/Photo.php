<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [ 'url'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
