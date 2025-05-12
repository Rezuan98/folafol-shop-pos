<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'current_stock',
        'unit',
        'minimum_stock',
        'image'
    ];

    /**
     * Get stock adjustment records for this ingredient
     */
    public function stockAdjustments()
    {
        return $this->hasMany(StockAdjustment::class);
    }

    /**
     * Check if ingredient is low on stock
     */
    public function isLowStock()
    {
        return $this->current_stock <= $this->minimum_stock;
    }

    /**
     * Get stock status label
     */
    public function getStockStatusAttribute()
    {
        if ($this->current_stock <= $this->minimum_stock * 0.5) {
            return 'Low Stock';
        } elseif ($this->current_stock <= $this->minimum_stock) {
            return 'Running Low';
        } else {
            return 'Sufficient';
        }
    }

    /**
     * Get stock status class
     */
    public function getStockStatusClassAttribute()
    {
        if ($this->current_stock <= $this->minimum_stock * 0.5) {
            return 'danger';
        } elseif ($this->current_stock <= $this->minimum_stock) {
            return 'warning';
        } else {
            return 'success';
        }
    }

    /**
     * Format the stock amount with unit
     */
    public function getFormattedStockAttribute()
    {
        // For kg, convert to kg if >= 1000g
        if ($this->unit == 'g' && $this->current_stock >= 1000) {
            return ($this->current_stock / 1000) . 'kg';
        }
        
        return $this->current_stock . $this->unit;
    }
}