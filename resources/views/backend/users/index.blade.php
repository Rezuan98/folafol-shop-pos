@extends('backend.master')
@section('title','Folafol BD - User Management')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">User Management</h4>
        <p class="text-muted">Manage users and their access to the system</p>
    </div>
    <div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-icon-text">
            <i class="btn-icon-prepend" data-feather="user-plus"></i>
            Add New User
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">All Users</h6>

                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($user->profile_photo)
                                    <img src="{{ asset('storage/'.$user->profile_photo) }}" alt="{{ $user->name }}" class="rounded-circle" width="40" height="40">
                                    @else
                                    <img src="https://via.placeholder.com/40x40?text=User" alt="{{ $user->name }}" class="rounded-circle">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : 'info' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->is_active)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                        <i data-feather="edit" class="icon-sm"></i>
                                    </a>
                                    @if(auth()->id() != $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i data-feather="trash-2" class="icon-sm"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                            @if(count($users) == 0)
                            <tr>
                                <td colspan="8" class="text-center">No users found</td>
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
