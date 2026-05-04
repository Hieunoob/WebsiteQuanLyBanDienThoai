<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Giỏ hàng được lưu trong session dưới dạng:
    // cart = [ product_id => ['product' => [...], 'quantity' => n] ]

    // Hiển thị giỏ hàng
    public function index()
    {
        $cart  = session('cart', []);
        $total = $this->calculateTotal($cart);

        return view('cart.index', compact('cart', 'total'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request, int $productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->quantity <= 0) {
            return back()->with('error', 'Sản phẩm này đã hết hàng.');
        }

        $cart     = session('cart', []);
        $quantity = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$productId])) {
            // Kiểm tra không vượt quá tồn kho
            $newQty = $cart[$productId]['quantity'] + $quantity;
            $cart[$productId]['quantity'] = min($newQty, $product->quantity);
        } else {
            $cart[$productId] = [
                'product'  => $product->toArray(),
                'quantity' => min($quantity, $product->quantity),
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', "Đã thêm \"{$product->name}\" vào giỏ hàng!");
    }

    // Cập nhật số lượng sản phẩm trong giỏ
    public function update(Request $request, int $productId)
    {
        $cart     = session('cart', []);
        $quantity = (int) $request->input('quantity', 1);

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } elseif (isset($cart[$productId])) {
            $product  = Product::find($productId);
            $maxStock = $product ? $product->quantity : 99;
            $cart[$productId]['quantity'] = min($quantity, $maxStock);
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng.');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove(int $productId)
    {
        $cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    // Tính tổng tiền giỏ hàng
    private function calculateTotal(array $cart): float
    {
        return collect($cart)->sum(function ($item) {
            return $item['product']['price'] * $item['quantity'];
        });
    }
}
