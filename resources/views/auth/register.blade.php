@extends('layouts.app')

@section('title', 'Đăng ký — PhoneShop')

@push('styles')
<style>
    .auth-input {
        width:100%; height:44px; border:1px solid var(--pale-silver);
        border-radius:4px; padding:0 14px;
        font-size:14px; color:var(--carbon); font-family:inherit;
        background:var(--white); outline:none;
        transition:border-color 0.33s;
    }
    .auth-input::placeholder { color:var(--silver-fog); }
    .auth-input:focus { border-color:var(--blue); }
    .auth-input.is-invalid { border-color:#c0392b; }
    .auth-label { font-size:13px; font-weight:500; color:var(--carbon); margin-bottom:6px; display:block; }
    .auth-error { font-size:12px; color:#c0392b; margin-top:5px; }
</style>
@endpush

@section('content')
<div style="min-height:calc(100vh - 56px);display:flex;align-items:center;justify-content:center;background:var(--light-ash);padding:40px 16px;">
    <div style="width:100%;max-width:440px;">
        <div style="text-align:center;margin-bottom:32px;">
            <a href="{{ route('home') }}" style="font-size:13px;font-weight:500;color:var(--carbon);letter-spacing:3px;text-transform:uppercase;text-decoration:none;display:inline-block;margin-bottom:24px;">PhoneShop</a>
            <div style="font-size:24px;font-weight:500;color:var(--carbon);">Tạo tài khoản</div>
            <div style="font-size:14px;color:var(--pewter);margin-top:6px;">Mua sắm dễ dàng hơn với tài khoản PhoneShop</div>
        </div>

        <div style="background:var(--white);border:1px solid var(--cloud);border-radius:4px;padding:32px;">
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div style="margin-bottom:16px;">
                    <label class="auth-label">Họ và tên</label>
                    <input class="auth-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           type="text" name="name" value="{{ old('name') }}"
                           placeholder="Nguyễn Văn A" required autofocus>
                    @error('name')<div class="auth-error">{{ $message }}</div>@enderror
                </div>

                <div style="margin-bottom:16px;">
                    <label class="auth-label">Email</label>
                    <input class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           type="email" name="email" value="{{ old('email') }}"
                           placeholder="email@example.com" required>
                    @error('email')<div class="auth-error">{{ $message }}</div>@enderror
                </div>

                <div style="margin-bottom:16px;">
                    <label class="auth-label">Mật khẩu</label>
                    <input class="auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           type="password" name="password"
                           placeholder="Tối thiểu 6 ký tự" required>
                    @error('password')<div class="auth-error">{{ $message }}</div>@enderror
                </div>

                <div style="margin-bottom:28px;">
                    <label class="auth-label">Xác nhận mật khẩu</label>
                    <input class="auth-input" type="password" name="password_confirmation"
                           placeholder="Nhập lại mật khẩu" required>
                </div>

                <button type="submit" class="btn-primary-tesla w-100" style="min-height:44px;">Tạo tài khoản</button>
            </form>

            <div style="text-align:center;margin-top:20px;font-size:13px;color:var(--pewter);">
                Đã có tài khoản?
                <a href="{{ route('login') }}" style="color:var(--blue);text-decoration:none;font-weight:500;">Đăng nhập</a>
            </div>
        </div>
    </div>
</div>
@endsection
