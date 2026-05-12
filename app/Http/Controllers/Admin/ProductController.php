<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'category_id'      => 'required|exists:categories,id',
            'brand'            => 'required|string|max:100',
            'price'            => 'required|numeric|min:0',
            'quantity'         => 'required|integer|min:0',
            'description'      => 'nullable|string',
            'image'            => 'nullable|string|max:500',
            'screen'           => 'nullable|string|max:255',
            'ram'              => 'nullable|string|max:100',
            'storage'          => 'nullable|string|max:100',
            'camera'           => 'nullable|string|max:255',
            'battery'          => 'nullable|string|max:100',
            'operating_system' => 'nullable|string|max:100',
            'is_featured'      => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        $validated['is_featured'] = $request->boolean('is_featured');

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'category_id'      => 'required|exists:categories,id',
            'brand'            => 'required|string|max:100',
            'price'            => 'required|numeric|min:0',
            'quantity'         => 'required|integer|min:0',
            'description'      => 'nullable|string',
            'image'            => 'nullable|string|max:500',
            'screen'           => 'nullable|string|max:255',
            'ram'              => 'nullable|string|max:100',
            'storage'          => 'nullable|string|max:100',
            'camera'           => 'nullable|string|max:255',
            'battery'          => 'nullable|string|max:100',
            'operating_system' => 'nullable|string|max:100',
            'is_featured'      => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Đã xóa sản phẩm.');
    }
}
