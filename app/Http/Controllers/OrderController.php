<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Import the Order model or adjust the namespace as needed
use App\Models\OrderItem; // Import the OrderItem model if you have one
class OrderController extends Controller
{

    public function index()
    {
        // Your code to retrieve a list of orders goes here
        $orders = Order::all(); // Assuming you have an Order model
        // Return a view with the list of orders
        return view('orders.index', [
            'title' => 'Đơn hàng',
            'orders' => $orders]);
    }
    public function show($id)
    {
        // Your code to retrieve a single order's details by ID goes here
        $order = Order::find($id);
        $user = auth()->user();
        // Check if the order exists
        if (!$order) {
            abort(404); // You can customize this error handling as needed
        }

        // Retrieve the order items associated with the order
        $orderItems = $order->items; // Assuming you have a relationship defined in your Order model
        $orders = Order::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        return view('orders.show', [
            'title' => 'Chi tiết đơn hàng',
            'order' => $order,
            'orders' => $orders,
            'orderItems' => $orderItems
        ]);
    }
}

