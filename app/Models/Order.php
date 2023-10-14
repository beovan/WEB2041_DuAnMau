<?php

// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $connection = 'mysql'; // Specify the database connection
    protected $table = 'orders'; // Specify the table name
    protected $fillable = [
        'order_number',
        'customer_id',
        'total_amount',
        'order_date'
        // Add other fields as needed
    ];

    // Define relationships with other models, if necessary
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
