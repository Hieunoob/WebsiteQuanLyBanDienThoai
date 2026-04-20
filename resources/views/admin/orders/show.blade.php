@extends('admin.dashboard')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="mt-4">Chi tiết đơn hàng #{{ $order->id }}</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-4">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Thông tin đơn hàng -->
        <div class="col-lg-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white">
                    <i class="bi bi-info-circle me-1"></i> Thông tin đơn hàng
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Mã đơn hàng</p>
                            <p class="fw-bold">#{{ $order->id }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Ngày tạo</p>
                            <p class="fw-bold">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Khách hàng</p>
                            <p class="fw-bold">{{ $order->user->name ?? 'N/A' }}</p>
                            <p class="small text-muted">{{ $order->user->email ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Trạng thái</p>
                            <p>
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
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danh sách sản phẩm trong đơn hàng -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white">
                    <i class="bi bi-bag me-1"></i> Các sản phẩm
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <strong>{{ $item->product->name ?? 'N/A' }}</strong>
                                        </td>
                                        <td>{{ number_format($item->price) }}₫</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="text-success fw-bold">{{ number_format($item->price * $item->quantity) }}₫</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tóm tắt -->
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white">
                    <i class="bi bi-receipt me-1"></i> Tóm tắt đơn hàng
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tổng cộng:</span>
                        <strong class="text-success">{{ number_format($order->total_price) }}₫</strong>
                    </div>
                    <hr>

                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="status" class="form-label">Cập nhật trạng thái</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" @selected($order->status === 'pending')>Chờ xử lý</option>
                                <option value="processing" @selected($order->status === 'processing')>Đang xử lý</option>
                                <option value="completed" @selected($order->status === 'completed')>Hoàn thành</option>
                                <option value="cancelled" @selected($order->status === 'cancelled')>Hủy</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check"></i> Cập nhật
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
