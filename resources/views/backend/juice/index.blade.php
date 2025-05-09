@extends('backend.master')
@section('title','Folafol BD - Juice Management')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Juice Management</h4>
        <p class="text-muted">Manage all juice items available in your shop</p>
    </div>
    <div>
        <a href="{{ route('admin.juices.create') }}" class="btn btn-success btn-icon-text">
            <i class="btn-icon-prepend" data-feather="plus-circle"></i>
            Add New Juice
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">All Juices</h6>

                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Small Price</th>
                                <th>Medium Price</th>
                                <th>Large Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($juices as $key => $juice)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($juice->image)
                                    <img src="{{ asset('storage/'.$juice->image) }}" alt="{{ $juice->name }}" width="50">
                                    @else
                                    <img src="https://via.placeholder.com/50x50?text=No+Image" alt="No Image">
                                    @endif
                                </td>
                                <td>{{ $juice->name }}</td>
                                <td>৳{{ $juice->price_small }}</td>
                                <td>৳{{ $juice->price_medium }}</td>
                                <td>৳{{ $juice->price_large }}</td>
                                <td>
                                    @if($juice->is_available)
                                    <span class="badge bg-success">Available</span>
                                    @else
                                    <span class="badge bg-danger">Not Available</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.juices.edit', $juice->id) }}" class="btn btn-sm btn-primary">
                                        <i data-feather="edit" class="icon-sm"></i>
                                    </a>
                                    <form action="{{ route('admin.juices.destroy', $juice->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this juice?')">
                                            <i data-feather="trash-2" class="icon-sm"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($juices) == 0)
                            <tr>
                                <td colspan="8" class="text-center">No juices found</td>
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
