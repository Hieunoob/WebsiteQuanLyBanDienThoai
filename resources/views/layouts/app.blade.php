<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PhoneShop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* ── TESLA DESIGN SYSTEM ── */
        :root {
            --blue:        #3E6AE1;
            --blue-dark:   #2f55c4;
            --carbon:      #171A20;
            --graphite:    #393C41;
            --pewter:      #5C5E62;
            --silver-fog:  #8E8E8E;
            --cloud:       #EEEEEE;
            --pale-silver: #D0D1D2;
            --light-ash:   #F4F4F4;
            --white:       #FFFFFF;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Be Vietnam Pro', -apple-system, Arial, sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.43;
            color: var(--graphite);
            background: var(--white);
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAVIGATION ── */
        .nav-main {
            position: sticky; top: 0; z-index: 1000;
            background: rgba(255,255,255,0.84);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--cloud);
            height: 56px;
            display: flex; align-items: center;
            transition: background 0.33s;
        }
        .nav-inner {
            width: 100%; max-width: 1383px; margin: 0 auto;
            padding: 0 24px;
            display: flex; align-items: center; gap: 0;
        }
        .nav-wordmark {
            font-size: 16px; font-weight: 500; color: var(--carbon);
            letter-spacing: 3px; text-transform: uppercase;
            text-decoration: none; flex-shrink: 0;
            transition: color 0.33s;
        }
        .nav-wordmark:hover { color: var(--graphite); }
        .nav-links {
            display: flex; align-items: center; gap: 0;
            margin: 0 auto;
        }
        .nav-link {
            font-size: 14px; font-weight: 500; color: var(--carbon);
            text-decoration: none; padding: 4px 16px; border-radius: 4px;
            transition: color 0.33s, background-color 0.33s;
            white-space: nowrap;
        }
        .nav-link:hover, .nav-link.active {
            background: var(--light-ash);
            color: var(--carbon);
        }
        .nav-utils {
            display: flex; align-items: center; gap: 4px; flex-shrink: 0;
        }
        .nav-icon-btn {
            width: 36px; height: 36px; border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            color: var(--carbon); text-decoration: none;
            transition: background-color 0.33s;
            background: transparent; border: none; cursor: pointer;
            font-size: 16px; position: relative;
        }
        .nav-icon-btn:hover { background: var(--light-ash); color: var(--carbon); }
        .cart-count {
            position: absolute; top: 2px; right: 2px;
            background: var(--blue); color: #fff;
            width: 16px; height: 16px; border-radius: 50%;
            font-size: 10px; font-weight: 500;
            display: flex; align-items: center; justify-content: center;
        }
        /* search bar */
        .nav-search-form { position: relative; }
        .nav-search-input {
            width: 200px; height: 32px;
            border: 1px solid var(--pale-silver);
            border-radius: 4px; padding: 0 12px 0 32px;
            font-size: 13px; color: var(--carbon);
            background: var(--white); outline: none;
            transition: border-color 0.33s, width 0.33s;
            font-family: inherit;
        }
        .nav-search-input::placeholder { color: var(--silver-fog); }
        .nav-search-input:focus { border-color: var(--blue); width: 240px; }
        .nav-search-icon {
            position: absolute; left: 10px; top: 50%; transform: translateY(-50%);
            color: var(--silver-fog); font-size: 12px; pointer-events: none;
        }

        /* ── BUTTONS ── */
        .btn-primary-tesla {
            display: inline-flex; align-items: center; justify-content: center;
            background: var(--blue); color: #fff;
            font-size: 14px; font-weight: 500; font-family: inherit;
            border: 3px solid transparent; border-radius: 4px;
            min-height: 40px; padding: 4px 20px;
            cursor: pointer; text-decoration: none;
            transition: background-color 0.33s, border-color 0.33s, color 0.33s;
        }
        .btn-primary-tesla:hover { background: var(--blue-dark); color: #fff; }
        .btn-secondary-tesla {
            display: inline-flex; align-items: center; justify-content: center;
            background: var(--white); color: var(--graphite);
            font-size: 14px; font-weight: 500; font-family: inherit;
            border: 3px solid var(--pale-silver); border-radius: 4px;
            min-height: 40px; padding: 4px 20px;
            cursor: pointer; text-decoration: none;
            transition: background-color 0.33s, border-color 0.33s;
        }
        .btn-secondary-tesla:hover { border-color: var(--graphite); color: var(--carbon); background: var(--white); }
        .btn-ghost-tesla {
            display: inline-flex; align-items: center; justify-content: center;
            background: transparent; color: var(--pewter);
            font-size: 14px; font-weight: 400; font-family: inherit;
            border: none; border-radius: 4px;
            padding: 4px 0; cursor: pointer; text-decoration: none;
            transition: color 0.33s, box-shadow 0.33s;
        }
        .btn-ghost-tesla:hover { color: var(--carbon); box-shadow: 0 1px 0 var(--carbon); }

        /* ── SECTIONS ── */
        .section-full {
            min-height: 100vh; display: flex; align-items: center;
            position: relative; overflow: hidden;
        }
        .section-white { background: var(--white); }
        .section-ash   { background: var(--light-ash); }

        /* ── HERO ── */
        .hero-section {
            min-height: calc(100vh - 56px);
            background: var(--carbon);
            display: flex; align-items: center;
            position: relative; overflow: hidden;
        }
        .hero-bg {
            position: absolute; inset: 0;
            object-fit: cover; width: 100%; height: 100%;
            opacity: 0.55;
        }
        .hero-content {
            position: relative; z-index: 1;
            text-align: center; width: 100%;
            padding: 80px 24px;
        }
        .hero-eyebrow {
            font-size: 14px; font-weight: 400; color: rgba(255,255,255,0.7);
            letter-spacing: 2px; text-transform: uppercase;
            margin-bottom: 16px;
        }
        .hero-title {
            font-size: clamp(28px, 5vw, 40px);
            font-weight: 500; color: #fff;
            line-height: 1.2; margin-bottom: 8px;
        }
        .hero-sub {
            font-size: 14px; font-weight: 400;
            color: rgba(255,255,255,0.75);
            margin-bottom: 32px;
        }
        .hero-ctas { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

        /* ── TRUST STRIP ── */
        .trust-strip {
            border-top: 1px solid var(--cloud);
            border-bottom: 1px solid var(--cloud);
            background: var(--white);
        }
        .trust-item {
            display: flex; align-items: center; gap: 10px;
            padding: 14px 0; font-size: 13px;
        }
        .trust-item-icon { font-size: 18px; color: var(--blue); flex-shrink: 0; }
        .trust-item-label { font-weight: 500; color: var(--carbon); }
        .trust-item-sub { font-size: 12px; color: var(--pewter); }

        /* ── SECTION TITLE ── */
        .section-label {
            font-size: 11px; font-weight: 500; color: var(--pewter);
            letter-spacing: 2px; text-transform: uppercase;
            margin-bottom: 12px;
        }
        .section-heading {
            font-size: 24px; font-weight: 500; color: var(--carbon);
            line-height: 1.2;
        }

        /* ── CATEGORY CARDS ── */
        .cat-card-tesla {
            border-radius: 12px; overflow: hidden;
            position: relative; display: block;
            text-decoration: none;
            aspect-ratio: 16/9;
            background: var(--carbon);
        }
        .cat-card-tesla img {
            width: 100%; height: 100%; object-fit: cover;
            opacity: 0.75;
            transition: opacity 0.33s, transform 0.33s;
        }
        .cat-card-tesla:hover img { opacity: 0.65; transform: scale(1.02); }
        .cat-card-label {
            position: absolute; top: 16px; left: 20px;
            font-size: 16px; font-weight: 500; color: #fff;
        }
        .cat-card-count {
            position: absolute; bottom: 16px; left: 20px;
            font-size: 12px; color: rgba(255,255,255,0.7);
        }

        /* ── PRODUCT CARD ── */
        .product-card-tesla {
            background: var(--white);
            border: 1px solid var(--cloud);
            border-radius: 4px;
            display: flex; flex-direction: column;
            height: 100%;
            transition: border-color 0.33s;
        }
        .product-card-tesla:hover { border-color: var(--pale-silver); }
        .product-img-area {
            background: var(--light-ash);
            display: flex; align-items: center; justify-content: center;
            height: 220px; overflow: hidden; border-radius: 4px 4px 0 0;
        }
        .product-img-area img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.33s;
        }
        .product-card-tesla:hover .product-img-area img { transform: scale(1.03); }
        .product-body-tesla {
            padding: 16px; flex: 1; display: flex; flex-direction: column; gap: 6px;
        }
        .product-brand {
            font-size: 12px; font-weight: 500; color: var(--pewter);
            letter-spacing: 1px; text-transform: uppercase;
        }
        .product-title {
            font-size: 14px; font-weight: 500; color: var(--carbon);
            line-height: 1.4;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .product-price {
            font-size: 17px; font-weight: 500; color: var(--carbon);
            margin-top: 2px;
        }
        .product-stock-in  { font-size: 12px; color: #2d7a3a; }
        .product-stock-out { font-size: 12px; color: #c0392b; }
        .product-actions-tesla {
            display: flex; gap: 8px; margin-top: auto; padding-top: 12px;
        }
        .product-actions-tesla .btn-primary-tesla,
        .product-actions-tesla .btn-secondary-tesla {
            flex: 1; min-height: 36px; font-size: 13px; padding: 4px 8px;
        }

        /* ── PROMO STRIP ── */
        .promo-strip {
            background: var(--light-ash);
            border-top: 1px solid var(--cloud);
            border-bottom: 1px solid var(--cloud);
        }
        .promo-item { padding: 48px 32px; }
        .promo-eyebrow {
            font-size: 11px; font-weight: 500; color: var(--pewter);
            letter-spacing: 2px; text-transform: uppercase; margin-bottom: 10px;
        }
        .promo-title { font-size: 22px; font-weight: 500; color: var(--carbon); margin-bottom: 8px; }
        .promo-desc  { font-size: 14px; color: var(--pewter); margin-bottom: 20px; max-width: 380px; }

        /* ── FOOTER ── */
        .footer-tesla {
            background: var(--light-ash);
            border-top: 1px solid var(--cloud);
            padding: 40px 0 24px;
            font-size: 13px; color: var(--pewter);
        }
        .footer-brand {
            font-size: 13px; font-weight: 500; color: var(--carbon);
            letter-spacing: 2.5px; text-transform: uppercase; margin-bottom: 12px;
        }
        .footer-tesla h6 {
            font-size: 11px; font-weight: 500; color: var(--carbon);
            letter-spacing: 1.5px; text-transform: uppercase;
            margin-bottom: 14px;
        }
        .footer-tesla a {
            color: var(--pewter); text-decoration: none;
            transition: color 0.33s;
            display: block; margin-bottom: 8px; font-size: 13px;
        }
        .footer-tesla a:hover { color: var(--carbon); }
        .footer-bottom {
            border-top: 1px solid var(--cloud); margin-top: 32px;
            padding-top: 16px; font-size: 12px;
            display: flex; justify-content: space-between;
            align-items: center; flex-wrap: wrap; gap: 8px;
        }

        /* ── TOASTS ── */
        .toast-zone { position: fixed; top: 64px; right: 16px; z-index: 9999; width: 320px; }
        .toast-tesla {
            background: var(--white); border: 1px solid var(--cloud);
            border-radius: 4px; padding: 14px 16px;
            display: flex; align-items: flex-start; gap: 12px;
            margin-bottom: 8px;
            animation: fadeSlide 0.33s cubic-bezier(0.5,0,0,0.75);
            font-size: 14px; color: var(--graphite);
        }
        .toast-tesla.success .toast-dot { background: #2d7a3a; }
        .toast-tesla.error   .toast-dot { background: #c0392b; }
        .toast-dot {
            width: 8px; height: 8px; border-radius: 50%;
            flex-shrink: 0; margin-top: 4px;
        }
        .toast-close {
            margin-left: auto; background: none; border: none;
            color: var(--silver-fog); cursor: pointer; font-size: 16px;
            padding: 0; line-height: 1; flex-shrink: 0;
        }
        @keyframes fadeSlide {
            from { transform: translateX(100%); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }

        /* ── DROPDOWN ── */
        .dropdown-tesla { min-width: 180px; border-radius: 4px; border: 1px solid var(--cloud); box-shadow: none; padding: 6px 0; }
        .dropdown-tesla .dropdown-item { font-size: 14px; color: var(--graphite); padding: 8px 16px; transition: background-color 0.33s; }
        .dropdown-tesla .dropdown-item:hover { background: var(--light-ash); color: var(--carbon); }
        .dropdown-tesla .dropdown-divider { border-color: var(--cloud); margin: 4px 0; }

        /* ── PAGINATION ── */
        .pagination .page-link {
            color: var(--graphite); border-color: var(--cloud);
            border-radius: 4px !important; font-size: 13px;
            transition: background-color 0.33s, color 0.33s;
        }
        .pagination .page-item.active .page-link { background: var(--blue); border-color: var(--blue); }
        .pagination .page-link:hover { background: var(--light-ash); color: var(--carbon); }

        /* ── BACK TO TOP ── */
        .back-top {
            position: fixed; bottom: 24px; right: 24px; z-index: 998;
            width: 36px; height: 36px; border-radius: 4px;
            background: var(--white); border: 1px solid var(--pale-silver);
            color: var(--graphite); cursor: pointer; font-size: 14px;
            display: none; align-items: center; justify-content: center;
            transition: border-color 0.33s, color 0.33s;
        }
        .back-top:hover { border-color: var(--carbon); color: var(--carbon); }
        .back-top.show { display: flex; }

        /* ── UTILITIES ── */
        .divider { height: 1px; background: var(--cloud); }
    </style>
    @stack('styles')
</head>
<body>

{{-- NAVIGATION --}}
<nav class="nav-main">
    <div class="nav-inner">
        {{-- Wordmark --}}
        <a href="{{ route('home') }}" class="nav-wordmark">PhoneShop</a>

        {{-- Center nav links --}}
        <div class="nav-links d-none d-md-flex">
            <a href="{{ route('home') }}"
               class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Trang chủ</a>
            <a href="{{ route('products.index') }}"
               class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Điện thoại</a>
        </div>

        {{-- Right utilities --}}
        <div class="nav-utils ms-auto">
            {{-- Search --}}
            <form action="{{ route('products.index') }}" method="GET" class="nav-search-form d-none d-lg-block me-1">
                <i class="bi bi-search nav-search-icon"></i>
                <input class="nav-search-input" type="search" name="search"
                       placeholder="Tìm điện thoại..." value="{{ request('search') }}">
            </form>

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}" class="nav-icon-btn">
                <i class="bi bi-bag"></i>
                @php $cartCount = count(session('cart', [])); @endphp
                @if($cartCount > 0)
                    <span class="cart-count">{{ $cartCount }}</span>
                @endif
            </a>

            {{-- Auth --}}
            @guest
                <a href="{{ route('login') }}" class="nav-link d-none d-lg-inline-flex">Đăng nhập</a>
                <a href="{{ route('register') }}" class="btn-primary-tesla ms-1">Đăng ký</a>
            @endguest

            @auth
                <div class="dropdown ms-1">
                    <button class="btn-secondary-tesla dropdown-toggle" data-bs-toggle="dropdown" style="gap:6px;">
                        <span style="width:20px;height:20px;border-radius:50%;background:var(--blue);color:#fff;font-size:10px;font-weight:500;display:inline-flex;align-items:center;justify-content:center;">
                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                        </span>
                        <span class="d-none d-lg-inline">{{ Str::limit(auth()->user()->name, 12) }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-tesla">
                        <li class="px-4 py-2" style="border-bottom:1px solid var(--cloud);margin-bottom:4px;">
                            <div style="font-weight:500;color:var(--carbon);font-size:14px;">{{ auth()->user()->name }}</div>
                            <div style="color:var(--pewter);font-size:12px;">{{ auth()->user()->email }}</div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('orders.history') }}">
                                <i class="bi bi-bag me-2" style="color:var(--blue);"></i>Đơn hàng của tôi
                            </a>
                        </li>
                        @if(auth()->user()->isAdmin())
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}" style="color:var(--blue);font-weight:500;">
                                <i class="bi bi-speedometer2 me-2"></i>Quản trị
                            </a>
                        </li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit" style="color:#c0392b;">
                                    <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>

{{-- TOASTS --}}
@if(session('success') || session('error'))
<div class="toast-zone" id="toastZone">
    @if(session('success'))
    <div class="toast-tesla success">
        <span class="toast-dot"></span>
        <span>{{ session('success') }}</span>
        <button class="toast-close" onclick="this.closest('.toast-tesla').remove()">×</button>
    </div>
    @endif
    @if(session('error'))
    <div class="toast-tesla error">
        <span class="toast-dot"></span>
        <span>{{ session('error') }}</span>
        <button class="toast-close" onclick="this.closest('.toast-tesla').remove()">×</button>
    </div>
    @endif
</div>
@endif

@yield('content')

{{-- FOOTER --}}
<footer class="footer-tesla">
    <div class="container" style="max-width:1200px;">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-brand">PhoneShop</div>
                <p style="max-width:280px;color:var(--pewter);font-size:13px;line-height:1.6;">
                    Cửa hàng điện thoại chính hãng. Cam kết sản phẩm xịn, giá tốt, bảo hành đầy đủ.
                </p>
            </div>
            <div class="col-6 col-lg-2">
                <h6>Danh mục</h6>
                <a href="{{ route('products.index', ['category'=>'iphone']) }}">iPhone</a>
                <a href="{{ route('products.index', ['category'=>'samsung']) }}">Samsung</a>
                <a href="{{ route('products.index', ['category'=>'xiaomi']) }}">Xiaomi</a>
                <a href="{{ route('products.index', ['category'=>'oppo']) }}">OPPO</a>
                <a href="{{ route('products.index', ['category'=>'vivo']) }}">Vivo</a>
            </div>
            <div class="col-6 col-lg-3">
                <h6>Hỗ trợ</h6>
                <a href="#">Chính sách bảo hành</a>
                <a href="#">Đổi trả 30 ngày</a>
                <a href="#">Hướng dẫn đặt hàng</a>
                <a href="#">Câu hỏi thường gặp</a>
                <a href="#">Liên hệ hỗ trợ</a>
            </div>
            <div class="col-lg-3">
                <h6>Liên hệ</h6>
                <a href="#">123 Đường ABC, Quận 1, TP.HCM</a>
                <a href="#">1800 xxxx (Miễn phí)</a>
                <a href="#">08:00 – 22:00 mỗi ngày</a>
                <a href="#">support@phoneshop.vn</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© {{ date('Y') }} PhoneShop. Bài tập lớn môn Lập trình Web.</span>
            <span style="color:var(--silver-fog);">Made with care by sinh viên</span>
        </div>
    </div>
</footer>

<button class="back-top" id="backTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <i class="bi bi-chevron-up"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('scroll', () => {
        document.getElementById('backTop').classList.toggle('show', window.scrollY > 500);
    });
    setTimeout(() => {
        document.querySelectorAll('.toast-tesla').forEach(el => {
            el.style.transition = 'opacity 0.33s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        });
    }, 4000);
</script>
@stack('scripts')
</body>
</html>
