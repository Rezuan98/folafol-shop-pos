@extends('backend.master')
@section('title','Folafol BD - POS System')

@push('styles')
<style>
    .juice-item {
        cursor: pointer;
        transition: all 0.3s;
    }

    .juice-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .juice-item.selected {
        border: 2px solid #4caf50;
        background-color: rgba(76, 175, 80, 0.1);
    }

    .juice-img {
        height: 100px;
        object-fit: cover;
    }

    .cart-item {
        border-bottom: 1px solid #eee;
        padding: 10px 0;
    }

    .cart-container {
        max-height: 400px;
        overflow-y: auto;
    }

    .size-btn {
        cursor: pointer;
    }

    .size-btn.active {
        background-color: #4caf50;
        color: white;
    }

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

    /* Receipt preview modal styles */
    #receiptPreviewModal .modal-dialog {
        max-width: 350px;
    }

    .receipt-container {
        font-family: 'Courier New', monospace;
        font-size: 12px;
        width: 300px;
        margin: 0 auto;
    }

    .receipt-header {
        text-align: center;
        margin-bottom: 10px;
    }

    .receipt-table {
        width: 100%;
        border-collapse: collapse;
    }

    .receipt-table th,
    .receipt-table td {
        padding: 3px;
        text-align: left;
    }

    .receipt-footer {
        text-align: center;
        margin-top: 10px;
        font-size: 11px;
    }

    .tab-content {
        padding-top: 15px;
    }

    .size-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #f8f9fa;
        color: #6c757d;
    }

</style>
@endpush

@section('dashboard_content')
<div class="row">
    <!-- Left Side: Juice Selection -->
    <div class="col-md-7 no-print">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Select Juice Items</h5>
                    <div class="input-group" style="max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Search juices..." id="searchJuice">
                        <button class="btn btn-outline-secondary" type="button">
                            <i data-feather="search"></i>
                        </button>
                    </div>
                </div>

                <!-- Juice Items Grid -->
                <div class="row" id="juiceItemsContainer">
                    @foreach($juices as $juice)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="card juice-item" data-id="{{ $juice->id }}" data-name="{{ $juice->name }}" data-price-small="{{ $juice->price_small }}" data-price-medium="{{ $juice->price_medium }}" data-price-large="{{ $juice->price_large }}">
                            @if($juice->image)
                            <img src="{{ asset('storage/'.$juice->image) }}" class="card-img-top juice-img" alt="{{ $juice->name }}">
                            @else
                            <img src="https://via.placeholder.com/300x200.png?text={{ urlencode($juice->name) }}" class="card-img-top juice-img" alt="{{ $juice->name }}">
                            @endif
                            <div class="card-body p-2 text-center">
                                <h6 class="card-title mb-1">{{ $juice->name }}</h6>
                                <p class="card-text text-muted mb-0">৳{{ $juice->price_small }} - ৳{{ $juice->price_large }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @if(count($juices) == 0)
                    <div class="col-12 text-center py-5">
                        <i data-feather="coffee" style="width: 48px; height: 48px; opacity: 0.3;"></i>
                        <p class="mt-2 text-muted">No juice items available</p>
                        <a href="{{ route('admin.juices.create') }}" class="btn btn-primary mt-2">Add New Juice</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Order Cart -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3 no-print">Current Order</h5>

                <!-- Cart Items -->
                <div class="cart-container mb-4" id="cartItems">
                    <!-- Empty cart message -->
                    <div id="emptyCart" class="text-center py-4">
                        <i data-feather="shopping-cart" style="width: 40px; height: 40px; opacity: 0.3;"></i>
                        <p class="mt-2 text-muted">Your cart is empty</p>
                    </div>

                    <!-- Cart items will be added dynamically here -->
                </div>

                <!-- Size Selection Modal -->
                <div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="sizeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="sizeModalLabel">Select Size</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6 id="selectedJuiceName" class="mb-3">Juice Name</h6>
                                <input type="hidden" id="selectedJuiceId">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card size-btn" data-size="small">
                                            <div class="card-body text-center py-2">
                                                <h6>Small</h6>
                                                <p class="mb-0" id="priceSmall">৳0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card size-btn" data-size="medium">
                                            <div class="card-body text-center py-2">
                                                <h6>Medium</h6>
                                                <p class="mb-0" id="priceMedium">৳0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card size-btn" data-size="large">
                                            <div class="card-body text-center py-2">
                                                <h6>Large</h6>
                                                <p class="mb-0" id="priceLarge">৳0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label for="itemQuantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="itemQuantity" min="1" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="addToCartBtn">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Receipt Preview Modal -->
                <div class="modal fade" id="receiptPreviewModal" tabindex="-1" aria-labelledby="receiptPreviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="receiptPreviewModalLabel">Order Preview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs" id="receiptTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer-receipt" type="button" role="tab">Customer Copy</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="kitchen-tab" data-bs-toggle="tab" data-bs-target="#kitchen-receipt" type="button" role="tab">Kitchen Copy</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="receiptTabContent">
                                    <!-- Customer Copy -->
                                    <div class="tab-pane fade show active" id="customer-receipt" role="tabpanel">
                                        <div class="receipt-container">
                                            <div class="receipt-header">
                                                <h3>Folafol BD</h3>
                                                <p class="mb-0">Fresh Juice Shop</p>
                                                <p class="mb-0">123 Juice Street, Dhaka</p>
                                                <p class="mb-0">Phone: 01712-345678</p>
                                                <p><strong>CUSTOMER COPY</strong></p>
                                                <h5>Order #<span id="preview-order-number"></span></h5>
                                                <p><small>Date: <span id="preview-date"></span></small></p>
                                            </div>

                                            <table class="receipt-table">
                                                <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="preview-items-list">
                                                    <!-- Will be populated dynamically -->
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-end">Subtotal:</td>
                                                        <td id="preview-subtotal">৳0</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-end">Discount:</td>
                                                        <td id="preview-discount">৳0</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                                        <td id="preview-total"><strong>৳0</strong></td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                            <div class="receipt-footer">
                                                <p>Thank you for your purchase!</p>
                                                <p class="mb-0"><small>Visit us again</small></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kitchen Copy -->
                                    <div class="tab-pane fade" id="kitchen-receipt" role="tabpanel">
                                        <div class="receipt-container">
                                            <div class="receipt-header">
                                                <h3>Folafol BD</h3>
                                                <p class="mb-0">Fresh Juice Shop</p>
                                                <p><strong>KITCHEN COPY</strong></p>
                                                <h5>Order #<span id="preview-kitchen-order-number"></span></h5>
                                                <p><small>Date: <span id="preview-kitchen-date"></span></small></p>
                                            </div>

                                            <table class="receipt-table">
                                                <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Size</th>
                                                        <th>Qty</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="preview-kitchen-items-list">
                                                    <!-- Will be populated dynamically -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit Order</button>
                                <button type="button" class="btn btn-primary" id="printReceiptBtn">Print Receipts</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Total -->
                <div class="border-top pt-3 no-print">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span id="subtotal">৳0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <span>Discount:</span>
                            <div class="input-group mx-2" style="width: 100px;">
                                <input type="number" class="form-control form-control-sm" id="discountAmount" min="0" value="0">
                                <span class="input-group-text">৳</span>
                            </div>
                        </div>
                        <span id="discountTotal">৳0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 fs-5 fw-bold">
                        <span>Total:</span>
                        <span id="grandTotal">৳0</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-3 d-flex justify-content-between no-print">
                    <button class="btn btn-outline-danger" id="clearCartBtn">
                        <i data-feather="trash-2" class="icon-sm me-1"></i> Clear
                    </button>
                    <div>
                        <a href="{{ route('admin.pos.orders') }}" class="btn btn-info me-2">
                            <i data-feather="list" class="icon-sm me-1"></i> Orders
                        </a>
                        <button class="btn btn-success" id="completeOrderBtn">
                            <i data-feather="check-circle" class="icon-sm me-1"></i> Complete Order
                        </button>
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

        // Current cart items
        let cartItems = [];
        let selectedSize = 'medium';
        let currentOrder = null;

        // Set current date for printing
        const updateDateTime = function() {
            const now = new Date();
            const options = {
                year: 'numeric'
                , month: 'short'
                , day: 'numeric'
                , hour: '2-digit'
                , minute: '2-digit'
            };
            const dateStr = now.toLocaleDateString('en-US', options);

            // Update all date elements
            $('#preview-date, #preview-kitchen-date').text(dateStr);
        };

        // Update date/time initially
        updateDateTime();

        // Add data attributes for availability to all juice items
        $('.juice-item').each(function() {
            const priceSmall = $(this).data('price-small');
            const priceMedium = $(this).data('price-medium');
            const priceLarge = $(this).data('price-large');

            $(this).attr('data-small-available', priceSmall !== null ? 'true' : 'false');
            $(this).attr('data-medium-available', priceMedium !== null ? 'true' : 'false');
            $(this).attr('data-large-available', priceLarge !== null ? 'true' : 'false');
        });

        // Juice item click handler
        $('.juice-item').on('click', function() {
            const juiceId = $(this).data('id');
            const juiceName = $(this).data('name');
            const priceSmall = $(this).data('price-small');
            const priceMedium = $(this).data('price-medium');
            const priceLarge = $(this).data('price-large');

            // Get availability data
            const smallAvailable = priceSmall !== null;
            const mediumAvailable = priceMedium !== null;
            const largeAvailable = priceLarge !== null;

            // Update modal
            $('#selectedJuiceId').val(juiceId);
            $('#selectedJuiceName').text(juiceName);

            // Reset selection and disable unavailable sizes
            $('.size-btn').removeClass('active disabled');

            // Handle Small size
            if (smallAvailable) {
                $('#priceSmall').text('৳' + priceSmall);
                $('.size-btn[data-size="small"]').removeClass('disabled');
            } else {
                $('#priceSmall').text('Unavailable');
                $('.size-btn[data-size="small"]').addClass('disabled');
            }

            // Handle Medium size
            if (mediumAvailable) {
                $('#priceMedium').text('৳' + priceMedium);
                $('.size-btn[data-size="medium"]').removeClass('disabled');
            } else {
                $('#priceMedium').text('Unavailable');
                $('.size-btn[data-size="medium"]').addClass('disabled');
            }

            // Handle Large size
            if (largeAvailable) {
                $('#priceLarge').text('৳' + priceLarge);
                $('.size-btn[data-size="large"]').removeClass('disabled');
            } else {
                $('#priceLarge').text('Unavailable');
                $('.size-btn[data-size="large"]').addClass('disabled');
            }

            // Set default selected size (choose the first available size)
            if (mediumAvailable) {
                $('.size-btn[data-size="medium"]').addClass('active');
                selectedSize = 'medium';
            } else if (smallAvailable) {
                $('.size-btn[data-size="small"]').addClass('active');
                selectedSize = 'small';
            } else if (largeAvailable) {
                $('.size-btn[data-size="large"]').addClass('active');
                selectedSize = 'large';
            } else {
                // No sizes available
                toastr.error('This juice is not available in any size');
                return; // Don't show the modal
            }

            $('#itemQuantity').val(1);

            // Show modal
            $('#sizeModal').modal('show');
        });

        // Size button click handler
        $('.size-btn').on('click', function() {
            if ($(this).hasClass('disabled')) {
                toastr.error('This size is not available');
                return;
            }

            $('.size-btn').removeClass('active');
            $(this).addClass('active');
            selectedSize = $(this).data('size');
        });

        // Add to cart button click handler
        $('#addToCartBtn').on('click', function() {
            const quantity = parseInt($('#itemQuantity').val()) || 1;
            const juiceId = $('#selectedJuiceId').val();
            const juiceName = $('#selectedJuiceName').text();

            // Check if selected size is available
            if ($('.size-btn[data-size="' + selectedSize + '"]').hasClass('disabled')) {
                toastr.error('This size is not available');
                return;
            }

            // Get price based on selected size
            let price = 0;
            if (selectedSize === 'small') {
                price = parseFloat($('#priceSmall').text().replace('৳', ''));
            } else if (selectedSize === 'medium') {
                price = parseFloat($('#priceMedium').text().replace('৳', ''));
            } else if (selectedSize === 'large') {
                price = parseFloat($('#priceLarge').text().replace('৳', ''));
            }

            // Double check the price is valid
            if (isNaN(price) || price === 0) {
                toastr.error('Invalid price for selected size');
                return;
            }

            const cartItem = {
                id: juiceId
                , name: juiceName
                , size: selectedSize
                , price: price
                , quantity: quantity
                , total: price * quantity
            };

            // Check if same item with same size exists in cart
            const existingItemIndex = cartItems.findIndex(item =>
                item.id === cartItem.id && item.size === cartItem.size
            );

            if (existingItemIndex !== -1) {
                // Update existing item
                cartItems[existingItemIndex].quantity += cartItem.quantity;
                cartItems[existingItemIndex].total = cartItems[existingItemIndex].price * cartItems[existingItemIndex].quantity;
            } else {
                // Add new item
                cartItems.push(cartItem);
            }

            // Update cart display
            updateCartDisplay();

            // Hide modal
            $('#sizeModal').modal('hide');
        });

        // Update cart display
        function updateCartDisplay() {
            // Show/hide empty cart message
            if (cartItems.length === 0) {
                $('#emptyCart').show();
                $('#cartItems').find('.cart-item').remove();
            } else {
                $('#emptyCart').hide();

                // Clear current cart items
                $('#cartItems').find('.cart-item').remove();

                // Add cart items
                cartItems.forEach((item, index) => {
                    const sizeLabel = item.size.charAt(0).toUpperCase() + item.size.slice(1);
                    const itemHtml = `
                <div class="cart-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-0">${item.name}</h6>
                            <small class="text-muted">${sizeLabel}, ৳${item.price.toFixed(2)} x ${item.quantity}</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-3">৳${item.total.toFixed(2)}</span>
                            <button class="btn btn-sm btn-outline-danger remove-item" data-index="${index}">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;

                    $('#cartItems').append(itemHtml);
                });

                // Re-initialize feather icons for new elements
                feather.replace();

                // Add remove button handler
                $('.remove-item').on('click', function() {
                    const index = $(this).data('index');
                    cartItems.splice(index, 1);
                    updateCartDisplay();
                });
            }

            // Update totals
            updateTotals();
        }

        // Update totals
        function updateTotals() {
            let subtotal = 0;

            cartItems.forEach(item => {
                subtotal += item.total;
            });

            const discount = parseFloat($('#discountAmount').val()) || 0;
            const grandTotal = Math.max(0, subtotal - discount);

            $('#subtotal').text('৳' + subtotal.toFixed(2));
            $('#discountTotal').text('৳' + discount.toFixed(2));
            $('#grandTotal').text('৳' + grandTotal.toFixed(2));

            // Also update preview totals
            $('#preview-subtotal').text('৳' + subtotal.toFixed(2));
            $('#preview-discount').text('৳' + discount.toFixed(2));
            $('#preview-total').text('৳' + grandTotal.toFixed(2));
        }

        // Update preview receipt items
        function updatePreviewItems() {
            $('#preview-items-list, #preview-kitchen-items-list').empty();

            cartItems.forEach(item => {
                const sizeLabel = item.size.charAt(0).toUpperCase() + item.size.slice(1);

                // Customer receipt items
                const customerItemHtml = `
            <tr>
                <td>${item.name} (${sizeLabel})</td>
                <td>৳${item.price.toFixed(2)}</td>
                <td>${item.quantity}</td>
                <td>৳${item.total.toFixed(2)}</td>
            </tr>
        `;
                $('#preview-items-list').append(customerItemHtml);

                // Kitchen receipt items
                const kitchenItemHtml = `
            <tr>
                <td>${item.name}</td>
                <td>${sizeLabel}</td>
                <td>${item.quantity}</td>
            </tr>
        `;
                $('#preview-kitchen-items-list').append(kitchenItemHtml);
            });
        }

        // Discount input handler
        $('#discountAmount').on('input', function() {
            updateTotals();
        });

        // Clear cart button
        $('#clearCartBtn').on('click', function() {
            if (cartItems.length === 0) return;

            if (confirm('Are you sure you want to clear the cart?')) {
                cartItems = [];
                updateCartDisplay();
            }
        });

        // Search functionality
        $('#searchJuice').on('input', function() {
            const searchTerm = $(this).val().toLowerCase();

            $('.juice-item').each(function() {
                const itemName = $(this).data('name').toLowerCase();

                if (itemName.includes(searchTerm)) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        });

        // Print receipt button in modal
        $('#printReceiptBtn').on('click', function() {
            if (!currentOrder || !currentOrder.id) {
                toastr.error('Order information is missing');
                return;
            }

            // Open print receipt page in a new window
            const printUrl = `/admin/pos/print-receipt/${currentOrder.id}`;
            window.open(printUrl, '_blank');

            // Close modal and reset cart
            $('#receiptPreviewModal').modal('hide');
            cartItems = [];
            updateCartDisplay();
        });

        // Complete order button
        $('#completeOrderBtn').on('click', function() {
            if (cartItems.length === 0) {
                toastr.error('Cart is empty. Please add items to complete an order.');
                return;
            }

            // Prepare order data for submission
            const subtotal = parseFloat($('#subtotal').text().replace('৳', ''));
            const discount = parseFloat($('#discountAmount').val()) || 0;
            const total = parseFloat($('#grandTotal').text().replace('৳', ''));

            const orderData = {
                items: cartItems
                , subtotal: subtotal
                , discount: discount
                , total: total
            };

            // Disable button during processing
            $('#completeOrderBtn').prop('disabled', true).html('<i class="spinner-border spinner-border-sm"></i> Processing...');

            // Send order data to server via AJAX
            $.ajax({
                url: "{{ route('admin.pos.checkout') }}"
                , type: "POST"
                , data: JSON.stringify(orderData)
                , contentType: "application/json"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    if (response.success) {
                        // Store the current order
                        currentOrder = response.order;

                        // Update preview with order info
                        $('#preview-order-number, #preview-kitchen-order-number').text(response.order.order_name);

                        // Update date/time to be accurate
                        updateDateTime();

                        // Update preview items
                        updatePreviewItems();

                        // Show receipt preview modal
                        $('#receiptPreviewModal').modal('show');

                        toastr.success('Order completed successfully!');
                    } else {
                        toastr.error('Error completing order: ' + response.message);
                    }
                }
                , error: function(xhr) {
                    let errorMessage = 'Error processing order';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    toastr.error(errorMessage);
                }
                , complete: function() {
                    // Re-enable button
                    $('#completeOrderBtn').prop('disabled', false).html('<i data-feather="check-circle" class="icon-sm me-1"></i> Complete Order');
                    feather.replace();
                }
            });
        });
    });

</script>
@endpush
