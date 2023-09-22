<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Import the Session facade

class LoginController extends Controller
{
    public function index()
    {
        return view(
            'admin.users.login',
            ['title' => 'Đăng nhập hệ thống']
        );
    }

    public function store(Request $request)
    {
        dd($request->input());
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $request->input('remember'))) {

            return redirect()->route('admin'); // Corrected route name
        }

        Session::flash('error', 'Email hoặc Password không đúng'); // Corrected flash method
        return redirect()->back();
    }
}
