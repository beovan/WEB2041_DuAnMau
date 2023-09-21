<?php

use App\Http\Controllers\Admin\Users\MainController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get(uri: 'admin/users/login', action: [LoginController::class, 'index']);
Route::post(uri: 'admin/users/login/store', action: [LoginController::class, 'store']);

Route::get(uri: 'admin/main', [MainController::class, 'index'])->name('admin'); // Main admin route
