@extends('layouts.app')

@section('title', 'Lịch sử đơn hàng')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4"><i class="bi bi-bag-check me-2"></i>Đơn hàng của tôi</h2>

    @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="card mb-3">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <div>
                    <span class="fw-bold">Đơn hàng #{{ $order->id }}</span>
                    <span class="text-muted small ms-3">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <span class="badge bg-{{ $order->status_color }} fs-6">{{ $order->status_label }}</span>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        @foreach($order->orderItems->take(3) as $item)
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <img src="{{ $item->product->image ?: 'https://via.placeholder.com/40x40?text=P' }}"
                                 style="width:40px; height:40px; object-fit:cover; border-radius:6px;"
                                 onerror="this.src='https://via.placeholder.com/40x40?text=P'">
                            <div class="small">
                                <div>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</div>
                                <div class="text-muted">x{{ $item->quantity }}</div>
                            </div>
                        </div>
                        @endforeach
                        @if($order->orderItems->count() > 3)
                        <div class="text-muted small">...và {{ $order->orderItems->count() - 3 }} sản phẩm khác</div>
                        @endif
                    </div>
                    <div class="col-md-3 text-md-center">
                        <div class="text-muted small">Tổng tiền</div>
                        <div class="fw-bold text-danger">{{ $order->formatted_total }}</div>
                    </div>
                    <div class="col-md-3 text-md-end mt-2 mt-md-0">
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye me-1"></i>Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="d-flex justify-content-center mt-3">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-bag-x display-1 text-muted"></i>
            <h5 class="mt-3 text-muted">Bạn chưa có đơn hàng nào</h5>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">Mua sắm ngay</a>
        </div>
    @endif
</div>
@endsection
