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
