<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #{{ $order->invoice_no }}</title>

    <!-- Thermal Receipt Styles -->
    <style>
        /* Base Reset */
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f0f0f0; /* Grey background for screen contrast */
            color: #000; /* Strict Black for Thermal Printers */
            font-size: 12px;
            line-height: 1.4;
        }

        /* Helpers */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .font-bold { font-weight: bold; }
        .text-uppercase { text-transform: uppercase; }
        .mb-1 { margin-bottom: 4px; }
        .mb-2 { margin-bottom: 8px; }
        .mb-3 { margin-bottom: 12px; }
        .d-flex { display: flex; }
        .justify-between { justify-content: space-between; }

        /* Receipt Container (Screen) */
        .receipt-container {
            width: 80mm; /* Standard Thermal Width */
            margin: 20px auto;
            background: #fff;
            padding: 5mm;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Visual Separator */
        .dashed-line {
            border-bottom: 1px dashed #000;
            margin: 10px 0;
        }

        /* Typography */
        .header h2 { font-size: 16px; margin-bottom: 5px; }
        .header p { font-size: 10px; }

        /* Table Layout */
        table { width: 100%; border-collapse: collapse; }
        th { border-bottom: 1px dashed #000; padding: 5px 0; font-size: 10px; }
        td { padding: 5px 0; font-size: 11px; }

        /* Totals */
        .grand-total {
            font-size: 14px;
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 5px 0;
            margin: 5px 0;
        }

        /* Footer */
        .footer { margin-top: 20px; font-size: 10px; }

        /* Screen-Only Buttons */
        .action-buttons { text-align: center; margin-bottom: 20px; }
        .btn {
            background: #333; color: #fff; border: none; padding: 8px 16px;
            border-radius: 20px; cursor: pointer; text-decoration: none;
            font-size: 12px; display: inline-block; margin: 0 5px;
        }
        .btn:hover { background: #000; }
        .btn-outline { background: transparent; border: 1px solid #333; color: #333; }
        .btn-outline:hover { background: #eee; }

        /* PRINT MEDIA QUERY: Critical for correct output */
        @media print {
            @page { margin: 0; size: auto; }
            body { background: #fff; }
            .receipt-container {
                width: 100%; /* Fill Paper */
                margin: 0;
                padding: 2mm;
                box-shadow: none;
            }
            .action-buttons { display: none; }
        }
    </style>

    <!-- Auto-Print Script -->
    <script>
        window.onload = function() { window.print(); }
    </script>
</head>
<body>

    <!-- User Actions (Hidden on Print) -->
    <div class="action-buttons">
        <button class="btn" onclick="window.print()">Print Again</button>
        <button class="btn btn-outline" onclick="window.close()">Close</button>
    </div>

    <!-- Receipt Content -->
    <div class="receipt-container">

        <!-- Header -->
        <div class="header text-center mb-3">
            <h2 class="font-bold text-uppercase">POS SHOP</h2>
            <p>123 Commerce Avenue, Jakarta</p>
            <p>Tel: +62 812 3456 7890</p>
        </div>

        <div class="dashed-line"></div>

        <!-- Metadata -->
        <div class="d-flex justify-between mb-1">
            <span>Date:</span>
            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="d-flex justify-between mb-1">
            <span>Invoice:</span>
            <span>#{{ $order->invoice_no }}</span>
        </div>
        <div class="d-flex justify-between mb-1">
            <span>Cashier:</span>
            <span>{{ substr(auth()->user()->name ?? 'Staff', 0, 10) }}</span>
        </div>
         <div class="d-flex justify-between">
            <span>Customer:</span>
            <span class="font-bold">{{ substr($order->customer->name, 0, 15) }}</span>
        </div>

        <div class="dashed-line"></div>

        <!-- Items Table -->
        <table>
            <thead>
                <tr>
                    <th class="text-left" style="width: 45%">ITEM</th>
                    <th class="text-center" style="width: 15%">QTY</th>
                    <th class="text-right" style="width: 20%">PRICE</th>
                    <th class="text-right" style="width: 20%">AMT</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $item)
                <tr>
                    <td colspan="4" class="text-left font-bold" style="padding-top: 5px;">{{ $item->product->name }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td class="text-right font-bold">{{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="dashed-line"></div>

        <!-- Financials -->
        <div class="total-section">
            <div class="d-flex justify-between mb-1">
                <span>Subtotal</span>
                <span>{{ number_format($order->sub_total, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-between mb-1">
                <span>Tax</span>
                <span>{{ number_format($order->vat, 0, ',', '.') }}</span>
            </div>

            <div class="grand-total d-flex justify-between align-center font-bold">
                <span>TOTAL</span>
                <span style="font-size: 16px;">{{ number_format($order->total, 0, ',', '.') }}</span>
            </div>

            <div class="d-flex justify-between mt-2 mb-1">
                <span>Pay ({{ $order->payment_type ?? 'Cash' }})</span>
                <span>{{ number_format($order->pay_amount, 0, ',', '.') }}</span>
            </div>
             <div class="d-flex justify-between">
                <span>Change</span>
                <span>{{ number_format($order->due_amount < 0 ? abs($order->due_amount) : 0, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer text-center">
            <p class="mb-1">*** THANK YOU ***</p>
            <p>Please keep this receipt for warranty.</p>
            <br>
            <p style="letter-spacing: 2px;">{{ $order->invoice_no }}</p>
        </div>
    </div>

</body>
</html>
