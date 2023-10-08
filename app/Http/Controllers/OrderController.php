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

    // Create a new order
    public function create()
    {
        // Your code for creating a new order form view
        return view('orders.create');
    }

// Store a newly created order in the database
    public function store(Request $request)
    {
        // Your code for storing a new order based on the submitted form data
        // Assuming you have a form with fields like 'customer_name', 'order_date', etc.

        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            // Add validation rules for other fields as needed
        ]);

        $order = new Order();
        $order->customer_name = $data['customer_name'];
        $order->order_date = $data['order_date'];
        // Set other fields as needed

        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

// Update the order
    public function update(Request $request, $id)
    {
        // Your code for updating the order based on the submitted form data
        // Similar to the store method, but updating an existing order

        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            // Add validation rules for other fields as needed
        ]);

        $order = Order::findOrFail($id);
        $order->customer_name = $data['customer_name'];
        $order->order_date = $data['order_date'];
        // Update other fields as needed

        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

// Delete the order
    public function destroy($id)
    {
        // Your code for deleting the order
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }

}

