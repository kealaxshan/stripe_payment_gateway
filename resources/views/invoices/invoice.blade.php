<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 2em;
            margin: 0;
        }
        .header p {
            font-size: 1.2em;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        .invoice-details th, .invoice-details td {
            padding: 8px;
            text-align: left;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details th {
            background-color: #f4f4f4;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 1em;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Invoice #{{ $order->id }}</h1>
            <p>Order Date: {{ $order->created_at->format('F j, Y') }}</p>
        </div>

        <div class="invoice-details">
            <h3>Billing Information:</h3>
            <p><strong>User Name:</strong> {{ $order->user_name }}</p>
            <p><strong>Payment Intent ID:</strong> {{ $order->id }}</p>
            <p><strong>Stripe Session ID:</strong> {{ $order->stripe_session_id }}</p>

            <h3>Products:</h3>
          
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <tr>
                                <td>{{ $order->product_name }}</td>
                                <td>1</td>
                                <td>${{ number_format($order->amount, 2) }}</td> 
                                <td>${{ number_format($order->amount, 2) }}</td>
                            </tr>
                       
                    </tbody>
                </table>
            <h3>Order Summary:</h3>
            <p><strong>Subtotal:</strong> ${{ number_format($order->amount, 2) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        </div>

        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>

</body>
</html>
