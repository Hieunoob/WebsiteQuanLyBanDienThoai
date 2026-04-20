<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Http\Models\Order;
use App\Http\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::id())->with('items.product')->firstOrFail();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $total = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending',
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        $cart->items()->delete();

        return redirect()->route('orders.index')->with('success', 'Thanh toán thành công! Tổng: ' . number_format($order->total_price) . '₫');
    }

    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get();
        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Chỉ cho user sở hữu xem
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        $order->load('items.product');
        return view('customer.orders.show', compact('order'));
    }
}