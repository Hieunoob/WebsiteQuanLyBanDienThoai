@extends('layouts.app')

@section('title', $product->name . ' — PhoneShop')

@push('styles')
<style>
    .breadcrumb-tesla { display:flex; gap:8px; align-items:center; font-size:12px; color:var(--pewter); margin-bottom:32px; flex-wrap:wrap; }
    .breadcrumb-tesla a { color:var(--pewter); text-decoration:none; transition:color 0.33s; }
    .breadcrumb-tesla a:hover { color:var(--carbon); }
    .breadcrumb-sep { color:var(--pale-silver); }

    .product-img-stage {
        background: var(--light-ash);
        border-radius: 4px;
        display: flex; align-items: center; justify-content: center;
        aspect-ratio: 4/3; overflow: hidden;
    }
    .product-img-stage img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.33s;
    }
    .product-img-stage:hover img { transform: scale(1.03); }

    .spec-table { width: 100%; border-collapse: collapse; }
    .spec-table tr { border-bottom: 1px solid var(--cloud); }
    .spec-table tr:last-child { border-bottom: none; }
    .spec-table td { padding: 12px 0; font-size: 14px; vertical-align: top; }
    .spec-table td:first-child { color: var(--pewter); width: 40%; padding-right: 16px; }
    .spec-table td:last-child { color: var(--carbon); font-weight: 500; }

    .qty-stepper {
        display: inline-flex; align-items: center;
        border: 1px solid var(--pale-silver); border-radius: 4px; overflow: hidden;
    }
    .qty-stepper button {
        width: 40px; height: 40px; background: var(--light-ash);
        border: none; cursor: pointer; font-size: 16px; color: var(--carbon);
        transition: background-color 0.33s; display: flex; align-items: center; justify-content: center;
    }
    .qty-stepper button:hover { background: var(--cloud); }
    .qty-stepper input {
        width: 56px; height: 40px; border: none;
        border-left: 1px solid var(--pale-silver); border-right: 1px solid var(--pale-silver);
        text-align: center; font-size: 14px; font-weight: 500;
        color: var(--carbon); font-family: inherit; background: var(--white);
    }
    .qty-stepper input:focus { outline: none; }

    .perk-item { display:flex; align-items:center; gap:10px; padding:10px 0; border-bottom:1px solid var(--cloud); font-size:13px; color:var(--graphite); }
    .perk-item:last-child { border-bottom:none; }
    .perk-icon { color:var(--blue); font-size:14px; width:18px; flex-shrink:0; }
</style>
@endpush

@section('content')
<div class="container py-5" style="max-width:1200px;">

    {{-- Breadcrumb --}}
    <div class="breadcrumb-tesla">
        <a href="{{ route('home') }}">Trang chủ</a>
        <span class="breadcrumb-sep">/</span>
        <a href="{{ route('products.index') }}">Điện thoại</a>
        <span class="breadcrumb-sep">/</span>
        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
        <span class="breadcrumb-sep">/</span>
        <span style="color:var(--carbon);">{{ Str::limit($product->name, 40) }}</span>
    </div>

    <div class="row g-5">
        {{-- Image --}}
        <div class="col-lg-5">
            <div class="product-img-stage">
                <img src="{{ $product->image ?: 'https://picsum.photos/seed/'.urlencode($product->slug).'/600/480' }}"
                     alt="{{ $product->name }}"
                     onerror="this.src='https://picsum.photos/seed/phone/600/480'">
            </div>
        </div>

        {{-- Info --}}
        <div class="col-lg-7">
            {{-- Brand + Category --}}
            <div style="font-size:11px;font-weight:500;color:var(--pewter);letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">
                {{ $product->brand }} · {{ $product->category->name }}
            </div>

            {{-- Name --}}
            <h1 style="font-size:28px;font-weight:500;color:var(--carbon);line-height:1.25;margin-bottom:16px;">
                {{ $product->name }}
            </h1>

            {{-- Price --}}
            <div style="font-size:32px;font-weight:500;color:var(--carbon);margin-bottom:12px;">
                {{ $product->formatted_price }}
            </div>

            {{-- Stock --}}
            @if($product->quantity > 0)
                <div style="font-size:13px;color:#2d7a3a;margin-bottom:24px;display:flex;align-items:center;gap:6px;">
                    <span style="width:6px;height:6px;border-radius:50%;background:#2d7a3a;display:inline-block;"></span>
                    Còn {{ $product->quantity }} sản phẩm
                </div>
            @else
                <div style="font-size:13px;color:#c0392b;margin-bottom:24px;display:flex;align-items:center;gap:6px;">
                    <span style="width:6px;height:6px;border-radius:50%;background:#c0392b;display:inline-block;"></span>
                    Hết hàng
                </div>
            @endif

            {{-- Description --}}
            @if($product->description)
            <p style="font-size:14px;color:var(--graphite);line-height:1.7;margin-bottom:28px;max-width:480px;">
                {{ Str::limit($product->description, 200) }}
            </p>
            @endif

            {{-- Add to cart --}}
            @if($product->quantity > 0)
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:28px;flex-wrap:wrap;">
                    <div class="qty-stepper">
                        <button type="button" onclick="adjQty(-1)">−</button>
                        <input type="number" name="quantity" id="qtyIn" value="1" min="1" max="{{ $product->quantity }}">
                        <button type="button" onclick="adjQty(1)">+</button>
                    </div>
                    <button type="submit" class="btn-primary-tesla" style="min-width:200px;">
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </form>
            @else
            <div style="padding:14px 20px;border:1px solid var(--cloud);border-radius:4px;font-size:14px;color:var(--pewter);margin-bottom:28px;">
                Sản phẩm tạm thời hết hàng
            </div>
            @endif

            {{-- Perks --}}
            <div style="border:1px solid var(--cloud);border-radius:4px;padding:0 16px;">
                <div class="perk-item">
                    <i class="bi bi-truck perk-icon"></i>
                    <span>Miễn phí vận chuyển toàn quốc cho đơn từ 3 triệu</span>
                </div>
                <div class="perk-item">
                    <i class="bi bi-shield-check perk-icon"></i>
                    <span>Bảo hành chính hãng 12 tháng</span>
                </div>
                <div class="perk-item">
                    <i class="bi bi-arrow-repeat perk-icon"></i>
                    <span>Đổi trả trong 30 ngày nếu có lỗi nhà sản xuất</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Details + Specs --}}
    <div class="row g-4 mt-3" style="border-top:1px solid var(--cloud);padding-top:48px;">
        <div class="col-lg-6">
            <div style="font-size:11px;font-weight:500;color:var(--pewter);letter-spacing:2px;text-transform:uppercase;margin-bottom:16px;">Mô tả</div>
            <div style="font-size:14px;color:var(--graphite);line-height:1.8;">
                {!! nl2br(e($product->description ?? 'Chưa có mô tả chi tiết.')) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div style="font-size:11px;font-weight:500;color:var(--pewter);letter-spacing:2px;text-transform:uppercase;margin-bottom:16px;">Thông số kỹ thuật</div>
            <table class="spec-table">
                @if($product->screen)
                <tr><td>Màn hình</td><td>{{ $product->screen }}</td></tr>
                @endif
                @if($product->ram)
                <tr><td>RAM</td><td>{{ $product->ram }}</td></tr>
                @endif
                @if($product->storage)
                <tr><td>Bộ nhớ trong</td><td>{{ $product->storage }}</td></tr>
                @endif
                @if($product->camera)
                <tr><td>Camera</td><td>{{ $product->camera }}</td></tr>
                @endif
                @if($product->battery)
                <tr><td>Pin</td><td>{{ $product->battery }}</td></tr>
                @endif
                @if($product->operating_system)
                <tr><td>Hệ điều hành</td><td>{{ $product->operating_system }}</td></tr>
                @endif
            </table>
        </div>
    </div>

    {{-- Related --}}
    @if($related->count() > 0)
    <div style="border-top:1px solid var(--cloud);margin-top:64px;padding-top:48px;">
        <div style="font-size:11px;font-weight:500;color:var(--pewter);letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">Cùng danh mục</div>
        <div style="font-size:24px;font-weight:500;color:var(--carbon);margin-bottom:24px;">Sản phẩm liên quan</div>
        <div class="row g-3">
            @foreach($related as $rp)
            <div class="col-6 col-md-4 col-lg-3">
                @include('partials.product-card', ['product' => $rp])
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

@push('scripts')
<script>
function adjQty(d) {
    const i = document.getElementById('qtyIn');
    i.value = Math.max(1, Math.min({{ $product->quantity }}, +i.value + d));
}
</script>
@endpush
@endsection
