<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Các trường có thể gán hàng loạt
    protected $fillable = ['user_id'];

    // ----------------- Relations -----------------

    /**
     * Cart thuộc về 1 User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Cart có nhiều CartItem
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // ----------------- Helpers -----------------

    /**
     * Tổng tiền của giỏ
     */
    public function totalPrice()
    {
        // Load product nếu chưa được load để tránh lỗi null
        $this->loadMissing('items.product');

        return $this->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
}