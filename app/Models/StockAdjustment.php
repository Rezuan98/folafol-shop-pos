<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'quantity',
        'type',
        'notes'
    ];

    /**
     * Get the ingredient that owns the stock adjustment
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}