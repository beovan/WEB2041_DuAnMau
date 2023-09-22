<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
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
//chuyển đăng nhặp
Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
//chuyển sang trang admin
Route::post('admin/users/login/store', [LoginController::class, 'store']);

//group lại
//Middleware như là một cơ chế cho phép bạn tham gia vào
// luồng xử lý request của một ứng dụng Larave
Route::middleware(['auth'])->group(function () {
//tiền tố định tuyến: Thuộc tính prefix có thể sử dụng để thêm tiền tố cho mỗi định tuyến trong một nhóm với một URI.
// Ví dụ, bạn có thể muốn tất cả các tiền tố trong nhóm là admin:
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        #MENU
        Route::prefix('menus')->group(function () {
            Route::get('add',[MenuController::class,'create']);
            Route::post('add',[MenuController::class,'store']);
            Route::get('list',[MenuController::class,'index']);
            Route::get('edit/{menu}',[MenuController::class,'show']);
            Route::post('edit/{menu}',[MenuController::class,'update']);
            Route::DELETE('destroy',[MenuController::class,'destroy']);
        });
        #Product
        //một nhóm định tuyến dành cho các tính năng quản trị của trang web
        // của bạn và bạn muốn thêm tiền tố "admin"
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });

        #Upload
        route::post('upload/services',[\App\Http\Controllers\Admin\UploadController::class, 'store']);

    });
});

