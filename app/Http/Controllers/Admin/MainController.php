<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User as User;
use http\Client\Curl\User as HttpClientUser;
use Illuminate\Http\Request;
use App\Models\Product;


class MainController extends Controller
{
    public function index()
    {
        $users = User::all();
        $order = Order::all();
        $products = Product::all();
        echo view('admin.home',[
            'title' => 'Trang Quản trị Admin',
            "order" => $order,
            "users" => $users,
            "products" => $products
        ]);
    }
}
