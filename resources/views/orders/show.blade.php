@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Chi tiết đơn hàng #{{ $order->id }}</h2>
        <a href="{{ route('orders.history') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Quay lại
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white fw-bold">Sản phẩm đã đặt</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead><tr><th>Sản phẩm</th><th class="text-center">SL</th><th class="text-end">Thành tiền</th></tr></thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr class="align-middle">
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $item->product->image ?: 'https://via.placeholder.com/50x50?text=P' }}"
                                             style="width:50px; height:50px; object-fit:cover; border-radius:6px;"
                                             onerror="this.src='https://via.placeholder.com/50x50?text=P'">
                                        <div>
                                            <div>{{ $item->product->name ?? 'Sản phẩm không còn tồn tại' }}</div>
                                            <div class="text-muted small">{{ number_format($item->price, 0, ',', '.') }}₫/cái</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end fw-bold">{{ $item->formatted_subtotal }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr><td colspan="2" class="text-end fw-bold">Tổng cộng:</td>
                            <td class="text-end fw-bold text-danger fs-5">{{ $order->formatted_total }}</td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header bg-white fw-bold">Thông tin giao hàng</div>
                <div class="card-body">
                    <p><i class="bi bi-person me-2 text-primary"></i>{{ $order->customer_name }}</p>
                    <p><i class="bi bi-telephone me-2 text-primary"></i>{{ $order->phone }}</p>
                    <p><i class="bi bi-geo-alt me-2 text-primary"></i>{{ $order->address }}</p>
                    @if($order->note)
                    <p><i class="bi bi-chat-left me-2 text-primary"></i>{{ $order->note }}</p>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="text-muted small mb-2">Trạng thái đơn hàng</div>
                    <span class="badge bg-{{ $order->status_color }} fs-5 px-4 py-2">{{ $order->status_label }}</span>
                    <div class="text-muted small mt-2">Đặt lúc: {{ $order->created_at->format('H:i d/m/Y') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
