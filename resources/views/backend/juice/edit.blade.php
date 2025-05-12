@extends('backend.master')
@section('title','Folafol BD - Edit Juice')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Edit Juice</h4>
        <p class="text-muted">Update juice information</p>
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
                <h6 class="card-title">Edit Juice Information</h6>

                <form action="{{ route('admin.juices.update', $juice->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Juice Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $juice->name) }}" required>
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

                            @if($juice->image)
                            <div class="mt-2" id="current-image">
                                <label class="form-label">Current Image:</label>
                                <div>
                                    <img src="{{ asset('storage/'.$juice->image) }}" alt="{{ $juice->name }}" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $juice->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="price_small" class="form-label">Small Size Price (৳)</label>
                            <input type="number" class="form-control" id="price_small" name="price_small" value="{{ old('price_small', $juice->price_small) }}" step="0.01" min="0">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="price_medium" class="form-label">Medium Size Price (৳)</label>
                            <input type="number" class="form-control" id="price_medium" name="price_medium" value="{{ old('price_medium', $juice->price_medium) }}" step="0.01" min="0">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="price_large" class="form-label">Large Size Price (৳)</label>
                            <input type="number" class="form-control" id="price_large" name="price_large" value="{{ old('price_large', $juice->price_large) }}" step="0.01" min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_available" name="is_available" {{ old('is_available', $juice->is_available) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_available">
                                Available for Sale
                            </label>
                        </div>

                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success me-2">Update Juice</button>
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
                // Hide current image and show new preview
                $('#current-image').hide();

                if (!$('#preview-container').length) {
                    $('<div id="preview-container" class="mt-2"><label class="form-label">New Image:</label><div><img id="preview-image" class="img-thumbnail" style="max-height: 100px;"></div></div>').insertAfter('#image');
                }

                $('#preview-image').attr('src', e.target.result);
                $('#preview-container').show();
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

</script>
@endpush
