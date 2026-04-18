@extends('customer.layouts.app')

@section('title', 'Trang chủ')

@section('content')

<!-- 🔥 BANNER SLIDER PRO -->
<div class="relative w-full h-[400px] mb-10 overflow-hidden rounded-2xl shadow-lg">

    <!-- Slides -->
    <div id="slider" class="flex h-full transition-transform duration-700 ease-in-out">

        <!-- Slide 1 -->
        <div class="min-w-full relative">
            <img src="https://images.unsplash.com/photo-1510557880182-3d4d3cba35a5"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40 flex items-center px-10 text-white">
                <div>
                    <h2 class="text-4xl font-bold">🔥 Sale 50%</h2>
                    <p class="text-lg">Giảm giá cực sốc hôm nay</p>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="min-w-full relative">
            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40 flex items-center px-10 text-white">
                <div>
                    <h2 class="text-4xl font-bold">📱 iPhone mới</h2>
                    <p class="text-lg">Công nghệ đỉnh cao</p>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="min-w-full relative">
            <img src="https://images.unsplash.com/photo-1495433324511-bf8e92934d90"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40 flex items-center px-10 text-white">
                <div>
                    <h2 class="text-4xl font-bold">⚡ Chính hãng</h2>
                    <p class="text-lg">Bảo hành uy tín</p>
                </div>
            </div>
        </div>

    </div>

    <!-- 🔘 DOTS -->
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
        <span class="dot w-3 h-3 bg-white rounded-full cursor-pointer"></span>
        <span class="dot w-3 h-3 bg-gray-400 rounded-full cursor-pointer"></span>
        <span class="dot w-3 h-3 bg-gray-400 rounded-full cursor-pointer"></span>
    </div>

    <!-- ⬅️ PREV -->
    <button onclick="prevSlide()"
        class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/40 text-white p-2 rounded-full hover:bg-black">
        ❮
    </button>

    <!-- ➡️ NEXT -->
    <button onclick="nextSlide()"
        class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/40 text-white p-2 rounded-full hover:bg-black">
        ❯
    </button>

</div>

<!-- 🔥 SẢN PHẨM BÁN CHẠY -->
<h2 class="text-2xl font-bold mb-4 text-red-500">🔥 Sản phẩm bán chạy</h2>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
@foreach($bestSeller as $p)
    <div class="bg-white rounded-xl shadow hover:shadow-xl transition p-3">

        <img src="{{ $p->image }}" class="w-full h-40 object-cover rounded">

        <h3 class="mt-2 font-semibold">{{ $p->name }}</h3>

        <p class="text-red-500 font-bold">
            {{ number_format($p->price) }} đ
        </p>

        <form method="POST" action="{{ route('cart.add', $p->id) }}">
            @csrf
            <button class="w-full mt-2 bg-red-500 text-white py-1 rounded hover:bg-red-600">
                Mua ngay
            </button>
        </form>

    </div>
@endforeach
</div>

<!-- 🔥 SẢN PHẨM MUA NHIỀU -->
<h2 class="text-2xl font-bold mb-4 text-blue-500">🛒 Sản phẩm mua nhiều</h2>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
@foreach($mostViewed as $p)
    <div class="bg-white rounded-xl shadow hover:shadow-xl transition p-3">

        <img src="{{ $p->image }}" class="w-full h-40 object-cover rounded">

        <h3 class="mt-2 font-semibold">{{ $p->name }}</h3>

        <p class="text-blue-500 font-bold">
            {{ number_format($p->price) }} đ
        </p>

        <form method="POST" action="{{ route('cart.add', $p->id) }}">
            @csrf
            <button class="w-full mt-2 bg-blue-500 text-white py-1 rounded hover:bg-blue-600">
                Mua ngay
            </button>
        </form>

    </div>
@endforeach
</div>

<!-- 🔥 SẢN PHẨM MỚI -->
<h2 class="text-2xl font-bold mb-4 text-green-500">🆕 Sản phẩm mới</h2>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
@foreach($newProducts as $p)
    <div class="bg-white rounded-xl shadow hover:shadow-xl transition p-3">

        <img src="{{ $p->image }}" class="w-full h-40 object-cover rounded">

        <h3 class="mt-2 font-semibold">{{ $p->name }}</h3>

        <p class="text-green-500 font-bold">
            {{ number_format($p->price) }} đ
        </p>

        <form method="POST" action="{{ route('cart.add', $p->id) }}">
            @csrf
            <button class="w-full mt-2 bg-green-500 text-white py-1 rounded hover:bg-green-600">
                Mua ngay
            </button>
        </form>

    </div>
@endforeach
</div>

<!-- 🔥 TẤT CẢ SẢN PHẨM -->
<h2 class="text-2xl font-bold mb-4">📦 Tất cả sản phẩm</h2>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
@forelse($products as $p)
    <div class="bg-white rounded-xl shadow hover:shadow-xl transition p-3">

        <img src="{{ $p->image }}" class="w-full h-40 object-cover rounded">

        <h3 class="mt-2 font-semibold">{{ $p->name }}</h3>

        <p class="text-gray-800 font-bold">
            {{ number_format($p->price) }} đ
        </p>

        <form method="POST" action="{{ route('cart.add', $p->id) }}">
            @csrf
            <button class="w-full mt-2 bg-gray-800 text-white py-1 rounded hover:bg-black">
                Xem ngay
            </button>
        </form>

    </div>
@empty
    <p>Không có sản phẩm</p>
@endforelse
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    let index = 0;
    const slider = document.getElementById('slider');
    const dots = document.querySelectorAll('.dot');

    if (!slider) return;

    const total = slider.children.length;

    function showSlide(i) {
        index = (i + total) % total;

        slider.style.transform = `translateX(-${index * 100}%)`;

        dots.forEach((dot, idx) => {
            dot.classList.remove('bg-white');
            dot.classList.add('bg-gray-400');

            if (idx === index) {
                dot.classList.remove('bg-gray-400');
                dot.classList.add('bg-white');
            }
        });
    }

    // 👉 GÁN GLOBAL để nút onclick chạy được
    window.nextSlide = function () {
        showSlide(index + 1);
    }

    window.prevSlide = function () {
        showSlide(index - 1);
    }

    // 👉 Click dots
    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => showSlide(i));
    });

    // 👉 Auto chạy
    setInterval(() => {
        showSlide(index + 1);
    }, 4000);

});
</script>
@endsection