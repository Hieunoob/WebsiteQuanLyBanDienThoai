<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
abstract class Controller
{
    public function index() {
    $productCount = Product::count();
    $categoryCount = Category::count();
    $userCount = User::count();

    // Lấy dữ liệu cho biểu đồ: Tên danh mục và số lượng sản phẩm tương ứng
    $categories = Category::withCount('products')->get();
    $chartLabels = $categories->pluck('name');
    $chartData = $categories->pluck('products_count');

    return view('admin.dashboard', compact(
        'productCount', 
        'categoryCount', 
        'userCount', 
        'chartLabels', 
        'chartData'
    ));
}
}
