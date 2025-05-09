<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Receipt - Order #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .receipt {
            width: 300px;
            margin: 0 auto;
            padding: 10px;
            page-break-after: always;
            /* Force a page break after each receipt */
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        .totals {
            margin-top: 10px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 12px;
        }

        .copy-type {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        /* Kitchen copy specific styling */
        .kitchen-copy {
            background-color: #f5f5f5;
        }

        /* Customer copy specific styling */
        .customer-copy {
            background-color: #fff;
        }

        .order-number {
            font-size: 1.2em;
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 3px 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        @media print {
            @page {
                margin: 0;
                size: auto;
            }

            body {
                margin: 0;
            }
        }

    </style>
</head>
<body>
    <!-- Kitchen Copy Header -->
    <div class="header">
        <h2>Folafol BD</h2>
        <p>Fresh Juice Shop</p>
        <p>123 Juice Street, Dhaka</p>
        <p>Phone: 01712-345678</p>
        <div class="copy-type">KITCHEN COPY</div>
        <h3>Order: <span class="order-number" style="font-size: 1.2em; font-weight: bold;"></span></h3>
        <p>Date: <span class="current-date"></span></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Size</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->juice_name }}</td>
                <td>{{ ucfirst($item->size) }}</td>
                <td>{{ $item->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <!-- Customer Copy Header -->
    <div class="header">
        <h2>Folafol BD</h2>
        <p>Fresh Juice Shop</p>
        <p>123 Juice Street, Dhaka</p>
        <p>Phone: 01712-345678</p>
        <div class="copy-type">CUSTOMER COPY</div>
        <h3>Order: <span class="order-number" style="font-size: 1.2em; font-weight: bold;"></span></h3>
        <p>Date: <span class="current-date"></span></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->juice_name }} ({{ ucfirst($item->size) }})</td>
                <td>৳{{ number_format($item->price, 2) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>৳{{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <p><strong>Subtotal:</strong> ৳{{ number_format($order->subtotal, 2) }}</p>
        <p><strong>Discount:</strong> ৳{{ number_format($order->discount, 2) }}</p>
        <p><strong>Total:</strong> ৳{{ number_format($order->total, 2) }}</p>
    </div>

    <div class="footer">
        <p>Thank you for your purchase!</p>
        <p>Visit us again</p>
    </div>
    </div>

    <script>
        // Auto-print when the page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
                // Optionally close the window after printing
                // setTimeout(function() { window.close(); }, 500);
            }, 500);
        };

    </script>
</body>
</html>
