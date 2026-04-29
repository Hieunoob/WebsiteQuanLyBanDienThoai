<<<<<<< HEAD
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
=======
@extends('layouts.admin')

@section('title', 'Sửa sản phẩm')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}" class="text-decoration-none">Sản phẩm</a></li>
    <li class="breadcrumb-item active">Sửa</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-pencil-square me-2"></i>Sửa sản phẩm: {{ $product->name }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Thương hiệu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                   name="brand" value="{{ old('brand', $product->brand) }}" required>
                            @error('brand')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Giá (VNĐ) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                   name="price" value="{{ old('price', $product->price) }}" required min="0">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Số lượng tồn kho <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                   name="quantity" value="{{ old('quantity', $product->quantity) }}" required min="0">
                            @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">URL ảnh sản phẩm</label>
                            @if($product->image)
                            <div class="mb-2">
                                <img src="{{ $product->image }}" style="height:80px;object-fit:cover;border-radius:8px;" onerror="this.style.display='none'">
                            </div>
                            @endif
                            <input type="text" class="form-control" name="image" value="{{ old('image', $product->image) }}"
                                   placeholder="https://example.com/image.jpg">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Mô tả sản phẩm</label>
                            <textarea class="form-control" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="col-12"><hr><h6 class="fw-bold text-muted mb-3"><i class="bi bi-cpu me-2"></i>Thông số kỹ thuật</h6></div>

                        <div class="col-md-6">
                            <label class="form-label">Màn hình</label>
                            <input type="text" class="form-control" name="screen" value="{{ old('screen', $product->screen) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">RAM</label>
                            <input type="text" class="form-control" name="ram" value="{{ old('ram', $product->ram) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bộ nhớ trong</label>
                            <input type="text" class="form-control" name="storage" value="{{ old('storage', $product->storage) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Camera</label>
                            <input type="text" class="form-control" name="camera" value="{{ old('camera', $product->camera) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pin</label>
                            <input type="text" class="form-control" name="battery" value="{{ old('battery', $product->battery) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hệ điều hành</label>
                            <input type="text" class="form-control" name="operating_system" value="{{ old('operating_system', $product->operating_system) }}">
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured"
                                       value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
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
                            <i class="bi bi-check-circle me-2"></i>Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
>>>>>>> 3bcf823 (update giao diện admin)
