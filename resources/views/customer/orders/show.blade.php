@extends('customer.layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Chi tiết đơn hàng #{{ $order->id }}</h1>

<p class="mb-2"><strong>Trạng thái:</strong> {{ $order->status }}</p>
<p class="mb-2"><strong>Tổng tiền:</strong> {{ number_format($order->total_price) }}₫</p>
<p class="mb-6"><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

<h2 class="text-xl font-semibold mb-3">Sản phẩm</h2>
<table class="min-w-full bg-white shadow rounded">
    <thead class="bg-gray-100">
        <tr>
            <th class="py-2 px-4">Tên sản phẩm</th>
            <th class="py-2 px-4">Giá</th>
            <th class="py-2 px-4">Số lượng</th>
            <th class="py-2 px-4">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
            <tr class="border-b">
                <td class="py-2 px-4">{{ $item->product->name }}</td>
                <td class="py-2 px-4">{{ number_format($item->price) }}₫</td>
                <td class="py-2 px-4">{{ $item->quantity }}</td>
                <td class="py-2 px-4">{{ number_format($item->price * $item->quantity) }}₫</td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('orders.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Quay lại</a>
@endsection