<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - PhoneShop Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root { --sidebar-width: 260px; --sidebar-bg: #0f172a; }
        body { font-family: 'Be Vietnam Pro', sans-serif; background: #f1f5f9; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            transition: transform .3s;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            color: #fff;
            font-size: 1.3rem;
            font-weight: 700;
        }
        .sidebar-brand span { color: #fbbf24; }
        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .sidebar-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #475569;
            padding: .5rem 1.25rem .25rem;
        }
        .sidebar .nav-link {
            color: #94a3b8;
            padding: .6rem 1.25rem;
            border-radius: 8px;
            margin: 2px .75rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .9rem;
            transition: background .2s, color .2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }
        .sidebar .nav-link.active { background: #2563eb; color: #fff; }
        .sidebar .nav-link i { font-size: 1.1rem; width: 20px; }

        /* Main content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: .75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .page-content { padding: 1.5rem; flex: 1; }

        /* Cards */
        .stat-card { border: none; border-radius: 14px; overflow: hidden; }
        .card { border: none; border-radius: 12px; box-shadow: 0 1px 6px rgba(0,0,0,0.06); }
        .table th { background: #f8fafc; font-weight: 600; font-size: .85rem; }

        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-phone-fill me-2"></i>Phone<span>Shop</span>
        <div class="small text-muted mt-1" style="font-size:.75rem; font-weight:400;">Quản trị hệ thống</div>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-label">Tổng quan</div>
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="sidebar-label mt-2">Quản lý</div>
        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
            <i class="bi bi-phone"></i> Sản phẩm
        </a>
        <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
            <i class="bi bi-tags"></i> Danh mục
        </a>
        <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
            <i class="bi bi-bag-check"></i> Đơn hàng
        </a>
        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
            <i class="bi bi-people"></i> Người dùng
        </a>

        <div class="sidebar-label mt-2">Hệ thống</div>
        <a class="nav-link" href="{{ route('home') }}" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> Xem website
        </a>
    </nav>

    <div class="p-3 border-top border-secondary">
        <div class="d-flex align-items-center gap-2 text-muted small">
            <i class="bi bi-person-circle fs-5 text-light"></i>
            <div>
                <div class="text-white fw-semibold">{{ auth()->user()->name }}</div>
                <div style="font-size:.75rem;">Administrator</div>
            </div>
        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <!-- TOPBAR -->
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-light d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list fs-5"></i>
            </button>
            <div>
                <h5 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h5>
                <nav aria-label="breadcrumb" class="d-none d-md-block">
                    <ol class="breadcrumb mb-0 small">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Admin</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-1"></i>Đăng xuất
                </button>
            </form>
        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="page-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
