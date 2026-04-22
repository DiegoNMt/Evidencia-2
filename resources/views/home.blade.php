<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halcón System</title>
</head>
<body>
    <h1>Halcón System</h1>

    <h2>Search Order by Invoice Number</h2>

    <form action="{{ route('orders.search') }}" method="GET">
        <label for="invoice_number">Invoice #:</label>
        <input type="text" name="invoice_number" id="invoice_number" required>
        <button type="submit">Search</button>
    </form>

    <hr>

    @if(isset($order))
        @if($order)
            <h3>Order Found</h3>

            <p><strong>Invoice Number:</strong> {{ $order->invoice_number }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
            <p><strong>Date:</strong> {{ $order->order_date }}</p>

            @if($order->status === 'Delivered')
                <h4>Delivered Photo</h4>

                @php
                    $deliveredPhoto = $order->photos->where('photo_type', 'unloaded')->first();
                @endphp

                @if($deliveredPhoto)
                    <img src="{{ asset('storage/' . $deliveredPhoto->photo_path) }}" alt="Delivered Photo" width="300">
                @else
                    <p>No delivered photo available.</p>
                @endif
            @elseif($order->status === 'In process')
                <h4>Process Information</h4>
                <p>Process name: {{ $order->status }}</p>
                <p>Date: {{ $order->order_date }}</p>
            @else
                <p>No special information for this status.</p>
            @endif
        @else
            <p>Order not found.</p>
        @endif
    @endif
</body>
</html>