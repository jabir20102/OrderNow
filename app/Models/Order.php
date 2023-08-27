<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id', 'customer_id'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
