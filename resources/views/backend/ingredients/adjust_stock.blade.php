@extends('backend.master')
@section('title','Folafol BD - Adjust Ingredient Stock')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Adjust Stock</h4>
        <p class="text-muted">Adjust stock level for {{ $ingredient->name }}</p>
    </div>
    <div>
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
                <h6 class="card-title">Current Stock Information</h6>

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

                <div class="mt-3">
                    <a href="{{ route('admin.ingredients.stock-history', $ingredient->id) }}" class="btn btn-outline-primary btn-block">
                        <i data-feather="clock" class="icon-sm me-1"></i> View Stock History
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Adjust Stock</h6>

                <form action="{{ route('admin.ingredients.adjust-stock', $ingredient->id) }}" method="POST" class="mt-4">
                    @csrf

                    <div class="mb-3">
                        <label for="type" class="form-label">Adjustment Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="" disabled selected>Select adjustment type</option>
                            <option value="in">Stock In (Add Stock)</option>
                            <option value="out">Stock Out (Remove Stock)</option>
                            <option value="wastage">Wastage</option>
                            <option value="adjustment">Inventory Adjustment</option>
                        </select>
                        @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" step="0.01" min="0.01" required>
                            <span class="input-group-text">{{ $ingredient->unit }}</span>
                        </div>
                        <small class="text-muted">Enter the quantity to add or remove</small>
                        @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        <small class="text-muted">Optional: Add some notes about this adjustment</small>
                        @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="mb-3" id="stockPreview">
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i data-feather="info" class="icon-sm me-2"></i>
                                <span>
                                    Select an adjustment type and enter a quantity to see the preview
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success me-2">Save Adjustment</button>
                        <a href="{{ route('admin.ingredients.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
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

        // Current stock value
        const currentStock = {
            {
                $ingredient - > current_stock
            }
        };
        const unit = '{{ $ingredient->unit }}';

        // Stock preview functionality
        function updateStockPreview() {
            const type = $('#type').val();
            const quantity = parseFloat($('#quantity').val()) || 0;

            if (!type || quantity <= 0) {
                $('#stockPreview').html(`
                    <div class="alert alert-info">
                        <div class="d-flex align-items-center">
                            <i data-feather="info" class="icon-sm me-2"></i>
                            <span>
                                Select an adjustment type and enter a quantity to see the preview
                            </span>
                        </div>
                    </div>
                `);
                feather.replace();
                return;
            }

            let newStock = currentStock;
            let alertClass = 'alert-info';
            let icon = 'info';
            let message = '';

            if (type === 'in' || type === 'adjustment') {
                newStock = currentStock + quantity;
                message = `Adding ${quantity}${unit} will increase the stock from ${currentStock}${unit} to ${newStock}${unit}`;
                alertClass = 'alert-success';
                icon = 'plus-circle';
            } else if (type === 'out' || type === 'wastage') {
                newStock = Math.max(0, currentStock - quantity);

                if (currentStock < quantity) {
                    message = `Warning: You are trying to remove ${quantity}${unit} but only ${currentStock}${unit} is available. Stock will be set to 0${unit}.`;
                    alertClass = 'alert-warning';
                    icon = 'alert-triangle';
                } else {
                    message = `Removing ${quantity}${unit} will decrease the stock from ${currentStock}${unit} to ${newStock}${unit}`;
                    alertClass = 'alert-primary';
                    icon = 'minus-circle';
                }
            }

            $('#stockPreview').html(`
                <div class="alert ${alertClass}">
                    <div class="d-flex align-items-center">
                        <i data-feather="${icon}" class="icon-sm me-2"></i>
                        <span>${message}</span>
                    </div>
                </div>
            `);

            feather.replace();
        }

        // Update preview when inputs change
        $('#type, #quantity').on('change keyup', updateStockPreview);
    });

</script>
@endpush
