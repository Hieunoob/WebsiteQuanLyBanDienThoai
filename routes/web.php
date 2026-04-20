<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller; // Dòng này để kế thừa từ file Controller gốc bên ngoài
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\AuthController;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Admin\AdminDashboardController;

// --- NHÓM ROUTE CHO ADMIN ---

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', function () {
        $productCount = \App\Models\Product::count();
        $categoryCount = \App\Models\Category::count();
        $userCount = \App\Models\User::count();
        $orderCount = \App\Http\Models\Order::count();
        $categories = \App\Models\Category::withCount('products')->get();
        $chartLabels = $categories->pluck('name'); 
        $chartData = $categories->pluck('products_count'); 

        return view('admin.dashboard', compact('productCount', 'categoryCount','userCount','orderCount','chartLabels','chartData'));
    })->name('admin.dashboard');

    Route::resource('products', AdminProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// --- NHÓM ROUTE CHO KHÁCH HÀNG (NGOÀI AUTH) ---
// Trang chủ dành cho mọi người xem sản phẩm
Route::get('/', [ProductController::class, 'index'])->name('customer.home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/about', function () { return view('customer.about'); })->name('about');

// --- XÁC THỰC ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- NHÓM YÊU CẦU ĐĂNG NHẬP ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () { return view('customer.profile'); })->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // Đổi tên trang dashboard này thành 'customer.dashboard' để không trùng với trang chủ
    Route::get('/dashboard', function () {
        return view('customer.home'); 
    })->name('customer.dashboard'); 

    // Giỏ hàng & Đơn hàng
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});