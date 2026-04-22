<h1>Create Order</h1>

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <div>
        <label>Invoice Number</label>
        <input type="text" name="invoice_number" required>
    </div>

    <div>
        <label>Customer</label>
        <select name="customer_id" required>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Order Date</label>
        <input type="date" name="order_date" required>
    </div>

    <div>
        <label>Status</label>
        <select name="status" required>
            <option value="Pending">Pending</option>
            <option value="In process">In process</option>
            <option value="In route">In route</option>
            <option value="Delivered">Delivered</option>
        </select>
    </div>

    <div>
        <label>Description</label>
        <textarea name="description"></textarea>
    </div>

    <button type="submit">Save</button>
</form>