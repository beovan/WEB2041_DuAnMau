<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;

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

        });
    });
});

