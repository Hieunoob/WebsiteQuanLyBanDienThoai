@extends('layouts.app')

@section('title', 'Đặt hàng thành công — PhoneShop')

@section('content')
<div style="min-height:calc(100vh - 56px);display:flex;align-items:center;justify-content:center;background:var(--light-ash);padding:40px 16px;">
    <div style="text-align:center;max-width:480px;width:100%;">
        {{-- Icon --}}
        <div style="width:72px;height:72px;border-radius:50%;background:var(--white);border:1px solid var(--cloud);display:flex;align-items:center;justify-content:center;margin:0 auto 28px;font-size:28px;color:#2d7a3a;">
            <i class="bi bi-check-lg"></i>
        </div>

        <div style="font-size:11px;font-weight:500;color:var(--pewter);letter-spacing:2px;text-transform:uppercase;margin-bottom:12px;">Hoàn tất</div>
        <div style="font-size:28px;font-weight:500;color:var(--carbon);margin-bottom:12px;">Đặt hàng thành công</div>
        <div style="font-size:14px;color:var(--pewter);line-height:1.7;margin-bottom:36px;">
            Cảm ơn bạn đã đặt hàng tại <strong style="color:var(--carbon);">PhoneShop</strong>.<br>
            Chúng tôi sẽ liên hệ xác nhận và giao hàng sớm nhất có thể.
        </div>

        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('orders.history') }}" class="btn-secondary-tesla">Xem đơn hàng</a>
            <a href="{{ route('home') }}" class="btn-primary-tesla">Về trang chủ</a>
        </div>
    </div>
</div>
@endsection
