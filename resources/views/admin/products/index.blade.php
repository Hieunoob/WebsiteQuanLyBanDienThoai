<<<<<<< HEAD
@extends('admin.dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý Điện thoại</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá bán</th>
            <th>Kho</th>
            <th>Trạng thái</th> <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>
                <img src="{{ asset('storage/' . $product->image) }}" width="60" class="img-thumbnail">
            </td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>{{ $product->category->name }}</td>
            <td>{{ number_format($product->price) }}đ</td>
            <td>{{ $product->stock }}</td>
            
            <td>
                @if($product->stock <= 0)
                    <span class="badge bg-danger">Hết hàng</span>
                @elseif($product->stock < 10)
                    <span class="badge bg-warning text-dark">Sắp hết hàng</span>
                @else
                    <span class="badge bg-success">Còn hàng</span>
                @endif
            </td>

            <td class="text-nowrap">
                <div class="d-flex gap-1">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> Sửa
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm: {{ $product->name }}?')">
                            <i class="bi bi-trash"></i> Xóa
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
=======
@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('breadcrumb')
    <li class="breadcrumb-item active">Sản phẩm</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex gap-2">
        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Tìm sản phẩm..." style="width:250px;">
        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
        @if(request('search'))
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x"></i></a>
        @endif
    </form>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Thêm sản phẩm
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="60">Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th class="text-center">Tồn kho</th>
                    <th class="text-center">Nổi bật</th>
                    <th class="text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="align-middle">
                    <td>
                        <img src="{{ $product->image ?: 'https://via.placeholder.com/50x50?text=P' }}"
                             style="width:50px;height:50px;object-fit:cover;border-radius:8px;"
                             onerror="this.src='https://via.placeholder.com/50x50?text=P'">
                    </td>
                    <td>
                        <div class="fw-semibold">{{ $product->name }}</div>
                        <div class="text-muted small">{{ $product->brand }}</div>
                    </td>
                    <td><span class="badge bg-primary-subtle text-primary">{{ $product->category->name }}</span></td>
                    <td class="fw-semibold text-danger">{{ $product->formatted_price }}</td>
                    <td class="text-center">
                        @if($product->quantity > 0)
                            <span class="badge bg-success">{{ $product->quantity }}</span>
                        @else
                            <span class="badge bg-danger">Hết hàng</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($product->is_featured)
                            <i class="bi bi-star-fill text-warning"></i>
                        @else
                            <i class="bi bi-star text-muted"></i>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('Xóa sản phẩm này?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Chưa có sản phẩm nào</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-white">
        {{ $products->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
>>>>>>> 3bcf823 (update giao diện admin)
