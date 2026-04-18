@extends('customer.layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow mt-10">

    <h2 class="text-2xl font-bold mb-6 text-center">🔐 Đăng nhập</h2>

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif
@if(session('success'))
    <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" name="email" placeholder="Email"
            class="w-full mb-3 border px-3 py-2 rounded">

        <input type="password" name="password" placeholder="Mật khẩu"
            class="w-full mb-4 border px-3 py-2 rounded">

        <button class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
            Đăng nhập
        </button>
    </form>

    <p class="text-center mt-4">
        Chưa có tài khoản?
        <a href="{{ route('register') }}" class="text-blue-500">Đăng ký</a>
    </p>

</div>

@endsection