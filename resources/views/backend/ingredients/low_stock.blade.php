@extends('backend.master')
@section('title','Folafol BD - Low Stock Ingredients')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Low Stock Ingredients</h4>
        <p class="text-muted">Ingredients that need to be restocked</p>
    </div>
    <div>
        <a href="{{ route('admin.ingredients.index') }}" class="btn btn-secondary btn-icon-text">
            <i class="btn-icon-prepend" data-feather="arrow-left"></i>
            Back to All Ingredients
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Low Stock Alert</h6>
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
                                    <a href="{{ route('admin.ingredients.show-adjust-stock', $ingredient->id) }}" class="btn btn-sm btn-success" title="Add Stock">
                                        <i data-feather="plus-circle" class="icon-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.ingredients.edit', $ingredient->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i data-feather="edit" class="icon-sm"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($ingredients) == 0)
                            <tr>
                                <td colspan="7" class="text-center">No low stock ingredients found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if(count($ingredients) > 0)
                <div class="mt-4">
                    <div class="alert alert-warning" role="alert">
                        <i data-feather="alert-circle" class="icon-sm me-2"></i>
                        Please restock these ingredients as soon as possible to ensure smooth operations.
                    </div>
                </div>
                @endif
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
