@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Lịch sử đơn hàng</h1>

@if($orders->isEmpty())
    <p class="text-gray-600">Bạn chưa có đơn hàng nào.</p>
@else
    <table class="min-w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4">Mã đơn</th>
                <th class="py-2 px-4">Tổng tiền</th>
                <th class="py-2 px-4">Trạng thái</th>
                <th class="py-2 px-4">Ngày tạo</th>
                <th class="py-2 px-4">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr class="border-b">
                    <td class="py-2 px-4">#{{ $order->id }}</td>
                    <td class="py-2 px-4">{{ number_format($order->total_price) }}₫</td>
                    <td class="py-2 px-4">{{ $order->status }}</td>
                    <td class="py-2 px-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('orders.show', $order->id) }}" class="text-blue-500 hover:underline">Xem chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection