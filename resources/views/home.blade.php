@extends('layouts.app')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<div class="container-fluid">

    <div class="row justify-content-center mt-5">

        <div class="col-md-6">

            {{-- Search Card --}}
            <div class="card shadow-sm mb-4">

                <div class="card-header">
                    <strong>Search Order by Invoice Number</strong>
                </div>

                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('orders.search') }}" method="GET">

                        <div class="mb-3">
                            <label class="form-label">Invoice Number</label>
                            <input type="text" name="invoice_number" class="form-control" placeholder="Enter invoice number" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Search</button>

                    </form>

                </div>

            </div>

            {{-- Result Card --}}
            @if(isset($order))
                <div class="card shadow-sm mt-3">
                    <div class="card-header">Order Result</div>
                    <div class="card-body">
                        <p><strong>Invoice:</strong> {{ $order->invoice_number }}</p>
                        <p><strong>Customer:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
                        <p><strong>Status:</strong> {{ $order->status }}</p>
                        <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
                        <p><strong>Description:</strong> {{ $order->description }}</p>
                        {{-- ROUTE PHOTO --}}
                        @if($order->route_photo)

                            <div class="mt-4">

                                <h5>Route Evidence</h5>

                                @if(Str::startsWith($order->route_photo, 'http'))

                                    <img
                                        src="{{ $order->route_photo }}"
                                        class="img-fluid rounded border"
                                        style="max-width: 100%; max-height: 300px;"
                                    >

                                @else

                                    <img
                                        src="{{ asset('storage/' . $order->route_photo) }}"
                                        class="img-fluid rounded border"
                                        style="max-width: 100%; max-height: 300px;"
                                    >

                                @endif

                            </div>

                        @endif


                        {{-- EVIDENCE PHOTOS --}}
                        @if($order->photos->count())

                            <hr>

                            <h5 class="mb-3">
                                Evidence Photos
                            </h5>

                            <div class="row">

                                @foreach($order->photos as $photo)

                                    <div class="col-md-6 mb-4">

                                        <div class="card">

                                            <div class="card-header">

                                                {{ ucfirst($photo->photo_type) }} Evidence

                                            </div>

                                            <div class="card-body text-center">

                                                @if(Str::startsWith($photo->photo_path, 'http'))

                                                    <img
                                                        src="{{ $photo->photo_path }}"
                                                        class="img-fluid rounded border"
                                                        style="max-height: 250px; object-fit: cover;"
                                                    >

                                                @else

                                                    <img
                                                        src="{{ asset('storage/' . $photo->photo_path) }}"
                                                        class="img-fluid rounded border"
                                                        style="max-height: 250px; object-fit: cover;"
                                                    >

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @endif
                    </div>
                </div>
            @endif

        </div>

    </div>

</div>

@endsection