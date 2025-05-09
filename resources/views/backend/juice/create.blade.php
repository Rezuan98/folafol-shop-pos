@extends('backend.master')
@section('title','Folafol BD - Add New Juice')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Add New Juice</h4>
        <p class="text-muted">Create a new juice item for your shop</p>
    </div>
    <div>
        <a href="{{ route('admin.juices.index') }}" class="btn btn-secondary btn-icon-text">
            <i class="btn-icon-prepend" data-feather="arrow-left"></i>
            Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Juice Information</h6>

                <form action="{{ route('admin.juices.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Juice Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Juice Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            <small class="text-muted">Recommended size: 300x200 pixels</small>
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="price_small" class="form-label">Small Size Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('price_small') is-invalid @enderror" id="price_small" name="price_small" value="{{ old('price_small') }}" step="0.01" min="0" required>
                            @error('price_small')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="price_medium" class="form-label">Medium Size Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('price_medium') is-invalid @enderror" id="price_medium" name="price_medium" value="{{ old('price_medium') }}" step="0.01" min="0" required>
                            @error('price_medium')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="price_large" class="form-label">Large Size Price (৳) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('price_large') is-invalid @enderror" id="price_large" name="price_large" value="{{ old('price_large') }}" step="0.01" min="0" required>
                            @error('price_large')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_available" name="is_available" {{ old('is_available', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_available">
                                Available for Sale
                            </label>
                        </div>

                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success me-2">Save Juice</button>
                        <a href="{{ route('admin.juices.index') }}" class="btn btn-secondary">Cancel</a>
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
                $('#preview-image').attr('src', e.target.result);
                $('#preview-container').show();
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

</script>
@endpush
