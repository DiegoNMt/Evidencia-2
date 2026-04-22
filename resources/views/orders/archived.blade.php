<h1>Archived Orders</h1>

<a href="{{ route('orders.index') }}">Back to Orders</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Invoice</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Deleted At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->invoice_number }}</td>
                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->deleted_at }}</td>
                <td>
                    <form action="{{ route('orders.restore', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit">Restore</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No archived orders.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $orders->links() }}