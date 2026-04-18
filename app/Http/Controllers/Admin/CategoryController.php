<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->name);
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ],[
        'name.unique' => 'Tên danh mục này đã tồn tại!',
        ]);
        
        if (Category::where('slug', $slug)->exists()) {
        return back()->withErrors(['name' => 'Tên này tạo ra đường dẫn đã trùng, hãy đổi tên khác.'])->withInput();
    }
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Tạo danh mục thành công!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {   
        $slug = Str::slug($request->name);
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);
        
        if (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
        return back()->withErrors(['name' => 'Tên này tạo ra đường dẫn đã trùng.'])->withInput();
    }
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Category $category)
    {
        // Kiểm tra nếu có sản phẩm thuộc danh mục này thì không cho xóa (tùy chọn)
        if($category->products()->count() > 0) {
            return back()->with('error', 'Không thể xóa danh mục đang có sản phẩm!');
        }
        
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Đã xóa danh mục.');
    }
}