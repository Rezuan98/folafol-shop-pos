<div class="card">
    <div class="card-body">
        <h6 class="card-title">Low Stock Ingredients</h6>

        @if($lowStockIngredients->count() > 0)
        <div class="mt-4">
            @foreach($lowStockIngredients as $ingredient)
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <i data-feather="alert-circle" class="text-{{ $ingredient->stock_status_class }} icon-sm me-2"></i>
                    <h6 class="mb-0">{{ $ingredient->name }}</h6>
                </div>
                <span class="badge bg-{{ $ingredient->stock_status_class }}">{{ $ingredient->formatted_stock }} left</span>
            </div>
            <div class="progress progress-sm mb-3">
                <div class="progress-bar bg-{{ $ingredient->stock_status_class }}" role="progressbar" style="width: {{ min(100, ($ingredient->current_stock / $ingredient->minimum_stock) * 100) }}%" aria-valuenow="{{ min(100, ($ingredient->current_stock / $ingredient->minimum_stock) * 100) }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            @endforeach

            <div class="d-grid mt-4">
                <a href="{{ route('admin.ingredients.low-stock') }}" class="btn btn-primary">Manage Low Stock</a>
            </div>
        </div>
        @else
        <div class="text-center py-4">
            <i data-feather="check-circle" style="width: 48px; height: 48px; color: #4caf50;"></i>
            <p class="mt-2">All ingredients are in sufficient stock</p>
        </div>
        @endif
    </div>
</div>
