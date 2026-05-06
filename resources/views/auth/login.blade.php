@extends('layouts.app')

@section('title', 'Đăng nhập — PhoneShop')

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
    .demo-box {
        background:var(--light-ash); border-radius:4px;
        padding:14px 16px; margin-top:20px;
        font-size:12px; color:var(--pewter);
        border:1px solid var(--cloud);
    }
    .demo-box strong { color:var(--carbon); }
    .demo-row { display:flex; justify-content:space-between; margin-top:6px; }
    .demo-label { font-weight:500; color:var(--graphite); }
    .demo-val { font-family:monospace; color:var(--blue); }
</style>
@endpush

@section('content')
<div style="min-height:calc(100vh - 56px);display:flex;align-items:center;justify-content:center;background:var(--light-ash);padding:40px 16px;">
    <div style="width:100%;max-width:420px;">
        {{-- Header --}}
        <div style="text-align:center;margin-bottom:32px;">
            <a href="{{ route('home') }}" style="font-size:13px;font-weight:500;color:var(--carbon);letter-spacing:3px;text-transform:uppercase;text-decoration:none;display:inline-block;margin-bottom:24px;">PhoneShop</a>
            <div style="font-size:24px;font-weight:500;color:var(--carbon);">Đăng nhập</div>
            <div style="font-size:14px;color:var(--pewter);margin-top:6px;">Chào mừng bạn quay lại</div>
        </div>

        {{-- Card --}}
        <div style="background:var(--white);border:1px solid var(--cloud);border-radius:4px;padding:32px;">
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div style="margin-bottom:18px;">
                    <label class="auth-label">Email</label>
                    <input class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           type="email" name="email" value="{{ old('email') }}"
                           placeholder="email@example.com" required autofocus>
                    @error('email')<div class="auth-error">{{ $message }}</div>@enderror
                </div>

                <div style="margin-bottom:24px;">
                    <label class="auth-label">Mật khẩu</label>
                    <input class="auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           type="password" name="password" placeholder="••••••••" required>
                    @error('password')<div class="auth-error">{{ $message }}</div>@enderror
                </div>

                <div style="display:flex;align-items:center;gap:8px;margin-bottom:24px;">
                    <input type="checkbox" name="remember" id="remember"
                           style="width:14px;height:14px;accent-color:var(--blue);cursor:pointer;">
                    <label for="remember" style="font-size:13px;color:var(--graphite);cursor:pointer;">Ghi nhớ đăng nhập</label>
                </div>

                <button type="submit" class="btn-primary-tesla w-100" style="min-height:44px;">Đăng nhập</button>
            </form>

            <div style="text-align:center;margin-top:20px;font-size:13px;color:var(--pewter);">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" style="color:var(--blue);text-decoration:none;font-weight:500;">Đăng ký ngay</a>
            </div>
        </div>

        {{-- Demo accounts --}}
        <div class="demo-box">
            <strong>Tài khoản demo</strong>
            <div class="demo-row">
                <span class="demo-label">Admin</span>
                <span class="demo-val">admin@phoneshop.vn / password</span>
            </div>
            <div class="demo-row">
                <span class="demo-label">User</span>
                <span class="demo-val">user@phoneshop.vn / password</span>
            </div>
        </div>
    </div>
</div>
@endsection
