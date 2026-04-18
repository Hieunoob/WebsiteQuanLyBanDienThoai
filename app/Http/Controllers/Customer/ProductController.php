<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $keyword = trim($request->search);

            if (strlen($keyword) == 1) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($keyword) . '%']);
            } else {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', $keyword . '%')
                      ->orWhere('name', 'like', '% ' . $keyword . '%');
                });
            }
        }

        // 💰 FILTER GIÁ
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->min_price && $request->max_price) {
            if ($request->min_price > $request->max_price) {
                return back()->with('error', 'Giá không hợp lệ!');
            }
        }

        // 📦 TẤT CẢ SẢN PHẨM
        $products = $query->latest()->get();

        // 🔥 SẢN PHẨM MỚI
        $newProducts = Product::latest()->take(8)->get();

        // 🔥 BÁN CHẠY (chuẩn nếu có order_items)
        if (class_exists(\App\Models\OrderItem::class)) {
            $bestSeller = Product::withCount('orderItems')
                ->orderBy('order_items_count', 'desc')
                ->take(8)
                ->get();
        } else {
            // fallback nếu chưa có orderItems
            $bestSeller = Product::inRandomOrder()->take(8)->get();
        }

        // 🔥 MUA NHIỀU (random hoặc bạn có thể cải tiến)
        $mostViewed = Product::inRandomOrder()->take(8)->get();

        return view('customer.products.index', compact(
            'products',
            'newProducts',
            'bestSeller',
            'mostViewed'
        ));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        // 🔥 Gợi ý sản phẩm liên quan
        $related = Product::where('id', '!=', $id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('customer.products.show', compact('product', 'related'));
    }

    public function search(Request $request)
    {
        $keyword = trim($request->search);

        if (!$keyword) {
            return response()->json([]);
        }

        $products = Product::where('name', 'like', '%' . $keyword . '%')
            ->take(8)
            ->get(['id', 'name', 'price', 'image']); // tối ưu JSON

        return response()->json($products);
    }
}