<h1>Edit Order</h1>

<form action="{{ route('orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Invoice Number</label>
        <input type="text" name="invoice_number" value="{{ $order->invoice_number }}" required>
    </div>

    <div>
        <label>Customer</label>
        <select name="customer_id" required>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Order Date</label>
        <input type="date" name="order_date" value="{{ $order->order_date }}" required>
    </div>

    <div>
        <label>Status</label>
        <select name="status" required>
            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="In process" {{ $order->status == 'In process' ? 'selected' : '' }}>In process</option>
            <option value="In route" {{ $order->status == 'In route' ? 'selected' : '' }}>In route</option>
            <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
        </select>
    </div>

    <div>
        <label>Description</label>
        <textarea name="description">{{ $order->description }}</textarea>
    </div>

    <button type="submit">Update</button>
</form>