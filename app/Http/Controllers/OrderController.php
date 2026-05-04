<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Hiển thị form checkout
    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total = collect($cart)->sum(fn($item) => $item['product']['price'] * $item['quantity']);

        return view('orders.checkout', compact('cart', 'total'));
    }

    // Xử lý đặt hàng
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string|max:500',
            'note'          => 'nullable|string|max:1000',
        ], [
            'customer_name.required' => 'Vui lòng nhập họ tên.',
            'phone.required'         => 'Vui lòng nhập số điện thoại.',
            'address.required'       => 'Vui lòng nhập địa chỉ nhận hàng.',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống, không thể đặt hàng.');
        }

        $total = collect($cart)->sum(fn($item) => $item['product']['price'] * $item['quantity']);

        // Dùng transaction để đảm bảo toàn vẹn dữ liệu
        DB::transaction(function () use ($request, $cart, $total) {
            $order = Order::create([
                'user_id'       => auth()->id(),
                'customer_name' => $request->customer_name,
                'phone'         => $request->phone,
                'address'       => $request->address,
                'note'          => $request->note,
                'total_price'   => $total,
                'status'        => 'pending',
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['product']['price'],
                ]);

                // Trừ tồn kho
                Product::where('id', $productId)->decrement('quantity', $item['quantity']);
            }
        });

        // Xóa giỏ hàng sau khi đặt hàng thành công
        session()->forget('cart');

        return redirect()->route('orders.success')->with('success', 'Đặt hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.');
    }

    // Trang đặt hàng thành công
    public function success()
    {
        return view('orders.success');
    }

    // Lịch sử đơn hàng của user đang đăng nhập
    public function history()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.history', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function show(int $id)
    {
        $order = Order::where('user_id', auth()->id())
            ->with('orderItems.product')
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}
