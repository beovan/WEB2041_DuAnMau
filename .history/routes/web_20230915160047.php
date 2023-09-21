<?php

use \App\Http\Controllers\Admin\Users\MainController;
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

Route::get('admin/users/login', [LoginController::class, 'index']);
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::get('admin/main', [MainController::class, 'index'])->name('admin')->middleware('auth'); // Main admin route
