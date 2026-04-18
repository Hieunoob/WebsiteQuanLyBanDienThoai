@extends('admin.dashboard')

@section('content')
<div class="card mt-4 shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">Chỉnh sửa sản phẩm</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-bold">Tên điện thoại</label>
                <input type="text" name="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $product->name) }}" required>
                
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Danh mục</label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" 
                                {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Giá bán (VNĐ)</label>
                    <input type="number" name="price" 
                           class="form-control @error('price') is-invalid @enderror" 
                           step="any" value="{{ old('price', $product->price) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Số lượng kho</label>
                    <input type="number" name="stock" 
                           class="form-control @error('stock') is-invalid @enderror" 
                           value="{{ old('stock', $product->stock) }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Ảnh sản phẩm</label>
                    <div class="mb-2">
                        @if($product->image)
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset('storage/' . $product->image) }}" width="120" class="img-thumbnail shadow-sm">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">Ảnh cũ</span>
                            </div>
                        @else
                            <p class="text-muted small italic">Chưa có ảnh đại diện</p>
                        @endif
                    </div>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    <div class="form-text">Để trống nếu không muốn thay đổi ảnh.</div>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-arrow-repeat"></i> Cập nhật sản phẩm
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary px-4">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection