@extends('backend.master')
@section('title','Folafol BD - Ingredient Stock History')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Stock History</h4>
        <p class="text-muted">Stock adjustment history for {{ $ingredient->name }}</p>
    </div>
    <div>
        <a href="{{ route('admin.ingredients.show-adjust-stock', $ingredient->id) }}" class="btn btn-success btn-icon-text me-2">
            <i class="btn-icon-prepend" data-feather="edit-2"></i>
            Adjust Stock
        </a>
        <a href="{{ route('admin.ingredients.index') }}" class="btn btn-secondary btn-icon-text">
            <i class="btn-icon-prepend" data-feather="arrow-left"></i>
            Back to Ingredients
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Ingredient Information</h6>

                <div class="d-flex flex-column align-items-center mb-4">
                    @if($ingredient->image)
                    <img src="{{ asset('storage/'.$ingredient->image) }}" alt="{{ $ingredient->name }}" class="img-fluid rounded mb-3" style="max-height: 150px;">
                    @else
                    <img src="https://via.placeholder.com/200x150?text={{ urlencode($ingredient->name) }}" alt="{{ $ingredient->name }}" class="img-fluid rounded mb-3">
                    @endif
                    <h5 class="text-center">{{ $ingredient->name }}</h5>
                </div>

                <table class="table">
                    <tr>
                        <th>Current Stock:</th>
                        <td>
                            <span class="fs-5">{{ $ingredient->formatted_stock }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Minimum Level:</th>
                        <td>{{ $ingredient->minimum_stock }}{{ $ingredient->unit }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <span class="badge bg-{{ $ingredient->stock_status_class }}">{{ $ingredient->stock_status }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td>{{ $ingredient->updated_at->format('M d, Y g:i A') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Stock Adjustment History</h6>

                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($adjustments as $adjustment)
                            <tr>
                                <td>{{ $adjustment->created_at->format('M d, Y g:i A') }}</td>
                                <td>
                                    @if($adjustment->type == 'in')
                                    <span class="badge bg-success">Stock In</span>
                                    @elseif($adjustment->type == 'out')
                                    <span class="badge bg-primary">Stock Out</span>
                                    @elseif($adjustment->type == 'wastage')
                                    <span class="badge bg-danger">Wastage</span>
                                    @else
                                    <span class="badge bg-info">Adjustment</span>
                                    @endif
                                </td>
                                <td>
                                    @if($adjustment->quantity > 0)
                                    <span class="text-success">+{{ $adjustment->quantity }}{{ $ingredient->unit }}</span>
                                    @else
                                    <span class="text-danger">{{ $adjustment->quantity }}{{ $ingredient->unit }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $adjustment->notes ?: 'No notes provided' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No stock adjustment history found</td>
                            </tr>
                            @endforelse
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
