<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', // ID of the associated order
        'product_id', // ID of the associated product
        'quantity', // Quantity of the product in the order
        'price', // Price of the product at the time of the order
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
