<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.users.register',
            [
                'title' => 'Trang đăng kí',
            ]);
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->level = 1; // Set the 'level' field to 1 for regular users
        // Save the user to the database
        $user->save();
        // Optionally log in the user
        Auth::login($user);
        if ($user->isAdmin()) {
            // Redirect admin to admin dashboard
            return redirect()->route('admin');
        } else {
            return  redirect('/');

        }
        // Redirect to a page or show a success message
        return redirect()->route('admin')->with('success', 'Registration successful');
    }
}
