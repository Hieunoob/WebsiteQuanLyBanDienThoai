<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Http\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    // Các trường có thể gán hàng loạt
   protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    // ----------------- Relations -----------------

    /**
     * Một order có nhiều order items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Một order thuộc về 1 user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}