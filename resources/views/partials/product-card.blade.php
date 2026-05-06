<div class="product-card-tesla">
    <div class="product-img-area">
        <img src="{{ $product->image ?: 'https://picsum.photos/seed/'.urlencode($product->slug).'/400/320' }}"
             alt="{{ $product->name }}"
             loading="lazy"
             onerror="this.src='https://picsum.photos/seed/phone/400/320'">
    </div>
    <div class="product-body-tesla">
        <div class="product-brand">{{ $product->brand }}</div>
        <div class="product-title">{{ $product->name }}</div>
        <div class="product-price">{{ $product->formatted_price }}</div>
        @if($product->quantity > 0)
            <div class="product-stock-in">Còn hàng</div>
        @else
            <div class="product-stock-out">Hết hàng</div>
        @endif
        <div class="product-actions-tesla">
            <a href="{{ route('products.show', $product->slug) }}" class="btn-secondary-tesla">Chi tiết</a>
            @if($product->quantity > 0)
            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="flex:1;">
                @csrf
                <button type="submit" class="btn-primary-tesla w-100">Thêm vào giỏ</button>
            </form>
            @else
            <button class="btn-secondary-tesla" disabled style="flex:1;opacity:0.4;cursor:not-allowed;">Hết hàng</button>
            @endif
        </div>
    </div>
</div>
