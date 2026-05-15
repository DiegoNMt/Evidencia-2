@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card mb-4">

        <div class="card-header">
            <strong>Create Order</strong>
        </div>

        <div class="card-body">

            <form action="{{ route('orders.store') }}"
                  method="POST">

                @csrf

                {{-- Invoice Number --}}
                <div class="mb-3">

                    <label class="form-label">
                        Invoice Number
                    </label>

                    <input type="text"
                           name="invoice_number"
                           class="form-control"
                           required>

                </div>

                {{-- Customer --}}
                <div class="mb-3">

                    <label class="form-label">
                        Customer
                    </label>

                    <select name="customer_id"
                            class="form-select"
                            required>

                        @foreach($customers as $customer)

                            <option value="{{ $customer->id }}">
                                {{ $customer->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Order Date --}}
                <div class="mb-3">

                    <label class="form-label">
                        Order Date
                    </label>

                    <input type="date"
                           name="order_date"
                           class="form-control"
                           required>

                </div>

                {{-- Status --}}
                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-select">

                        <option value="Ordered">
                            Ordered
                        </option>

                        <option value="In process">
                            In process
                        </option>

                        <option value="In route">
                            In route
                        </option>

                        <option value="Delivered">
                            Delivered
                        </option>

                    </select>

                </div>

                {{-- Description --}}
                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea name="description"
                              rows="4"
                              class="form-control"></textarea>

                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">

                    <button type="submit"
                            class="btn btn-primary">
                        Save Order
                    </button>

                    <a href="{{ route('orders.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection