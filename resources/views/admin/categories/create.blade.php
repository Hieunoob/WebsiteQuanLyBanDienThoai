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