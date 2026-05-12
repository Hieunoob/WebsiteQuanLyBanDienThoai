<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// =============================================
// ROUTES PHÍA NGƯỜI DÙNG
// =============================================

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Sản phẩm
Route::get('/san-pham', [ProductController::class, 'index'])->name('products.index');
Route::get('/san-pham/{slug}', [ProductController::class, 'show'])->name('products.show');

// Giỏ hàng (không cần đăng nhập)
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('/gio-hang/them/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::post('/gio-hang/cap-nhat/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/gio-hang/xoa/{productId}', [CartController::class, 'remove'])->name('cart.remove');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/dang-ky', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/dang-ky', [AuthController::class, 'register']);

    Route::get('/dang-nhap', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/dang-nhap', [AuthController::class, 'login']);
});

Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');

// Đặt hàng và lịch sử (yêu cầu đăng nhập)
Route::middleware('auth')->group(function () {
    Route::get('/dat-hang', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/dat-hang', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/dat-hang/thanh-cong', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/lich-su-don-hang', [OrderController::class, 'history'])->name('orders.history');
    Route::get('/don-hang/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// =============================================
// ROUTES PHÍA ADMIN (yêu cầu đăng nhập + quyền admin)
// =============================================

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Quản lý sản phẩm (không cần trang show riêng)
    Route::resource('products', AdminProductController::class)->except(['show']);

    // Quản lý danh mục (không cần trang show riêng)
    Route::resource('categories', AdminCategoryController::class)->except(['show']);

    // Quản lý đơn hàng
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Quản lý người dùng
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/toggle-role', [AdminUserController::class, 'toggleRole'])->name('users.toggleRole');
});
