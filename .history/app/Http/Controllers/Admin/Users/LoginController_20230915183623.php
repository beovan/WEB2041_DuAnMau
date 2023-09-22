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
    $password = 'password';
    $hashedPassword = Hash::make($password);
    dd(Hash::check($password, $hashedPassword));

    // dd($hashedPassword);
    // dd(Auth::attempt([
    //     'email' => $request->input(key: 'email'),
    // 'password' => $request->input(Hash::check($password, $hashedPassword))
    // ], $request->input(key: 'remember')));
    if (Auth::attempt([
        'email' => $request->input(key: 'email'),
    'password' => $request->input()
    ], $request->input(key: 'remember'))) {
        return redirect()->route('admin');
    }

    Session::flash('class', 'error');
    Session::flash('message', 'Email hoặc password không đúng');
    return redirect()->back();
    }
}