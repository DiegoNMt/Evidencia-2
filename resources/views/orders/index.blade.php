@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <strong>Orders Management</strong>

            <div>
                <a href="{{ route('orders.create') }}" class="btn btn-primary">
                    Create Order
                </a>

                <a href="{{ route('orders.archived') }}" class="btn btn-secondary">
                    Archived Orders
                </a>
            </div>

        </div>

        <div class="card-body">

            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th width="250">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($orders as $order)

                        <tr>

                            <td>{{ $order->id }}</td>

                            <td>{{ $order->invoice_number }}</td>

                            <td>{{ $order->customer->name ?? 'N/A' }}</td>

                            <td>{{ $order->order_date }}</td>

                            <td>

                                @if($order->status == 'Ordered')
                                    <span class="badge bg-warning">
                                        Ordered
                                    </span>

                                @elseif($order->status == 'In process')
                                    <span class="badge bg-info">
                                        In process
                                    </span>

                                @elseif($order->status == 'In route')
                                    <span class="badge bg-primary">
                                        In route
                                    </span>

                                @elseif($order->status == 'Delivered')
                                    <span class="badge bg-success">
                                        Delivered
                                    </span>

                                @else
                                    <span class="badge bg-secondary">
                                        {{ $order->status }}
                                    </span>
                                @endif

                            </td>

                            <td>

                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="btn btn-sm btn-info">
                                    View
                                </a>

                                <a href="{{ route('orders.edit', $order->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Edit
                                </a>

                                <form action="{{ route('orders.destroy', $order->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger">
                                        Archive
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                No orders found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>

        </div>

    </div>

</div>

@endsection