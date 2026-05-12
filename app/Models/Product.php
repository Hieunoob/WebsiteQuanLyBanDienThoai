<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'slug',
        'price',
        'quantity',
        'description',
        'image',
        'screen',
        'ram',
        'storage',
        'camera',
        'battery',
        'operating_system',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:0',
        'is_featured' => 'boolean',
    ];

    // Tự động tạo slug khi set name
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value) . '-' . time();
        }
    }

    // Format giá tiền VNĐ
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', '.') . ' ₫';
    }

    // Quan hệ: sản phẩm thuộc một danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ: sản phẩm có nhiều order_items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scope lọc sản phẩm nổi bật
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
