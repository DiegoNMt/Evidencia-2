<h1>Orders</h1>

<a href="{{ route('orders.create') }}">Create Order</a>
<a href="{{ route('orders.archived') }}">Archived Orders</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Invoice</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->invoice_number }}</td>
                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}">View</a>
                    <a href="{{ route('orders.edit', $order->id) }}">Edit</a>

                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Archive</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No orders found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $orders->links() }}