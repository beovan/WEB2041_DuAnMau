<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login',
        ['title' => 'Đăng nhập hệ thống']);
    }


    public function store(Request $request)
        {//dd($request->input());
            $this->validate($request,[
                'email' =>'required|email:filter',
                'password' => 'required'
            ],[
                'email.required'=>'Ban chua nhap email',
                'password.required'=>'Ban chua nhap password'
            ]);

            if(Auth::attempt(
                [
                    'email'=>$request->input('email') ,
                    'password'=>$request->input('password')
                ],$request->input('remember'))){
                    return redirect()->back();
                }

            return redirect()->route('Admin');

        }
}
