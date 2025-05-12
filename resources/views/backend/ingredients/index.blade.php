@extends('backend.master')
@section('title','Folafol BD - Ingredient Management')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Ingredient Management</h4>
        <p class="text-muted">Manage all ingredients available in your shop</p>
    </div>
    <div>
        <a href="{{ route('admin.ingredients.low-stock') }}" class="btn btn-warning btn-icon-text me-2">
            <i class="btn-icon-prepend" data-feather="alert-triangle"></i>
            Low Stock
        </a>
        <a href="{{ route('admin.ingredients.create') }}" class="btn btn-success btn-icon-text">
            <i class="btn-icon-prepend" data-feather="plus-circle"></i>
            Add New Ingredient
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">All Ingredients</h6>

                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Current Stock</th>
                                <th>Minimum Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ingredients as $key => $ingredient)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($ingredient->image)
                                    <img src="{{ asset('storage/'.$ingredient->image) }}" alt="{{ $ingredient->name }}" width="50">
                                    @else
                                    <img src="https://via.placeholder.com/50x50?text=No+Image" alt="No Image">
                                    @endif
                                </td>
                                <td>{{ $ingredient->name }}</td>
                                <td>{{ $ingredient->formatted_stock }}</td>
                                <td>{{ $ingredient->minimum_stock }}{{ $ingredient->unit }}</td>
                                <td>
                                    <span class="badge bg-{{ $ingredient->stock_status_class }}">{{ $ingredient->stock_status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.ingredients.show-adjust-stock', $ingredient->id) }}" class="btn btn-sm btn-info" title="Adjust Stock">
                                        <i data-feather="package" class="icon-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.ingredients.stock-history', $ingredient->id) }}" class="btn btn-sm btn-secondary" title="Stock History">
                                        <i data-feather="clock" class="icon-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.ingredients.edit', $ingredient->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i data-feather="edit" class="icon-sm"></i>
                                    </a>
                                    <form action="{{ route('admin.ingredients.destroy', $ingredient->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this ingredient?')" title="Delete">
                                            <i data-feather="trash-2" class="icon-sm"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($ingredients) == 0)
                            <tr>
                                <td colspan="7" class="text-center">No ingredients found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        // Initialize Feather icons
        feather.replace();
    });

</script>
@endpush
