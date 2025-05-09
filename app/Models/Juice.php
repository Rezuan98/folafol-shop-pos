<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price_small',
        'price_medium',
        'price_large',
        'is_available'
    ];
}