<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Hiển thị giỏ hàng của user hiện tại
     */
    public function index()
    {
        // Lấy giỏ hàng, nếu chưa có thì tạo mới
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // Eager load sản phẩm để tránh N+1
        $items = $cart->items()->with('product')->get();

        return view('customer.cart.index', compact('cart', 'items'));
    }

    /**
     * Thêm sản phẩm vào giỏ hàng
     */
    public function add(Request $request, $productId)
{
    $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

    $quantity = $request->input('quantity', 1);

    $cartItem = $cart->items()->where('product_id', $productId)->first();

    if ($cartItem) {
        $cartItem->increment('quantity', $quantity);
    } else {
        $cart->items()->create([
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ hàng!');
}

    /**
     * Xóa sản phẩm khỏi giỏ hàng
     */
    public function remove($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }
}