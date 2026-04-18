<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'image', 'stock'];

    // 🛒 Cart
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // 🔥 Order Items (QUAN TRỌNG)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}