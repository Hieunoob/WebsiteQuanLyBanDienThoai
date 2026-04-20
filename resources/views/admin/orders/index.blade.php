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
</div>
@endsection
