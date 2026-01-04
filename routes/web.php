<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BaiVietController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\BaiVietController as UserBaiVietController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\DonHangController;
use App\Http\Controllers\user\ShopController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'product_detail'])->name('product.detail');

Route::get('/posts', [UserBaiVietController::class, 'index'])->name('post.index');
Route::get('/post/{slug}', [UserBaiVietController::class, 'post_detail'])->name('post.detail');

// cart
Route::get('/list-cart', [CartController::class, 'listCart'])->name('cart.list');
Route::post('/add-to-cart', [CartController::class, 'addCart'])->name('cart.add');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
    Route::resource('/address', AddressController::class);



    // order
    Route::get('/don-hang', [DonHangController::class, 'index'])->name('donhangs.index');
    Route::get('/don-hang/create', [DonHangController::class, 'create'])->name('donhangs.create');
    Route::post('/don-hang/store', [DonHangController::class, 'store'])->name('donhangs.store');
    Route::get('/don-hang/show/{id}', [DonHangController::class, 'show'])->name('donhangs.show');
    Route::put('/don-hang/update/{id}', [DonHangController::class, 'update'])->name('donhangs.update');


});

Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('admin/danh_mucs', DanhMucController::class);
    Route::resource('admin/san_phams', SanPhamController::class);
    Route::resource('admin/bai_viets', BaiVietController::class);
});

// profile, post, product reviews
