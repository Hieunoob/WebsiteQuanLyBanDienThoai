@extends('admin.dashboard')

@section('content')
<div class="card mt-4" style="max-width: 600px;">
    <div class="card-header"><h4>Thêm tài khoản</h4></div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label>Email (Tài khoản)</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
                <small class="text-muted">Tối thiểu 8 ký tự, gồm: Chữ hoa, chữ thường, số và ký tự đặc biệt (@, #, $...)</small>
                @error('password') <br><small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label>Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Tạo tài khoản</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
@endsection