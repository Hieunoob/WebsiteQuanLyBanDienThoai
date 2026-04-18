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