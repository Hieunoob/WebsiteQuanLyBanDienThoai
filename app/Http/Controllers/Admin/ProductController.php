<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // Form thêm sản phẩm
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $slug = Str::slug($request->name);
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048'
        ],[
        // Thông báo lỗi tiếng Việt cho Hiếu dễ quản lý
        'name.unique' => 'Tên sản phẩm này đã tồn tại trong hệ thống!',
        'name.required' => 'Vui lòng nhập tên sản phẩm.',
        'price.min' => 'Giá bán phải tối thiểu là 1.000 VNĐ!',
        'stock.min' => 'Số lượng kho không được nhỏ hơn 0!',
        'stock.integer' => 'Số lượng kho phải là số nguyên.',
    ]);
        if (Product::where('slug', $slug)->exists()) {
        return back()->withErrors(['name' => 'Tên sản phẩm này đã tồn tại, vui lòng đổi tên khác một chút!'])->withInput();
    }
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    // Xóa sản phẩm
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Đã xóa sản phẩm.');
    }
    // Form chỉnh sửa
public function edit(Product $product)
{
    $categories = Category::all();
    return view('admin.products.edit', compact('product', 'categories'));
}

// Xử lý cập nhật
public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|max:255|unique:products,name,' . $product->id,
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:1000',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $data = $request->all();
    $data['slug'] = Str::slug($request->name);

    // Xử lý ảnh nếu người dùng upload ảnh mới
    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu có để tránh rác server
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        // Lưu ảnh mới
        $data['image'] = $request->file('image')->store('products', 'public');
    } else {
        // Nếu không chọn ảnh mới, giữ lại tên ảnh cũ
        $data['image'] = $product->image;
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
}
}