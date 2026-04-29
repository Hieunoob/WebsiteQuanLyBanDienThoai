<<<<<<< HEAD
@extends('admin.dashboard')

@section('content')
<div class="card mt-4" style="max-width: 600px;">
    <div class="card-header"><h4>Thêm danh mục mới</h4></div>
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên danh mục</label>
                <input type="text" name="name" class="form-control" placeholder="VD: iPhone, Android, Phụ kiện" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-success">Lưu danh mục</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection
=======
@extends('layouts.admin')

@section('title', 'Thêm danh mục')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}" class="text-decoration-none">Danh mục</a></li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white fw-bold"><i class="bi bi-plus-circle me-2"></i>Thêm danh mục mới</div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required placeholder="VD: iPhone, Samsung...">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Mô tả</label>
                        <textarea class="form-control" name="description" rows="3"
                                  placeholder="Mô tả ngắn về danh mục...">{{ old('description') }}</textarea>
                    </div>
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Hủy</a>
                        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-circle me-2"></i>Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
>>>>>>> 3bcf823 (update giao diện admin)
