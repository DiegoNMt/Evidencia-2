@extends('layouts.app')

@section('content')

<div class="container-lg px-4">

    <div class="card mb-4">

        <div class="card-header">
            Edit Order
        </div>

        <div class="card-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('orders.update', $order->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="mb-3">

                    <label class="form-label">
                        Invoice Number
                    </label>

                    <input
                        type="text"
                        name="invoice_number"
                        class="form-control"
                        value="{{ $order->invoice_number }}"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Customer
                    </label>

                    <select
                        name="customer_id"
                        class="form-select"
                        required
                    >

                        @foreach($customers as $customer)

                            <option
                                value="{{ $customer->id }}"
                                {{ $order->customer_id == $customer->id ? 'selected' : '' }}
                            >

                                {{ $customer->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Order Date
                    </label>

                    <input
                        type="date"
                        name="order_date"
                        class="form-control"
                        value="{{ $order->order_date }}"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select"
                        required
                    >

                        <option
                            value="Pending"
                            {{ $order->status == 'Pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="In route"
                            {{ $order->status == 'In route' ? 'selected' : '' }}
                        >
                            In route
                        </option>

                        <option
                            value="Delivered"
                            {{ $order->status == 'Delivered' ? 'selected' : '' }}
                        >
                            Delivered
                        </option>

                    </select>

                </div>


                <div class="mb-4">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                    >{{ $order->description }}</textarea>

                </div>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update Order
                </button>

                <a
                    href="{{ route('orders.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection