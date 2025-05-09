<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'order_name',
        'subtotal',
        'discount',
        'total',
        'payment_method',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderName()
    {
        // Get the last order to check its order name
        $lastOrder = self::orderBy('id', 'desc')->first();
        
        if (!$lastOrder || !$lastOrder->order_name) {
            // If no orders exist yet or no order_name, start with 1
            $nextNumber = 1;
        } else {
            // Extract the number part from the last order name
            if (preg_match('/^folafol-(\d+)$/', $lastOrder->order_name, $matches)) {
                $lastNumber = (int) $matches[1];
                // Increment and check if we need to reset to 1
                $nextNumber = ($lastNumber >= 100) ? 1 : $lastNumber + 1;
            } else {
                // If the last order name doesn't follow our pattern, start with 1
                $nextNumber = 1;
            }
        }
        
        // Format and return the new order name
        return 'folafol-' . $nextNumber;
    }
}