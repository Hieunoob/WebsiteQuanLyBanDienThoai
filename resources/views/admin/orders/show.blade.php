@extends('layouts.admin')

@section('title', 'Đơn hàng #' . $order->id)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}" class="text-decoration-none">Đơn hàng</a></li>
    <li class="breadcrumb-item active">#{{ $order->id }}</li>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-white fw-bold">Sản phẩm trong đơn hàng</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead><tr><th>Sản phẩm</th><th class="text-center">SL</th><th class="text-center">Đơn giá</th><th class="text-end">Thành tiền</th></tr></thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr class="align-middle">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $item->product->image ?: 'https://via.placeholder.com/50x50?text=P' }}"
                                         style="width:50px;height:50px;object-fit:cover;border-radius:8px;"
                                         onerror="this.src='https://via.placeholder.com/50x50?text=P'">
                                    <div>
                                        <div class="fw-semibold">{{ $item->product->name ?? 'Đã xóa' }}</div>
                                        <div class="text-muted small">{{ $item->product->brand ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-center">{{ number_format($item->price, 0, ',', '.') }}₫</td>
                            <td class="text-end fw-bold">{{ $item->formatted_subtotal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                            <td class="text-end fw-bold text-danger fs-5">{{ $order->formatted_total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Thông tin giao hàng -->
        <div class="card mb-3">
            <div class="card-header bg-white fw-bold"><i class="bi bi-person me-2"></i>Thông tin khách hàng</div>
            <div class="card-body">
                <p class="mb-1"><strong>Tên:</strong> {{ $order->customer_name }}</p>
                <p class="mb-1"><strong>SĐT:</strong> {{ $order->phone }}</p>
                <p class="mb-1"><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                @if($order->note)
                <p class="mb-1"><strong>Ghi chú:</strong> {{ $order->note }}</p>
                @endif
                <p class="mb-0 text-muted small">Email: {{ $order->user->email ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Cập nhật trạng thái -->
        <div class="card">
            <div class="card-header bg-white fw-bold"><i class="bi bi-arrow-repeat me-2"></i>Cập nhật trạng thái</div>
            <div class="card-body">
                <div class="mb-3 text-center">
                    <span class="badge bg-{{ $order->status_color }} fs-6 px-3 py-2">{{ $order->status_label }}</span>
                    <div class="text-muted small mt-1">{{ $order->created_at->format('H:i d/m/Y') }}</div>
                </div>

                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <select class="form-select" name="status">
                            @foreach(\App\Models\Order::$statuses as $key => $label)
                            <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-circle me-2"></i>Cập nhật
                    </button>
                </form>

                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                    <i class="bi bi-arrow-left me-1"></i>Quay lại
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
