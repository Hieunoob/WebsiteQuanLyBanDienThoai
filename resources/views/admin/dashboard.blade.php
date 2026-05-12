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
