<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'juice_id',
        'juice_name',
        'size',
        'price',
        'quantity',
        'total',
    ];

    /**
     * Get the order that owns the item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the juice that the item refers to.
     */
    public function juice()
    {
        return $this->belongsTo(Juice::class);
    }
}