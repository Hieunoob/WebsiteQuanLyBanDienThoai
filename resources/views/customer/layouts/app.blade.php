<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Phone Shop')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans min-h-screen flex flex-col">

<!-- 🔥 NAVBAR -->
<nav class="bg-white shadow px-6 py-3 flex items-center justify-between sticky top-0 z-50">

    <!-- LEFT MENU -->
    <div class="flex items-center space-x-6">

        <a href="{{ route('customer.home') }}"
           class="flex items-center space-x-1 text-blue-600 font-semibold hover:text-blue-800">
            <span class="material-icons">home</span>
            <span>Trang chủ</span>
        </a>

        @auth
        <a href="{{ route('customer.dashboard') }}"
           class="flex items-center space-x-1 text-green-600 font-semibold hover:text-green-800">
            <span class="material-icons">dashboard</span>
            <span>Dashboard</span>
        </a>
        @endauth

        <a href="{{ route('about') }}"
           class="flex items-center space-x-1 text-gray-700 hover:text-black">
            <span class="material-icons">info</span>
            <span>Giới thiệu</span>
        </a>

        @auth
        @php
            $cartCount = auth()->user()->cart?->items()->count() ?? 0;
        @endphp

        <a href="{{ route('cart.index') }}"
           class="relative flex items-center space-x-1 text-red-600 hover:text-red-800">
            <span class="material-icons">shopping_cart</span>
            <span>Giỏ hàng</span>

            @if($cartCount > 0)
                <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                    {{ $cartCount }}
                </span>
            @endif
        </a>
        @endauth

    </div>

    <!-- 🔎 SEARCH -->
    <div class="relative w-1/2 max-w-xl">

        <input type="text" id="searchInput"
            value="{{ request('search') }}"
            placeholder="🔍 Tìm sản phẩm..."
            class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none shadow-sm">

        <!-- RESULT BOX -->
        <div id="searchResults"
             class="absolute left-0 top-full w-full bg-white shadow-lg rounded mt-2 hidden max-h-80 overflow-y-auto z-50">
        </div>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center space-x-4">

        <!-- FILTER -->
        <form method="GET" action="{{ route('customer.home') }}"
              class="flex items-center space-x-2 bg-gray-50 p-2 rounded-lg shadow-sm">

            <input type="number" name="min_price" min="0"
                value="{{ request('min_price') }}"
                placeholder="Từ"
                class="border px-2 py-1 w-20 rounded">

            <input type="number" name="max_price" min="0"
                value="{{ request('max_price') }}"
                placeholder="Đến"
                class="border px-2 py-1 w-20 rounded">

            <button class="bg-gray-600 text-white px-2 py-1 rounded hover:bg-gray-700">
                <span class="material-icons text-sm">filter_alt</span>
            </button>
        </form>

        @auth
        <a href="{{ route('profile') }}"
           class="p-2 bg-indigo-500 text-white rounded-full hover:bg-indigo-600 shadow">
            <span class="material-icons">person</span>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 shadow">
                <span class="material-icons">logout</span>
            </button>
        </form>
        @endauth

        @guest
        <a href="{{ route('login') }}"
           class="text-green-600 font-semibold hover:underline">
            Login
        </a>
        @endguest

    </div>
</nav>

<!-- CONTENT -->
<main class="flex-1 p-6">

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')

</main>

<!-- 🔥 SEARCH AJAX -->
<script>
const input = document.getElementById('searchInput');
const resultBox = document.getElementById('searchResults');

let timeout = null;

input.addEventListener('keyup', function () {
    clearTimeout(timeout);

    let keyword = this.value.trim();

    timeout = setTimeout(() => {

        if (keyword.length === 0) {
            resultBox.classList.add('hidden');
            return;
        }

        fetch(`/search?search=${keyword}`)
            .then(res => res.json())
            .then(data => {

                if (data.length === 0) {
                    resultBox.innerHTML = `
                        <p class="p-3 text-gray-500 text-center">
                            Không tìm thấy sản phẩm
                        </p>`;
                } else {
                    let html = '';
                    data.forEach(p => {
                        html += `
                        <a href="/product/${p.id}"
                           class="flex items-center p-2 hover:bg-gray-100 transition">
                            <img src="${p.image}"
                                 class="w-10 h-10 object-cover mr-3 rounded">
                            <div>
                                <p class="text-sm font-medium">${p.name}</p>
                                <p class="text-xs text-gray-500">${Number(p.price).toLocaleString()} đ</p>
                            </div>
                        </a>`;
                    });
                    resultBox.innerHTML = html;
                }

                resultBox.classList.remove('hidden');
            });

    }, 300); // debounce 300ms
});

// CLICK OUTSIDE
document.addEventListener('click', function(e){
    if (!input.contains(e.target) && !resultBox.contains(e.target)) {
        resultBox.classList.add('hidden');
    }
});
</script>

</body>
</html>