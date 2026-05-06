@extends('layouts.app')

@section('title', 'PhoneShop — Điện thoại chính hãng')

@section('content')

{{-- ── HERO ── --}}
<section class="hero-section">
    <img class="hero-bg"
         src="https://images.unsplash.com/photo-1678685888221-cebf3d084f1c?auto=format&fit=crop&w=1600&q=90"
         onerror="this.src='https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=1600&q=90'"
         alt="PhoneShop hero">
    <div class="hero-content">
        <div class="hero-eyebrow">Tháng {{ date('m') }} / {{ date('Y') }}</div>
        <h1 class="hero-title">Điện thoại chính hãng<br>Giá tốt nhất thị trường</h1>
        <p class="hero-sub">iPhone, Samsung, Xiaomi, OPPO và nhiều thương hiệu uy tín khác.</p>
        <div class="hero-ctas">
            <a href="{{ route('products.index') }}" class="btn-primary-tesla">Mua ngay</a>
            <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="btn-secondary-tesla" style="border-color:rgba(255,255,255,0.5);color:#fff;background:rgba(255,255,255,0.12);">Hàng mới về</a>
        </div>
    </div>
</section>

{{-- ── TRUST STRIP ── --}}
<div class="trust-strip">
    <div class="container" style="max-width:1200px;">
        <div class="row g-0">
            @foreach([
                ['🚚','Miễn phí vận chuyển','Đơn từ 3 triệu'],
                ['🛡','Bảo hành 12 tháng','Hàng chính hãng'],
                ['🔄','Đổi trả 30 ngày','Nếu có lỗi NSX'],
                ['🎧','Hỗ trợ 24/7','Hotline 1800 xxxx'],
            ] as $i => $t)
            <div class="col-6 col-md-3 {{ $i < 3 ? 'border-end' : '' }}">
                <div class="trust-item px-3 justify-content-center justify-content-md-start">
                    <span class="trust-item-icon">{{ $t[0] }}</span>
                    <div>
                        <div class="trust-item-label">{{ $t[1] }}</div>
                        <div class="trust-item-sub">{{ $t[2] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ── DANH MỤC ── --}}
<section class="py-5 section-white">
    <div class="container" style="max-width:1200px;">
        <div class="mb-4">
            <div class="section-label">Khám phá</div>
            <div class="section-heading">Danh mục điện thoại</div>
        </div>
        @php
        $catImages = [
            'iphone'  => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=800&q=85',
            'samsung' => 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?auto=format&fit=crop&w=800&q=85',
            'xiaomi'  => 'https://images.unsplash.com/photo-1574944985070-8f3ebc6b79d2?auto=format&fit=crop&w=800&q=85',
            'oppo'    => 'https://images.unsplash.com/photo-1596742578443-7682ef5251cd?auto=format&fit=crop&w=800&q=85',
            'vivo'    => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=85',
        ];
        @endphp
        <div class="row g-3">
            @foreach($categories as $cat)
            @php $img = $catImages[$cat->slug] ?? 'https://images.unsplash.com/photo-1598327105854-c8674faddf79?auto=format&fit=crop&w=800&q=85'; @endphp
            <div class="col-6 col-md-4">
                <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="cat-card-tesla d-block">
                    <img src="{{ $img }}" alt="{{ $cat->name }}" loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=85'">
                    <div class="cat-card-label">{{ $cat->name }}</div>
                    <div class="cat-card-count">{{ $cat->products_count }} sản phẩm</div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── SẢN PHẨM NỔI BẬT ── --}}
@if($featuredProducts->count() > 0)
<section class="py-5 section-ash">
    <div class="container" style="max-width:1200px;">
        <div class="d-flex align-items-end justify-content-between mb-4">
            <div>
                <div class="section-label">Được yêu thích</div>
                <div class="section-heading">Sản phẩm nổi bật</div>
            </div>
            <a href="{{ route('products.index') }}" class="btn-ghost-tesla">Xem tất cả →</a>
        </div>
        <div class="row g-3">
            @foreach($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── PROMO STRIP ── --}}
<section class="promo-strip">
    <div class="container" style="max-width:1200px;">
        <div class="row g-0">
            <div class="col-md-6" style="border-right:1px solid var(--cloud);">
                <div class="promo-item">
                    <div class="promo-eyebrow">Ưu đãi đặc biệt</div>
                    <div class="promo-title">Quà tặng hấp dẫn</div>
                    <div class="promo-desc">Tặng ốp lưng + kính cường lực khi mua điện thoại từ 5 triệu đồng.</div>
                    <a href="{{ route('products.index') }}" class="btn-primary-tesla">Xem ngay</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="promo-item">
                    <div class="promo-eyebrow">Tài chính linh hoạt</div>
                    <div class="promo-title">Trả góp 0% lãi suất</div>
                    <div class="promo-desc">Mua điện thoại trả góp 0% lãi suất, phân kỳ lên đến 12 tháng.</div>
                    <a href="{{ route('products.index') }}" class="btn-secondary-tesla">Tìm hiểu</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── HÀNG MỚI VỀ ── --}}
@if($newProducts->count() > 0)
<section class="py-5 section-white">
    <div class="container" style="max-width:1200px;">
        <div class="d-flex align-items-end justify-content-between mb-4">
            <div>
                <div class="section-label">Vừa về kho</div>
                <div class="section-heading">Hàng mới nhất</div>
            </div>
            <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="btn-ghost-tesla">Xem tất cả →</a>
        </div>
        <div class="row g-3">
            @foreach($newProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                @include('partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
