<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class UserProfileController extends Controller
{
    // Show the user profile
    public function show()
    {
        $user = auth()->user(); // Get the authenticated user

        // Retrieve the user's order history
        $orders = Order::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('profile.show', [
            'title' => 'User Profile',
            'user' => $user,
            'orders' => $orders,
        ]);
    }


// Show the edit profile form
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', [
            'title'=> 'Upadate Profile'
        ]);
    }

// Update the user profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        // Update other profile fields as needed
        $user->save();

        return redirect('profile.show')->with('success', 'Profile updated successfully');
    }
}
