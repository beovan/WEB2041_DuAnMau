<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login',
        ['title' => 'Đăng nhập hệ thống']);
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
        return redirect()->route('admin');
    }
    else {
        Session::flash('class', 'error');
        Session::flash('message', 'Email hoặc password không đúng');
    }


    return redirect()->back();
    }
}