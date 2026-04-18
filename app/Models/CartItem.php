<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    // Các trường có thể gán hàng loạt
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    // ----------------- Relations -----------------

    /**
     * CartItem thuộc về 1 Cart
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * CartItem thuộc về 1 Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}