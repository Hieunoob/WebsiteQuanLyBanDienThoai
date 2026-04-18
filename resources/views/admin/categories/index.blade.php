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