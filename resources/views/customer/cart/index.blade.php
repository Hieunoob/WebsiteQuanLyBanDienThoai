@extends('customer.layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Giỏ hàng</h1>

@if($cart->items->isEmpty())
    <p class="text-gray-600">Giỏ hàng trống</p>
@else
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">Sản phẩm</th>
                <th class="p-3">Số lượng</th>
                <th class="p-3">Giá</th>
                <th class="p-3">Tổng</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->items as $item)
            <tr class="border-b">
                <td class="p-3">{{ $item->product->name }}</td>
                <td class="p-3">{{ $item->quantity }}</td>
                <td class="p-3">{{ number_format($item->product->price) }}₫</td>
                <td class="p-3">{{ number_format($item->product->price * $item->quantity) }}₫</td>
                <td class="p-3">
                    <a href="{{ route('cart.remove', $item->product->id) }}" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 text-right">
        <p class="text-xl font-bold">Tổng tiền: {{ number_format($cart->totalPrice()) }}₫</p>
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button type="submit" class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Thanh toán</button>
        </form>
    </div>
@endif
@endsection