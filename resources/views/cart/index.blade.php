@extends('layouts.app')

@section('title', 'Giỏ hàng — PhoneShop')

@push('styles')
<style>
    .cart-table { width:100%; border-collapse:collapse; }
    .cart-table th {
        font-size:11px; font-weight:500; color:var(--pewter);
        letter-spacing:1.5px; text-transform:uppercase;
        padding:0 0 12px; border-bottom:1px solid var(--cloud);
    }
    .cart-table td { padding:20px 0; border-bottom:1px solid var(--cloud); vertical-align:middle; }
    .cart-table tr:last-child td { border-bottom:none; }
    .cart-img {
        width:72px; height:72px; object-fit:cover;
        border-radius:4px; background:var(--light-ash);
        flex-shrink:0;
    }
    .cart-product-name { font-size:14px; font-weight:500; color:var(--carbon); }
    .cart-product-brand { font-size:12px; color:var(--pewter); margin-top:2px; }
    .cart-price { font-size:14px; font-weight:500; color:var(--carbon); }
    .cart-subtotal { font-size:14px; font-weight:500; color:var(--carbon); }
    .cart-stepper {
        display:inline-flex; align-items:center;
        border:1px solid var(--pale-silver); border-radius:4px; overflow:hidden;
    }
    .cart-stepper button {
        width:32px; height:32px; background:var(--light-ash);
        border:none; cursor:pointer; font-size:14px; color:var(--carbon);
        transition:background-color 0.33s;
    }
    .cart-stepper button:hover { background:var(--cloud); }
    .cart-stepper input {
        width:44px; height:32px; border:none;
        border-left:1px solid var(--pale-silver); border-right:1px solid var(--pale-silver);
        text-align:center; font-size:13px; font-weight:500;
        color:var(--carbon); font-family:inherit;
    }
    .cart-stepper input:focus { outline:none; }
    .cart-remove-btn {
        background:none; border:none; color:var(--silver-fog);
        cursor:pointer; font-size:16px; padding:4px;
        transition:color 0.33s;
    }
    .cart-remove-btn:hover { color:var(--carbon); }
    .summary-box {
        border:1px solid var(--cloud); border-radius:4px;
        position:sticky; top:72px; overflow:hidden;
    }
    .summary-box-head {
        padding:14px 20px; border-bottom:1px solid var(--cloud);
        font-size:11px; font-weight:500; color:var(--pewter);
        letter-spacing:2px; text-transform:uppercase;
    }
    .summary-box-body { padding:20px; }
    .summary-line {
        display:flex; justify-content:space-between;
        font-size:14px; color:var(--graphite); margin-bottom:12px;
    }
    .summary-total {
        display:flex; justify-content:space-between;
        font-size:17px; font-weight:500; color:var(--carbon);
        padding-top:16px; margin-top:4px;
        border-top:1px solid var(--cloud);
        margin-bottom:20px;
    }
</style>
@endpush

@section('content')
<div class="container py-5" style="max-width:1200px;">

    <div style="font-size:11px;font-weight:500;color:var(--pewter);letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">Mua sắm</div>
    <div style="font-size:28px;font-weight:500;color:var(--carbon);margin-bottom:40px;">
        Giỏ hàng
        @if(!empty($cart))
        <span style="font-size:16px;font-weight:400;color:var(--pewter);margin-left:8px;">{{ count($cart) }} sản phẩm</span>
        @endif
    </div>

    @if(empty($cart))
    <div style="text-align:center;padding:80px 0;border:1px solid var(--cloud);border-radius:4px;">
        <div style="font-size:40px;color:var(--pale-silver);margin-bottom:16px;"><i class="bi bi-bag"></i></div>
        <div style="font-size:17px;font-weight:500;color:var(--carbon);margin-bottom:8px;">Giỏ hàng trống</div>
        <div style="font-size:14px;color:var(--pewter);margin-bottom:28px;">Thêm sản phẩm để bắt đầu mua sắm</div>
        <a href="{{ route('products.index') }}" class="btn-primary-tesla">Xem điện thoại</a>
    </div>
    @else
    <div class="row g-4">
        {{-- Items --}}
        <div class="col-lg-8">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th style="width:50%;">Sản phẩm</th>
                        <th class="text-center" style="width:18%;">Đơn giá</th>
                        <th class="text-center" style="width:20%;">Số lượng</th>
                        <th class="text-end" style="width:10%;">Thành tiền</th>
                        <th style="width:2%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                    <tr>
                        <td>
                            <div style="display:flex;gap:16px;align-items:center;">
                                <img class="cart-img"
                                     src="{{ $item['product']['image'] ?: 'https://picsum.photos/seed/'.urlencode($item['product']['name']).'/80/80' }}"
                                     onerror="this.src='https://picsum.photos/seed/phone/80/80'">
                                <div>
                                    <div class="cart-product-name">{{ $item['product']['name'] }}</div>
                                    <div class="cart-product-brand">{{ $item['product']['brand'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center cart-price">
                            {{ number_format($item['product']['price'], 0, ',', '.') }}₫
                        </td>
                        <td class="text-center">
                            <form action="{{ route('cart.update', $id) }}" method="POST" id="qty-form-{{ $id }}">
                                @csrf
                                <div class="cart-stepper">
                                    <button type="button" onclick="cQty('{{ $id }}',-1)">−</button>
                                    <input type="number" name="quantity" id="qty-{{ $id }}"
                                           value="{{ $item['quantity'] }}" min="1"
                                           onchange="document.getElementById('qty-form-{{ $id }}').submit()">
                                    <button type="button" onclick="cQty('{{ $id }}',1)">+</button>
                                </div>
                            </form>
                        </td>
                        <td class="text-end cart-subtotal">
                            {{ number_format($item['product']['price'] * $item['quantity'], 0, ',', '.') }}₫
                        </td>
                        <td class="text-end">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="cart-remove-btn" title="Xóa">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top:24px;">
                <a href="{{ route('products.index') }}" class="btn-ghost-tesla">
                    ← Tiếp tục mua sắm
                </a>
            </div>
        </div>

        {{-- Summary --}}
        <div class="col-lg-4">
            <div class="summary-box">
                <div class="summary-box-head">Tóm tắt</div>
                <div class="summary-box-body">
                    <div class="summary-line">
                        <span>Tạm tính ({{ count($cart) }} SP)</span>
                        <span>{{ number_format($total, 0, ',', '.') }}₫</span>
                    </div>
                    <div class="summary-line">
                        <span>Phí vận chuyển</span>
                        <span style="color:#2d7a3a;">Miễn phí</span>
                    </div>
                    <div class="summary-total">
                        <span>Tổng cộng</span>
                        <span>{{ number_format($total, 0, ',', '.') }}₫</span>
                    </div>

                    @auth
                        <a href="{{ route('checkout') }}" class="btn-primary-tesla w-100">Đặt hàng ngay</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary-tesla w-100">Đăng nhập để đặt hàng</a>
                        <div style="text-align:center;margin-top:12px;font-size:13px;color:var(--pewter);">
                            Chưa có tài khoản?
                            <a href="{{ route('register') }}" style="color:var(--blue);text-decoration:none;">Đăng ký</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function cQty(id, d) {
    const i = document.getElementById('qty-' + id);
    i.value = Math.max(1, +i.value + d);
    document.getElementById('qty-form-' + id).submit();
}
</script>
@endpush
@endsection
