@extends('customer.layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow mt-10">

    <h2 class="text-2xl font-bold mb-6 text-center">📝 Đăng ký</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" placeholder="Tên"
            class="w-full mb-3 border px-3 py-2 rounded">

        <input type="email" name="email" placeholder="Email"
            class="w-full mb-3 border px-3 py-2 rounded">

        <input type="password" name="password" placeholder="Mật khẩu"
            class="w-full mb-4 border px-3 py-2 rounded">

        <button class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
            Đăng ký
        </button>
    </form>

</div>

@endsection