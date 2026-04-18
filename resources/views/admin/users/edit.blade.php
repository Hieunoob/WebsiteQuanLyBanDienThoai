@extends('admin.dashboard')

@section('content')
<div class="card mt-4" style="max-width: 600px;">
    <div class="card-header"><h4>Chỉnh sửa tài khoản</h4></div>
    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label>Email (Tài khoản)</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3 border p-3 rounded bg-light">
                <label class="fw-bold">Đổi mật khẩu mới</label>
                <input type="password" name="password" class="form-control mt-2" placeholder="Để trống nếu không muốn đổi">
                <small class="text-muted">Quy tắc: Tối thiểu 8 ký tự, có chữ Hoa, số và ký tự đặc biệt.</small>
                
                <label class="mt-2">Xác nhận mật khẩu mới</label>
                <input type="password" name="password_confirmation" class="form-control">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật tài khoản</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection