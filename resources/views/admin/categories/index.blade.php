<<<<<<< HEAD
@extends('admin.dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý Danh mục</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm danh mục</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Slug (Đường dẫn)</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td class="text-nowrap"> 
    <div class="d-flex gap-1"> 
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
            <i class="bi bi-pencil"></i> Sửa
        </a>

        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
            @csrf 
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" 
                onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục: {{ $category->name }}?')">
                <i class="bi bi-trash"></i> Xóa
            </button>
        </form>
    </div>
</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
=======
@extends('layouts.admin')

@section('title', 'Quản lý danh mục')

@section('breadcrumb')
    <li class="breadcrumb-item active">Danh mục</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted">{{ $categories->total() }} danh mục</span>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Thêm danh mục
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên danh mục</th>
                    <th>Slug</th>
                    <th>Mô tả</th>
                    <th class="text-center">Số sản phẩm</th>
                    <th class="text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td class="text-muted">{{ $cat->id }}</td>
                    <td class="fw-semibold">{{ $cat->name }}</td>
                    <td><code>{{ $cat->slug }}</code></td>
                    <td class="text-muted small">{{ Str::limit($cat->description, 60) }}</td>
                    <td class="text-center">
                        <span class="badge bg-primary">{{ $cat->products_count }}</span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                  onsubmit="return confirm('Xóa danh mục này?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Chưa có danh mục nào</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
    <div class="card-footer bg-white">{{ $categories->links() }}</div>
    @endif
</div>
@endsection
>>>>>>> 3bcf823 (update giao diện admin)
