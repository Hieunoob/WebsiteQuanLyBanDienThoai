<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Danh sách các cột cho phép lưu dữ liệu từ Form
    protected $fillable = [
        'category_id', 
        'name', 
        'slug', 
        'price', 
        'stock', 
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}