<<<<<<< HEAD
@extends('admin.dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Quản lý đơn hàng</h1>
    
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-white">
            <i class="bi bi-cart me-1"></i> Danh sách đơn hàng
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td class="text-success fw-bold">{{ number_format($order->total_price) }}₫</td>
                                <td>
                                    <span class="badge 
                                        @if($order->status === 'pending') bg-warning
                                        @elseif($order->status === 'processing') bg-info
                                        @elseif($order->status === 'completed') bg-success
                                        @elseif($order->status === 'cancelled') bg-danger
                                        @endif
                                    ">
                                        @switch($order->status)
                                            @case('pending')
                                                Chờ xử lý
                                                @break
                                            @case('processing')
                                                Đang xử lý
                                                @break
                                            @case('completed')
                                                Hoàn thành
                                                @break
                                            @case('cancelled')
                                                Hủy
                                                @break
                                        @endswitch
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Xem
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox"></i> Không có đơn hàng nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                {{ $orders->links() }}
            </nav>
        </div>
    </div>
=======
@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('breadcrumb')
    <li class="breadcrumb-item active">Đơn hàng</li>
@endsection

@section('content')
<!-- Lọc theo trạng thái -->
<div class="d-flex gap-2 mb-3 flex-wrap">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-outline-secondary' }}">Tất cả</a>
    @foreach(\App\Models\Order::$statuses as $key => $label)
    <a href="{{ route('admin.orders.index', ['status' => $key]) }}"
       class="btn btn-sm {{ request('status') === $key ? 'btn-primary' : 'btn-outline-secondary' }}">
        {{ $label }}
        @php $cnt = \App\Models\Order::where('status', $key)->count(); @endphp
        @if($cnt > 0)<span class="badge bg-danger ms-1">{{ $cnt }}</span>@endif
    </a>
    @endforeach
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>SĐT</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                    <th class="text-end">Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="fw-bold">#{{ $order->id }}</td>
                    <td>
                        <div>{{ $order->customer_name }}</div>
                        <div class="text-muted small">{{ $order->user->email ?? '' }}</div>
                    </td>
                    <td>{{ $order->phone }}</td>
                    <td class="text-danger fw-semibold">{{ $order->formatted_total }}</td>
                    <td><span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span></td>
                    <td class="text-muted small">{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Không có đơn hàng nào</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="card-footer bg-white">{{ $orders->appends(request()->query())->links() }}</div>
    @endif
>>>>>>> 3bcf823 (update giao diện admin)
</div>
@endsection
