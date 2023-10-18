<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use  App\Http\Services\CartService;


class UserProfileController extends Controller
{
    // Show the user profile
    public function show(Customer $customers)
    {
        $user = auth()->user(); // Get the authenticated user
        Order::all();
        // Retrieve the user's order history
        $orders = Order::all();
        return view('profile.show', [
            'title' => 'User Profile',
            'user' => $user,
            'user_id' => $user->id,
            'orders' => $orders,
            'customers' => $customers,
        ]);
    }



// Show the edit profile form


// Update the user profile
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'sometimes|nullable|string|min:8|confirmed',
    ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        // You can update other profile fields here as needed

        $user->update();
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }


}
