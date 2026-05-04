<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    // Trang chủ: hiển thị sản phẩm nổi bật và danh mục
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->featured()
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $newProducts = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $categories = Category::withCount('products')->get();

        return view('home', compact('featuredProducts', 'newProducts', 'categories'));
    }
}
