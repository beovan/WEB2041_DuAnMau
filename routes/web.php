<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

// Display the registration form
Route::get('register', [RegisterController::class, 'create'])->name('register.create');

// Process the registration form
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

/*
|--------------------------------------------------------------------------
| Web Routes
	@@ -29,18 +17,11 @@
| be assigned to the "web" middleware group. Make something great!
|
*/
//login routes
Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
//chuyển sang trang admin
Route::post('admin/users/login/store', [LoginController::class, 'store']);
// Display the registration form
Route::get('admin/users/register', [RegisterController::class, 'index'])->name('register.index');

// Process the registration form
Route::post('admin/users/register/store', [RegisterController::class, 'store'])->name('register.store');

//logout routes
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
//group lại
//Middleware như là một cơ chế cho phép bạn tham gia vào
// luồng xử lý request của một ứng dụng Larave
Route::middleware(['auth'])->group(function () {
//tiền tố định tuyến: Thuộc tính prefix có thể sử dụng để thêm tiền tố cho mỗi định tuyến trong một nhóm với một URI.
// Ví dụ, bạn có thể muốn tất cả các tiền tố trong nhóm là admin:
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        #USERS
        Route::prefix('users')->group(function () {
            Route::get('add',[UserController::class,'create']);
            Route::post('add',[UserController::class,'store']);
            Route::get('list',[UserController::class,'index']);
            Route::get('edit/{user}',[UserController::class,'edit']);
            Route::post('edit/{user}',[UserController::class,'update']);
            Route::DELETE('destroy',[UserController::class,'destroy']);
        });

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


        #Slider
        Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });
        #Post
        Route::prefix('posts')->group(function () {
            Route::get('add', [PostController::class, 'create']);
            Route::post('add', [PostController::class, 'store']);
            Route::get('list', [PostController::class, 'index']);
            Route::get('edit/{post}', [PostController::class, 'show']);
            Route::post('edit/{post}', [PostController::class, 'update']);
            Route::DELETE('destroy', [PostController::class, 'destroy']);
        });



        #Upload
        Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);
        #Cart
        Route::get('customers', [\App\Http\Controllers\Admin\CartController::class, 'index']);
        Route::get('customers/view/{customer}', [\App\Http\Controllers\Admin\CartController::class, 'show']);
    });
});

Route::get('/',[\App\Http\Controllers\MainController::class,'index']);
Route::post('/services/load-product', [App\Http\Controllers\MainController::class, 'loadProduct']);

Route::get('danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);


Route::post('add-cart', [App\Http\Controllers\CartController::class, 'index']);
Route::get('carts', [App\Http\Controllers\CartController::class, 'show']);
Route::post('update-cart', [App\Http\Controllers\CartController::class, 'update']);
Route::get('carts/delete/{id}', [App\Http\Controllers\CartController::class, 'remove']);
Route::post('carts', [App\Http\Controllers\CartController::class, 'addCart']);

//order
// Example routes for order management
Route::get('profile/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/profile/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

// contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [UserProfileController::class, 'update']);
});


