@extends('customer.layouts.app')

@section('title', $product->name)

@section('content')

<div class="max-w-6xl mx-auto bg-white rounded-xl shadow p-6 grid md:grid-cols-2 gap-8">

    <!-- 🖼️ ẢNH -->
    <div>
        <img src="{{ $product->image }}"
             class="w-full h-[400px] object-cover rounded-lg shadow">
    </div>

    <!-- 📱 THÔNG TIN -->
    <div class="flex flex-col justify-between">

        <div>
            <h1 class="text-3xl font-bold mb-2 text-gray-800">
                {{ $product->name }}
            </h1>

            <p class="text-2xl text-red-500 font-bold mb-4">
                {{ number_format($product->price) }} đ
            </p>

            <p class="text-gray-600 mb-6">
                {{ $product->description ?? 'Chưa có mô tả' }}
            </p>
        </div>

        <!-- 🔢 CHỌN SỐ LƯỢNG + MUA -->
        @auth
        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-4">
            @csrf

            <div class="flex items-center space-x-4">
                <span class="font-semibold">Số lượng:</span>

                <input type="number" name="quantity" value="1" min="1"
                    class="w-20 border px-3 py-1 rounded text-center">
            </div>

            <button class="w-full bg-green-500 text-white py-3 rounded-lg text-lg hover:bg-green-600 transition">
                🛒 Thêm vào giỏ hàng
            </button>
        </form>
        @else
            <a href="{{ route('login') }}"
               class="block text-center bg-gray-800 text-white py-3 rounded-lg">
               Đăng nhập để mua
            </a>
        @endauth

        <!-- 🔙 BACK -->
        <a href="{{ route('customer.home') }}"
           class="text-blue-500 mt-4 inline-block">
           ← Quay lại
        </a>

    </div>
</div>

@endsection