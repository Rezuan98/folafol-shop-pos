@extends('backend.master')
@section('title','Folafol BD - Order Details')

@push('styles')
<style>
    .print-only {
        display: none;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        .print-only {
            display: block !important;
        }

        .print-container {
            width: 300px;
            margin: 0 auto;
        }
    }

</style>
@endpush

@section('dashboard_content')
<div class="row no-print">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Order Details</h4>
                <p class="text-muted">Order #{{ $order->order_number }}</p>
            </div>
            <div>
                <button class="btn btn-secondary btn-icon-text me-2" id="printBtn">
                    <i class="btn-icon-prepend" data-feather="printer"></i>
                    Print Receipt
                </button>
                <a href="{{ route('admin.pos.orders') }}" class="btn btn-primary btn-icon-text">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                    Back to Orders
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Receipt for printing -->
<div class="print-only print-container">
    <div class="text-center mb-3">
        <h3>Folafol BD</h3>
        <p class="mb-0">Fresh Juice Shop</p>
        <p class="mb-0">123 Juice Street, Dhaka</p>
        <p class="mb-0">Phone: 01712-345678</p>
        <p>Receipt Copy</p>
        <h5>Order #{{ $order->order_number }}</h5>
        <p><small>Date: {{ $order->created_at->format('M d, Y g:i A') }}</small></p>
    </div>

    <table class="table table-sm">
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->juice_name }} ({{ ucfirst($item->size) }})</td>
                <td>{{ $item->quantity }} x ৳{{ number_format($item->price, 2) }}</td>
                <td class="text-end">৳{{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-end">Subtotal:</td>
                <td class="text-end">৳{{ number_format($order->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-end">Discount:</td>
                <td class="text-end">৳{{ number_format($order->discount, 2) }}</td>
            </tr>
            <tr class="fw-bold">
                <td colspan="2" class="text-end">Total:</td>
                <td class="text-end">৳{{ number_format($order->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="border-top pt-2 mt-2 text-center">
        <p>Thank you for your purchase!</p>
        <p class="mb-0"><small>Visit us again</small></p>
    </div>
</div>

<div class="row no-print">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Order Items</h6>

                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->juice_name }}</td>
                                <td>{{ ucfirst($item->size) }}</td>
                                <td>৳{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>৳{{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end fw-bold">Subtotal:</td>
                                <td>৳{{ number_format($order->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-end fw-bold">Discount:</td>
                                <td>৳{{ number_format($order->discount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-end fw-bold">Total:</td>
                                <td class="fw-bold">৳{{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Order Summary</h6>

                <div class="mt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Order Number:</span>
                        <span class="fw-bold">{{ $order->order_number }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Date & Time:</span>
                        <span>{{ $order->created_at->format('M d, Y g:i A') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Status:</span>
                        <span class="badge bg-success">{{ $order->status }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Payment Method:</span>
                        <span>{{ $order->payment_method }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Items:</span>
                        <span>{{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal:</span>
                        <span>৳{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Discount:</span>
                        <span>৳{{ number_format($order->discount, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 fs-5 fw-bold">
                        <span>Total:</span>
                        <span>৳{{ number_format($order->total, 2) }}</span>
                    </div>
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

        // Print button handler
        $('#printBtn').on('click', function() {
            window.print();
        });

        // Auto-print if requested via URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('print') === 'true') {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    });

</script>
@endpush
