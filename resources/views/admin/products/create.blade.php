@extends('admin.dashboard')

@section('content')
<div class="card mt-4 shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">Thêm sản phẩm điện thoại</h4>
    </div>
    <div class="card-body">
        <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">Tên điện thoại (Hãng + Model)</label>
                <input type="text" name="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       placeholder="VD: iPhone 15 Pro Max" 
                       value="{{ old('name') }}" required>
                
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
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                    <input type="number" id="price" name="price" 
                           class="form-control @error('price') is-invalid @enderror" 
                           value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Số lượng kho</label>
                    <input type="number" id="stock" name="stock" 
                           class="form-control @error('stock') is-invalid @enderror" 
                           value="{{ old('stock', 0) }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Ảnh đại diện</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-save"></i> Lưu sản phẩm
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary px-4">Hủy</a>
            </div>
        </form>
    </div>
</div>


@endsection