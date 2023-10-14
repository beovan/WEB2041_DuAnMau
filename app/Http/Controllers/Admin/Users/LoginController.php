<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


//use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login',
        ['title' => 'Đăng nhập hệ thống']);
    }

    public function logout()
    {
        // Log out the user
        auth()->logout();

        // Clear the user-related session data
        Session::forget('users'); // Replace 'key' with the key of the session data you want to remove

        // Redirect to the desired page
        return redirect('/');
    }
    public function store(Request $request)
    {
    $this->validate($request, [
        'email' =>'required|email:filter',
        'password' =>'required'
    ]);
    //kiem tra mat khau
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials, $request->input('remember'))) {

        // Retrieve the user based on the provided email

        $user = User::where('email', $request->email)->first();

        // Check if a user with the provided email exists
        if (!$user) {
            session()->flash('error', 'Email không tồn tại.');
            return redirect()->back();
        }

        // Verify the provided password against the user's hashed password
        if (Hash::check($request->password, $user->password)) {
            // Password is correct, log in the user

            // Authenticate the user (log them in)
            Auth::login($user);


            // Redirect to the appropriate page
            if ($user->isAdmin()) {
                // Redirect admin to admin dashboard
                return redirect()->route('admin');
            } else {
                $user->level = 1;
                return  redirect('/');

            }
        } else {
            // Password is incorrect
            session()->flash('error', 'Mật khẩu không chính xác.');
            return redirect()->back();
        }
    }

        session()->flash('error', 'email hoặc mật khẩu không chính xác');
    return redirect()->back();
    }
}
