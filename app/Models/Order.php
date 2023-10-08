<?php

// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_id',
        'total_amount',
        // Add other fields as needed
    ];

    // Define relationships with other models, if necessary
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
