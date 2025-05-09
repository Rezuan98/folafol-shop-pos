@extends('backend.master')
@section('title','Folafol BD - Orders History')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Orders History</h4>
        <p class="text-muted">View all completed orders</p>
    </div>
    <div>
        <a href="{{ route('admin.pos.index') }}" class="btn btn-primary btn-icon-text">
            <i class="btn-icon-prepend" data-feather="arrow-left"></i>
            Back to POS
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">All Orders</h6>

                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Order Name</th>

                                <th>Date & Time</th>
                                <th>Items</th>
                                <th>Subtotal</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->order_name }}</td>
                                <td>{{ $order->created_at->format('M d, Y g:i A') }}</td>
                                <td>
                                    {{ $order->items->count() }}
                                    {{ Str::plural('item', $order->items->count()) }}
                                </td>
                                <td>৳{{ number_format($order->subtotal, 2) }}</td>
                                <td>৳{{ number_format($order->discount, 2) }}</td>
                                <td>৳{{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $order->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.pos.order-details', $order->id) }}" class="btn btn-sm btn-info">
                                        <i data-feather="eye" class="icon-sm"></i>
                                    </a>
                                    <button class="btn btn-sm btn-secondary print-receipt" data-id="{{ $order->id }}">
                                        <i data-feather="printer" class="icon-sm"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No orders found</td>
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

        // Print receipt button handler
        $('.print-receipt').on('click', function() {
            const orderId = $(this).data('id');
            // Redirect to details page and print
            window.open("{{ url('admin/pos/orders') }}/" + orderId + "?print=true", '_blank');
        });
    });

</script>
@endpush
