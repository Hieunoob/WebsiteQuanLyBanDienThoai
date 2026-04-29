<<<<<<< HEAD
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Phone Shop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { font-size: .875rem; background-color: #f8f9fa; }
        .sidebar { position: fixed; top: 0; bottom: 0; left: 0; z-index: 100; padding: 48px 0 0; box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1); background-color: #212529; }
        .sidebar .nav-link { font-weight: 500; color: #dee2e6; padding: 10px 20px; }
        .sidebar .nav-link:hover { color: #fff; background-color: rgba(255, 255, 255, .1); }
        .sidebar .nav-link.active { color: #0d6efd; background-color: rgba(13, 110, 253, .1); }
        .navbar-brand { padding-top: .75rem; padding-bottom: .75rem; background-color: rgba(0, 0, 0, .25); }
        main { padding-top: 20px; }
    </style>
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">HIEU PHONE SHOP</a>
    <div class="navbar-nav w-100 d-flex flex-row justify-content-end">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3 text-white" href="{{ route('customer.home') }}" target="_blank">
                Xem Website <i class="bi bi-box-arrow-up-right"></i>
            </a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="/admin">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <i class="bi bi-tags me-2"></i> Quản lý danh mục
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <i class="bi bi-phone me-2"></i> Quản lý sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/orders*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                            <i class="bi bi-cart me-2"></i> Đơn hàng
                        </a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                             <i class="bi bi-people me-2"></i> Quản lý tài khoản
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                     <span>Cài đặt hệ thống</span>
                </h6>
                <ul class="nav flex-column mb-2">
                     <li class="nav-item">
                         <a class="nav-link" href="#">
                             <i class="bi bi-person-gear me-2"></i> Tài khoản Admin
                         </a>
                     </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            
            @if(View::hasSection('content'))
                @yield('content')
            @else
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Bảng điều khiển</h1>
                    <p class="text-muted">Chào mừng **LÊ TRUNG HIẾU** quay trở lại hệ thống.</p>
                    
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4 shadow-sm">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="small text-white-50">Sản phẩm</div>
                                        <div class="display-6 fw-bold">{{ $productCount ?? 0 }}</div>
                                    </div>
                                    <i class="bi bi-phone fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4 shadow-sm">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="small text-white-50">Tài khoản</div>
                                        <div class="display-6 fw-bold">{{ $userCount ?? 0 }}</div>
                                    </div>
                                    <i class="bi bi-people fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4 shadow-sm">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="small text-white-50">Danh mục</div>
                                        <div class="display-6 fw-bold">{{ $categoryCount ?? 0 }}</div>
                                    </div>
                                    <i class="bi bi-tags fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4 shadow-sm">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="small text-white-50">Đơn hàng</div>
                                        <div class="display-6 fw-bold">{{ $orderCount ?? 0 }}</div>
                                    </div>
                                    <i class="bi bi-cart fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-8">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-white font-weight-bold">
                                    <i class="bi bi-bar-chart-line me-1"></i> Thống kê sản phẩm
                                </div>
                                <div class="card-body">
                                    <canvas id="myProductChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-white font-weight-bold">
                                    <i class="bi bi-bell me-1"></i> Thông báo nhanh
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item small">Hệ thống hoạt động tốt.</li>
                                        <li class="list-group-item small text-danger">Có sản phẩm sắp hết hàng!</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myProductChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels ?? []) !!},
                datasets: [{
                    label: 'Số lượng sản phẩm',
                    data: {!! json_encode($chartData ?? []) !!},
                    backgroundColor: 'rgba(13, 110, 253, 0.2)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 1
                }]
            }
        });
    }
</script>
</body>
</html>
=======
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<!-- STAT CARDS -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card text-white" style="background:linear-gradient(135deg,#2563eb,#3b82f6);">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-phone fs-3"></i>
                </div>
                <div>
                    <div class="opacity-75 small">Tổng sản phẩm</div>
                    <div class="fs-2 fw-bold">{{ $stats['products'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card text-white" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-tags fs-3"></i>
                </div>
                <div>
                    <div class="opacity-75 small">Danh mục</div>
                    <div class="fs-2 fw-bold">{{ $stats['categories'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card text-white" style="background:linear-gradient(135deg,#f59e0b,#f97316);">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-bag-check fs-3"></i>
                </div>
                <div>
                    <div class="opacity-75 small">Đơn hàng</div>
                    <div class="fs-2 fw-bold">{{ $stats['orders'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card text-white" style="background:linear-gradient(135deg,#059669,#10b981);">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-people fs-3"></i>
                </div>
                <div>
                    <div class="opacity-75 small">Người dùng</div>
                    <div class="fs-2 fw-bold">{{ $stats['users'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- ĐƠN HÀNG MỚI NHẤT -->
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="bi bi-bag-check me-2"></i>Đơn hàng mới nhất</h6>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="text-decoration-none fw-semibold">#{{ $order->id }}</a></td>
                            <td>{{ $order->customer_name }}</td>
                            <td class="text-danger fw-semibold">{{ $order->formatted_total }}</td>
                            <td><span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">Chưa có đơn hàng nào</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TRẠNG THÁI ĐƠN HÀNG -->
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0 fw-bold"><i class="bi bi-pie-chart me-2"></i>Phân bổ đơn hàng</h6>
            </div>
            <div class="card-body">
                @php
                    $statusLabels = \App\Models\Order::$statuses;
                    $statusColors = ['pending' => 'warning', 'processing' => 'info', 'completed' => 'success', 'cancelled' => 'danger'];
                    $total = array_sum($orderStats);
                @endphp
                @foreach($statusLabels as $key => $label)
                @php
                    $count = $orderStats[$key] ?? 0;
                    $percent = $total > 0 ? round($count / $total * 100) : 0;
                @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>{{ $label }}</span>
                        <span class="fw-semibold">{{ $count }} ({{ $percent }}%)</span>
                    </div>
                    <div class="progress" style="height:8px;">
                        <div class="progress-bar bg-{{ $statusColors[$key] }}" style="width:{{ $percent }}%"></div>
                    </div>
                </div>
                @endforeach

                <div class="text-center mt-4">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-right me-1"></i>Quản lý đơn hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QUICK LINKS -->
<div class="row g-3 mt-1">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Thao tác nhanh</h6>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Thêm sản phẩm</a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-purple" style="background:#7c3aed;color:#fff;"><i class="bi bi-plus-circle me-2"></i>Thêm danh mục</a>
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="btn btn-warning"><i class="bi bi-clock me-2"></i>Đơn chờ xử lý</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
>>>>>>> 3bcf823 (update giao diện admin)
