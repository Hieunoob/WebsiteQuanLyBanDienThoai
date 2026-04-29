<<<<<<< HEAD
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
=======
@extends('layouts.admin')

@section('title', 'Thêm sản phẩm mới')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}" class="text-decoration-none">Sản phẩm</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-plus-circle me-2"></i>Thêm sản phẩm mới
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <!-- Tên sản phẩm -->
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required placeholder="VD: iPhone 15 Pro Max 256GB">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Thương hiệu -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Thương hiệu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                   name="brand" value="{{ old('brand') }}" required placeholder="Apple, Samsung...">
                            @error('brand')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Danh mục -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Giá -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Giá (VNĐ) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                   name="price" value="{{ old('price') }}" required min="0" placeholder="VD: 25000000">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Số lượng -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Số lượng tồn kho <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                   name="quantity" value="{{ old('quantity', 10) }}" required min="0">
                            @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- URL ảnh -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">URL ảnh sản phẩm</label>
                            <input type="text" class="form-control @error('image') is-invalid @enderror"
                                   name="image" value="{{ old('image') }}"
                                   placeholder="https://example.com/image.jpg hoặc đường dẫn ảnh">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="form-text">Nhập URL ảnh. Nếu để trống sẽ dùng ảnh mặc định.</div>
                        </div>

                        <!-- Mô tả -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Mô tả sản phẩm</label>
                            <textarea class="form-control" name="description" rows="4"
                                      placeholder="Mô tả chi tiết về sản phẩm...">{{ old('description') }}</textarea>
                        </div>

                        <!-- THÔNG SỐ KỸ THUẬT -->
                        <div class="col-12">
                            <hr>
                            <h6 class="fw-bold text-muted mb-3"><i class="bi bi-cpu me-2"></i>Thông số kỹ thuật</h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Màn hình</label>
                            <input type="text" class="form-control" name="screen" value="{{ old('screen') }}"
                                   placeholder="VD: 6.7 inch OLED, 120Hz">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">RAM</label>
                            <input type="text" class="form-control" name="ram" value="{{ old('ram') }}"
                                   placeholder="VD: 8GB">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Bộ nhớ trong</label>
                            <input type="text" class="form-control" name="storage" value="{{ old('storage') }}"
                                   placeholder="VD: 256GB">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Camera</label>
                            <input type="text" class="form-control" name="camera" value="{{ old('camera') }}"
                                   placeholder="VD: 50MP + 12MP + 10MP">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pin</label>
                            <input type="text" class="form-control" name="battery" value="{{ old('battery') }}"
                                   placeholder="VD: 5000mAh, sạc 45W">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hệ điều hành</label>
                            <input type="text" class="form-control" name="operating_system" value="{{ old('operating_system') }}"
                                   placeholder="VD: iOS 17, Android 14">
                        </div>

                        <!-- Nổi bật -->
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured"
                                       value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_featured">
                                    <i class="bi bi-star-fill text-warning me-1"></i>Đánh dấu là sản phẩm nổi bật
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i>Hủy
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-2"></i>Lưu sản phẩm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
>>>>>>> 3bcf823 (update giao diện admin)
