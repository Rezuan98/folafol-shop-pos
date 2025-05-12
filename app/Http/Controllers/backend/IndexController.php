<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

use App\Models\Ingredient;
use App\Models\Order;
use App\Models\StockAdjustment;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
$lowStockCount = Ingredient::whereRaw('current_stock <= minimum_stock')->count();
        
        // Get recent orders
        $recentOrders = Order::with('items')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Get low stock ingredients
        $lowStockIngredients = Ingredient::whereRaw('current_stock <= minimum_stock')
            ->orderByRaw('current_stock / minimum_stock ASC')
            ->take(3)
            ->get();
      
        return view('backend.index',compact('lowStockCount', 'recentOrders', 'lowStockIngredients'));
    }

   


}

