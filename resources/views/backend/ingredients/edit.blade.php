@extends('backend.master')
@section('title','Folafol BD - Edit Ingredient')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Edit Ingredient</h4>
        <p class="text-muted">Update ingredient information</p>
    </div>
    <div>
        <a href="{{ route('admin.ingredients.index') }}" class="btn btn-secondary btn-icon-text">
            <i class="btn-icon-prepend" data-feather="arrow-left"></i>
            Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Ingredient Information</h6>

                <form action="{{ route('admin.ingredients.update', $ingredient->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Ingredient Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $ingredient->name) }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Ingredient Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            <small class="text-muted">Recommended size: 300x200 pixels</small>
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($ingredient->image)
                            <div class="mt-2" id="current-image">
                                <label class="form-label">Current Image:</label>
                                <div>
                                    <img src="{{ asset('storage/'.$ingredient->image) }}" alt="{{ $ingredient->name }}" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $ingredient->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="current_stock" class="form-label">Current Stock <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('current_stock') is-invalid @enderror" id="current_stock" name="current_stock" value="{{ old('current_stock', $ingredient->current_stock) }}" step="0.01" min="0" required>
                            @error('current_stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                            <select class="form-select @error('unit') is-invalid @enderror" id="unit" name="unit" required>
                                <option value="" disabled>Select unit</option>
                                <option value="g" {{ old('unit', $ingredient->unit) == 'g' ? 'selected' : '' }}>Grams (g)</option>
                                <option value="kg" {{ old('unit', $ingredient->unit) == 'kg' ? 'selected' : '' }}>Kilograms (kg)</option>
                                <option value="ml" {{ old('unit', $ingredient->unit) == 'ml' ? 'selected' : '' }}>Milliliters (ml)</option>
                                <option value="l" {{ old('unit', $ingredient->unit) == 'l' ? 'selected' : '' }}>Liters (l)</option>
                            </select>
                            @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="minimum_stock" class="form-label">Minimum Stock Level <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('minimum_stock') is-invalid @enderror" id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock', $ingredient->minimum_stock) }}" step="0.01" min="0" required>
                            <small class="text-muted">Alert will show when stock is below this level</small>
                            @error('minimum_stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success me-2">Update Ingredient</button>
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

        // Preview image when selected
        $('#image').on('change', function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                // Hide current image and show new preview
                $('#current-image').hide();

                if (!$('#preview-container').length) {
                    $('<div id="preview-container" class="mt-2"><label class="form-label">New Image:</label><div><img id="preview-image" class="img-thumbnail" style="max-height: 150px;"></div></div>').insertAfter('#image');
                }

                $('#preview-image').attr('src', e.target.result);
                $('#preview-container').show();
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

</script>
@endpush
