<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Ingredient;

class LowStockAlertComponent extends Component
{
    public $lowStockIngredients;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->lowStockIngredients = Ingredient::whereRaw('current_stock <= minimum_stock')
            ->orderByRaw('current_stock / minimum_stock ASC')
            ->take(5)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.low-stock-alert-component');
    }
}