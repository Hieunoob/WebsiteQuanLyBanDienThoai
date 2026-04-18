@extends('customer.layouts.app')

@section('title', 'Giới thiệu')

@section('content')

<!-- 🔥 HERO -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl p-10 mb-10 shadow-lg">
    <h1 class="text-4xl font-bold mb-2">Về Phone Shop</h1>
    <p class="text-lg opacity-90">
        Nơi cung cấp điện thoại chính hãng, giá tốt nhất thị trường
    </p>
</div>

<!-- 🔥 CHÚNG TÔI LÀ AI -->
<div class="grid md:grid-cols-2 gap-10 mb-12 items-center">

    <!-- 🎬 SLIDER -->
    <div class="relative overflow-hidden rounded-xl shadow-lg h-[320px]">
        <div id="aboutSlider" class="flex transition-transform duration-700">

            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9"
                 class="min-w-full h-[320px] object-cover">

            <img src="https://images.unsplash.com/photo-1510557880182-3d4d3cba35a5"
                 class="min-w-full h-[320px] object-cover">

            <img src="https://images.unsplash.com/photo-1495433324511-bf8e92934d90"
                 class="min-w-full h-[320px] object-cover">

        </div>
    </div>

    <!-- 📖 TEXT + FAQ -->
    <div>
        <h2 class="text-2xl font-bold mb-4">Chúng tôi là ai?</h2>

        <p class="text-gray-600 mb-4 leading-relaxed">
            Phone Shop là hệ thống bán lẻ điện thoại uy tín, chuyên cung cấp các sản phẩm chính hãng
            như iPhone, Samsung, Xiaomi với giá cạnh tranh và dịch vụ tận tâm.
        </p>

        <!-- 🔥 FAQ -->
        <div class="space-y-4 mt-6">

            <div class="bg-white rounded-xl shadow">
                <button class="faq-toggle w-full flex justify-between items-center p-4 text-left">
                    <span class="font-semibold">Shop có uy tín không?</span>
                    <span class="material-icons arrow transition-transform">expand_more</span>
                </button>
                <div class="faq-content overflow-hidden max-h-0 opacity-0 px-4 text-gray-600 transition-all duration-300">
    Chúng tôi cam kết 100% hàng chính hãng, bảo hành đầy đủ và hỗ trợ khách hàng tận tâm.
</div>
            </div>

            <div class="bg-white rounded-xl shadow">
                <button class="faq-toggle w-full flex justify-between items-center p-4 text-left">
                    <span class="font-semibold">Có giao hàng toàn quốc không?</span>
                    <span class="material-icons arrow transition-transform">expand_more</span>
                </button>
                <div class="faq-content overflow-hidden max-h-0 opacity-0 px-4 text-gray-600 transition-all duration-300">
                    Chúng tôi giao hàng toàn quốc nhanh chóng, đảm bảo an toàn sản phẩm.
                </div>
            </div>

            <div class="bg-white rounded-xl shadow">
                <button class="faq-toggle w-full flex justify-between items-center p-4 text-left">
                    <span class="font-semibold">Có được kiểm tra hàng không?</span>
                    <span class="material-icons arrow transition-transform">expand_more</span>
                </button>
                <div class="faq-content overflow-hidden max-h-0 opacity-0 px-4 text-gray-600 transition-all duration-300">
                    Khách hàng được kiểm tra sản phẩm trước khi thanh toán.
                </div>
            </div>

        </div>

    </div>

</div>

<!-- 🔥 ƯU ĐIỂM -->
<div class="mb-12">

    <h2 class="text-2xl font-bold text-center mb-8">Tại sao chọn chúng tôi?</h2>

    <div class="grid md:grid-cols-4 gap-6 text-center">

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
            <span class="material-icons text-blue-500 text-4xl">verified</span>
            <h3 class="font-bold mt-3">Chính hãng</h3>
            <p class="text-gray-500 text-sm">100% sản phẩm chính hãng</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
            <span class="material-icons text-green-500 text-4xl">local_shipping</span>
            <h3 class="font-bold mt-3">Giao nhanh</h3>
            <p class="text-gray-500 text-sm">Giao hàng toàn quốc</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
            <span class="material-icons text-red-500 text-4xl">price_check</span>
            <h3 class="font-bold mt-3">Giá tốt</h3>
            <p class="text-gray-500 text-sm">Cam kết giá cạnh tranh</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
            <span class="material-icons text-indigo-500 text-4xl">support_agent</span>
            <h3 class="font-bold mt-3">Hỗ trợ 24/7</h3>
            <p class="text-gray-500 text-sm">Luôn sẵn sàng hỗ trợ</p>
        </div>

    </div>

</div>

<!-- 🔥 CAM KẾT -->
<div class="bg-white rounded-xl shadow p-8 mb-12">
    <h2 class="text-2xl font-bold mb-4">Cam kết của chúng tôi</h2>
    <ul class="space-y-3 text-gray-600">
        <li>✔ Sản phẩm chính hãng 100%</li>
        <li>✔ Bảo hành đầy đủ</li>
        <li>✔ Hoàn tiền nếu lỗi</li>
        <li>✔ Dịch vụ khách hàng tận tâm</li>
    </ul>
</div>

<!-- 🔥 CTA -->
<div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white text-center p-10 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold mb-3">Mua sắm ngay hôm nay!</h2>
    <p class="mb-5">Khám phá hàng trăm sản phẩm hấp dẫn</p>
    <a href="{{ route('customer.home') }}"
       class="bg-white text-green-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100">
       Xem sản phẩm
    </a>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.faq-toggle').forEach(btn => {
        btn.addEventListener('click', function () {

            const content = this.nextElementSibling;
            const arrow = this.querySelector('.arrow');

            if (content.classList.contains('max-h-0')) {
                // MỞ
                content.classList.remove('max-h-0', 'opacity-0');
                content.classList.add('max-h-40', 'opacity-100', 'py-2');

                arrow.classList.add('rotate-180');
            } else {
                // ĐÓNG
                content.classList.remove('max-h-40', 'opacity-100', 'py-2');
                content.classList.add('max-h-0', 'opacity-0');

                arrow.classList.remove('rotate-180');
            }

        });
    });

});
</script>

@endsection