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

            <strong>Archived Orders</strong>

            <a href="{{ route('orders.index') }}"
               class="btn btn-primary">
                Back to Orders
            </a>

        </div>

        <div class="card-body">

            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Deleted At</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($orders as $order)

                        <tr>

                            <td>{{ $order->id }}</td>

                            <td>{{ $order->invoice_number }}</td>

                            <td>{{ $order->customer->name ?? 'N/A' }}</td>

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
                                {{ $order->deleted_at }}
                            </td>

                            <td>

                                <form action="{{ route('orders.restore', $order->id) }}"
                                      method="POST">

                                    @csrf

                                    <button type="submit"
                                            class="btn btn-success btn-sm">
                                        Restore
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                No archived orders.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection