<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total', 'status'];

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_PREPARING = 'preparing';
    public const STATUS_DELIVERING = 'delivering';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELED = 'canceled';

    public static $statusTranslations = [
        self::STATUS_PENDING => 'Ожидает подтверждения',
        self::STATUS_CONFIRMED => 'Подтверждён',
        self::STATUS_PREPARING => 'Готовится',
        self::STATUS_DELIVERING => 'В доставке',
        self::STATUS_COMPLETED => 'Завершён',
        self::STATUS_CANCELED => 'Отменён',
    ];

    public function getStatusInRussianAttribute()
    {
        return self::$statusTranslations[$this->status] ?? 'Неизвестный статус';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}