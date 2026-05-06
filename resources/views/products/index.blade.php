@extends('layouts.app')

@section('title', 'Điện thoại — PhoneShop')

@push('styles')
<style>
    .filter-panel {
        border: 1px solid var(--cloud);
        border-radius: 4px;
        background: var(--white);
        position: sticky; top: 72px;
        overflow: hidden;
    }
    .filter-panel-head {
        padding: 14px 18px;
        border-bottom: 1px solid var(--cloud);
        font-size: 11px; font-weight: 500;
        color: var(--pewter); letter-spacing: 2px; text-transform: uppercase;
    }
    .filter-panel-body { padding: 18px; }
    .filter-group { margin-bottom: 20px; }
    .filter-group:last-child { margin-bottom: 0; }
    .filter-group-label {
        font-size: 11px; font-weight: 500; color: var(--pewter);
        letter-spacing: 1.5px; text-transform: uppercase;
        margin-bottom: 10px;
    }
    .filter-radio-item {
        display: flex; align-items: center; gap: 10px;
        padding: 6px 8px; border-radius: 4px; cursor: pointer;
        transition: background-color 0.33s; font-size: 14px;
        color: var(--graphite); user-select: none; margin-bottom: 2px;
    }
    .filter-radio-item:hover { background: var(--light-ash); color: var(--carbon); }
    .filter-radio-item.active { background: var(--light-ash); color: var(--carbon); font-weight: 500; }
    .filter-radio-item input { display: none; }
    .filter-radio-dot {
        width: 14px; height: 14px; border-radius: 50%;
        border: 1.5px solid var(--pale-silver);
        flex-shrink: 0; transition: border-color 0.33s;
        display: flex; align-items: center; justify-content: center;
    }
    .filter-radio-item.active .filter-radio-dot {
        border-color: var(--blue);
    }
    .filter-radio-item.active .filter-radio-dot::after {
        content: ''; width: 6px; height: 6px;
        border-radius: 50%; background: var(--blue);
    }
    .filter-count {
        margin-left: auto; font-size: 11px;
        color: var(--silver-fog);
    }
    .sort-option {
        display: flex; align-items: center; gap: 10px;
        padding: 6px 8px; border-radius: 4px; cursor: pointer;
        transition: background-color 0.33s; font-size: 14px;
        color: var(--graphite); user-select: none; margin-bottom: 2px;
    }
    .sort-option:hover { background: var(--light-ash); color: var(--carbon); }
    .sort-option.active { background: var(--light-ash); color: var(--carbon); font-weight: 500; }
    .sort-option input { display: none; }
    .page-bar {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 12px;
        padding-bottom: 16px; margin-bottom: 20px;
        border-bottom: 1px solid var(--cloud);
    }
    .page-bar-title { font-size: 17px; font-weight: 500; color: var(--carbon); }
    .page-bar-count { font-size: 13px; color: var(--pewter); }
    .active-tag {
        display: inline-flex; align-items: center; gap: 6px;
        border: 1px solid var(--pale-silver); border-radius: 4px;
        padding: 3px 10px; font-size: 12px; color: var(--graphite);
        background: var(--white);
    }
    .active-tag a { color: var(--silver-fog); text-decoration: none; transition: color 0.33s; }
    .active-tag a:hover { color: var(--carbon); }
</style>
@endpush

@section('content')
<div class="container py-5" style="max-width:1200px;">
    <div class="row g-4">

        {{-- ── FILTER SIDEBAR ── --}}
        <div class="col-lg-3">
            <div class="filter-panel">
                <div class="filter-panel-head">Bộ lọc</div>
                <div class="filter-panel-body">
                    <form action="{{ route('products.index') }}" method="GET" id="filterForm">

                        {{-- Search --}}
                        <div class="filter-group">
                            <div class="filter-group-label">Tìm kiếm</div>
                            <div style="position:relative;">
                                <input type="text" name="search" value="{{ request('search') }}"
                                       placeholder="Tên, thương hiệu..."
                                       style="width:100%;border:1px solid var(--pale-silver);border-radius:4px;padding:7px 12px;font-size:13px;color:var(--carbon);font-family:inherit;background:var(--white);outline:none;transition:border-color 0.33s;"
                                       onfocus="this.style.borderColor='var(--blue)'"
                                       onblur="this.style.borderColor='var(--pale-silver)'">
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="filter-group">
                            <div class="filter-group-label">Danh mục</div>
                            <label class="filter-radio-item {{ !request('category') ? 'active' : '' }}">
                                <input type="radio" name="category" value=""
                                       {{ !request('category') ? 'checked' : '' }}
                                       onchange="document.getElementById('filterForm').submit()">
                                <span class="filter-radio-dot"></span>
                                Tất cả
                            </label>
                            @foreach($categories as $cat)
                            <label class="filter-radio-item {{ request('category') === $cat->slug ? 'active' : '' }}">
                                <input type="radio" name="category" value="{{ $cat->slug }}"
                                       {{ request('category') === $cat->slug ? 'checked' : '' }}
                                       onchange="document.getElementById('filterForm').submit()">
                                <span class="filter-radio-dot"></span>
                                {{ $cat->name }}
                                <span class="filter-count">{{ $cat->products_count }}</span>
                            </label>
                            @endforeach
                        </div>

                        {{-- Sort --}}
                        <div class="filter-group">
                            <div class="filter-group-label">Sắp xếp</div>
                            @foreach(['newest' => 'Mới nhất', 'price_asc' => 'Giá tăng dần', 'price_desc' => 'Giá giảm dần'] as $val => $label)
                            <label class="sort-option {{ $sort === $val ? 'active' : '' }}">
                                <input type="radio" name="sort" value="{{ $val }}"
                                       {{ $sort === $val ? 'checked' : '' }}
                                       onchange="document.getElementById('filterForm').submit()">
                                {{ $label }}
                            </label>
                            @endforeach
                        </div>

                        <button type="submit" class="btn-primary-tesla w-100" style="font-size:13px;min-height:36px;">Áp dụng</button>
                        @if(request('search') || request('category'))
                        <a href="{{ route('products.index') }}" class="btn-secondary-tesla w-100 mt-2" style="font-size:13px;min-height:36px;">Xóa bộ lọc</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        {{-- ── PRODUCT GRID ── --}}
        <div class="col-lg-9">
            <div class="page-bar">
                <div>
                    <div class="page-bar-title">
                        @if(request('category'))
                            {{ $categories->where('slug', request('category'))->first()?->name ?? 'Danh mục' }}
                        @elseif(request('search'))
                            Kết quả: "{{ request('search') }}"
                        @else
                            Tất cả điện thoại
                        @endif
                    </div>
                    <div class="page-bar-count">{{ $products->total() }} sản phẩm</div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    @if(request('search'))
                    <span class="active-tag">
                        "{{ request('search') }}"
                        <a href="{{ route('products.index', array_merge(request()->except('search','page'), [])) }}">×</a>
                    </span>
                    @endif
                    @if(request('category'))
                    <span class="active-tag">
                        {{ $categories->where('slug', request('category'))->first()?->name }}
                        <a href="{{ route('products.index', array_merge(request()->except('category','page'), [])) }}">×</a>
                    </span>
                    @endif
                </div>
            </div>

            @if($products->count() > 0)
                <div class="row g-3">
                    @foreach($products as $product)
                    <div class="col-6 col-xl-4">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->appends(request()->except('page'))->links() }}
                </div>
            @else
                <div style="text-align:center;padding:80px 0;border:1px solid var(--cloud);border-radius:4px;">
                    <div style="font-size:40px;margin-bottom:16px;color:var(--pale-silver);">
                        <i class="bi bi-search"></i>
                    </div>
                    <div style="font-size:17px;font-weight:500;color:var(--carbon);margin-bottom:8px;">Không tìm thấy sản phẩm</div>
                    <div style="font-size:14px;color:var(--pewter);margin-bottom:24px;">Thử điều chỉnh bộ lọc hoặc tìm kiếm khác</div>
                    <a href="{{ route('products.index') }}" class="btn-primary-tesla">Xem tất cả sản phẩm</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
