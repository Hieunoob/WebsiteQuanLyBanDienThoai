@extends('layouts.app')

@section('title', 'Đặt hàng — PhoneShop')

@push('styles')
<style>
    .checkout-input {
        width:100%; border:1px solid var(--pale-silver); border-radius:4px;
        padding:10px 14px; font-size:14px; color:var(--carbon); font-family:inherit;
        background:var(--white); outline:none; transition:border-color 0.33s;
    }
    .checkout-input::placeholder { color:var(--silver-fog); }
    .checkout-input:focus { border-color:var(--blue); }
    .checkout-input.is-invalid { border-color:#c0392b; }
    .checkout-label { font-size:13px; font-weight:500; color:var(--carbon); margin-bottom:6px; display:block; }
    .checkout-error { font-size:12px; color:#c0392b; margin-top:4px; }
    .order-item { display:flex; align-items:center; gap:14px; padding:16px 0; border-bottom:1px solid var(--cloud); }
    .order-item:last-child { border-bottom:none; }
    .order-item img { width:56px; height:56px; object-fit:cover; border-radius:4px; background:var(--light-ash); flex-shrink:0; }
</style>
@endpush

@section('content')
<div class="container py-5" style="max-width:1100px;">

    <div style="font-size:11px;font-weight:500;color:var(--pewter);letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">Thanh toán</div>
    <div style="font-size:28px;font-weight:500;color:var(--carbon);margin-bottom:40px;">Thông tin đặt hàng</div>

    <div class="row g-4">
        {{-- Form --}}
        <div class="col-lg-7">
            <div style="border:1px solid var(--cloud);border-radius:4px;overflow:hidden;">
                <div style="padding:14px 20px;border-bottom:1px solid var(--cloud);font-size:11px;font-weight:500;color:var(--pewter);letter-spacing:2px;text-transform:uppercase;">
                    Thông tin nhận hàng
                </div>
                <div style="padding:24px;">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf

                        <div style="margin-bottom:16px;">
                            <label class="checkout-label">Họ và tên</label>
                            <input class="checkout-input {{ $errors->has('customer_name') ? 'is-invalid' : '' }}"
                                   type="text" name="customer_name"
                                   value="{{ old('customer_name', auth()->user()->name) }}" required>
                            @error('customer_name')<div class="checkout-error">{{ $message }}</div>@enderror
                        </div>

                        <div style="margin-bottom:16px;">
                            <label class="checkout-label">Số điện thoại</label>
                            <input class="checkout-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                   type="text" name="phone" value="{{ old('phone') }}"
                                   placeholder="0912345678" required>
                            @error('phone')<div class="checkout-error">{{ $message }}</div>@enderror
                        </div>

                        <div style="margin-bottom:16px;">
                            <label class="checkout-label">Địa chỉ giao hàng</label>
                            <textarea class="checkout-input {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                      name="address" rows="3"
                                      placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố" required
                                      style="resize:vertical;height:auto;">{{ old('address') }}</textarea>
                            @error('address')<div class="checkout-error">{{ $message }}</div>@enderror
                        </div>

                        <div style="margin-bottom:28px;">
                            <label class="checkout-label">Ghi chú <span style="color:var(--pewter);font-weight:400;">(tùy chọn)</span></label>
                            <textarea class="checkout-input" name="note" rows="2"
                                      placeholder="Yêu cầu đặc biệt, giờ giao hàng..."
                                      style="resize:vertical;height:auto;">{{ old('note') }}</textarea>
                        </div>

                        <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
                            <a href="{{ route('cart.index') }}" class="btn-ghost-tesla">← Quay lại giỏ hàng</a>
                            <button type="submit" class="btn-primary-tesla" style="min-width:180px;min-height:44px;">
                                Xác nhận đặt hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="col-lg-5">
            <div style="border:1px solid var(--cloud);border-radius:4px;overflow:hidden;position:sticky;top:72px;">
                <div style="padding:14px 20px;border-bottom:1px solid var(--cloud);font-size:11px;font-weight:500;color:var(--pewter);letter-spacing:2px;text-transform:uppercase;">
                    Đơn hàng của bạn
                </div>
                <div style="padding:0 20px;">
                    @foreach($cart as $id => $item)
                    <div class="order-item">
                        <img src="{{ $item['product']['image'] ?: 'https://picsum.photos/seed/'.urlencode($item['product']['name']).'/60/60' }}"
                             onerror="this.src='https://picsum.photos/seed/phone/60/60'">
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:14px;font-weight:500;color:var(--carbon);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                {{ $item['product']['name'] }}
                            </div>
                            <div style="font-size:12px;color:var(--pewter);">x{{ $item['quantity'] }}</div>
                        </div>
                        <div style="font-size:14px;font-weight:500;color:var(--carbon);flex-shrink:0;">
                            {{ number_format($item['product']['price'] * $item['quantity'], 0, ',', '.') }}₫
                        </div>
                    </div>
                    @endforeach
                </div>
                <div style="padding:16px 20px;border-top:1px solid var(--cloud);">
                    <div style="display:flex;justify-content:space-between;font-size:13px;color:var(--pewter);margin-bottom:8px;">
                        <span>Tạm tính</span><span>{{ number_format($total, 0, ',', '.') }}₫</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:13px;color:var(--pewter);margin-bottom:16px;">
                        <span>Phí vận chuyển</span><span style="color:#2d7a3a;">Miễn phí</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:17px;font-weight:500;color:var(--carbon);padding-top:12px;border-top:1px solid var(--cloud);">
                        <span>Tổng cộng</span><span>{{ number_format($total, 0, ',', '.') }}₫</span>
                    </div>
                    <div style="margin-top:14px;padding:10px 12px;background:var(--light-ash);border-radius:4px;font-size:12px;color:var(--pewter);">
                        Hình thức thanh toán: <strong style="color:var(--carbon);">COD — Thanh toán khi nhận hàng</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
