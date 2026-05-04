<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'phone',
        'address',
        'note',
        'total_price',
        'status',
    ];

    // Nhãn hiển thị cho từng trạng thái
    public static array $statuses = [
        'pending'    => 'Chờ xử lý',
        'processing' => 'Đang giao',
        'completed'  => 'Hoàn thành',
        'cancelled'  => 'Đã hủy',
    ];

    // Badge màu Bootstrap cho từng trạng thái
    public static array $statusColors = [
        'pending'    => 'warning',
        'processing' => 'info',
        'completed'  => 'success',
        'cancelled'  => 'danger',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::$statuses[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return self::$statusColors[$this->status] ?? 'secondary';
    }

    // Quan hệ: đơn hàng thuộc một user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: đơn hàng có nhiều order_items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return number_format($this->total_price, 0, ',', '.') . ' ₫';
    }
}
