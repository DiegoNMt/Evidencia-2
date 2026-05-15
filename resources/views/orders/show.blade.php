@extends('layouts.app')

@section('content')

<div class="container-fluid px-4">

    <div class="card mb-4">
        
        @if(session('success')) // Show success message after photo upload

            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-coreui-dismiss="alert"
                ></button>

            </div>

        @endif

        @if(session('error')) // Show error message after photo upload failure

            <div class="alert alert-danger alert-dismissible fade show mb-4">

                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-coreui-dismiss="alert"
                ></button>

            </div>

        @endif

        <div class="card-header">
            <strong>Order Details</strong>
        </div>

        <div class="card-body">

            <p>
                <strong>Invoice:</strong>
                {{ $order->invoice_number }}
            </p>

            <p>
                <strong>Customer:</strong>
                {{ $order->customer->name ?? 'N/A' }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ $order->status }}
            </p>

            <p>
                <strong>Description:</strong>
                {{ $order->description }}
            </p>

        </div>

    </div>


    {{-- EVIDENCE PHOTOS --}}
    @if($order->photos->count())

        <div class="card mb-4">

            <div class="card-header">
                Uploaded Evidence
            </div>

            <div class="card-body">

                <div class="row">

                    @foreach($order->photos as $photo)

                        <div class="col-md-6 mb-4">

                            <h5 class="mb-3">

                                {{ ucfirst($photo->photo_type) }} Evidence

                            </h5>

                            @if(Str::startsWith($photo->photo_path, 'http'))

                                <img
                                    src="{{ $photo->photo_path }}"
                                    class="img-fluid rounded border"
                                    style="max-height: 400px;"
                                >

                            @else

                                <img
                                    src="{{ asset('storage/' . $photo->photo_path) }}"
                                    class="img-fluid rounded border"
                                    style="max-height: 400px;"
                                >

                            @endif

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    @endif



    {{-- UPLOAD SECTION --}}
    @if($order->status === 'In route' || $order->status === 'Delivered')

        <div class="card">

            <div class="card-header">
                Upload Evidence
            </div>

            <div class="card-body">

                <form
                    action="{{ route('orders.photos.store', $order->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Upload Photo
                        </label>

                        <input
                            type="file"
                            name="photo"
                            class="form-control"
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Or Image URL
                        </label>

                        <input
                            type="text"
                            name="photo_url"
                            class="form-control"
                            placeholder="https://example.com/image.jpg"
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Evidence Type
                        </label>

                        <select
                            name="photo_type"
                            class="form-select"
                            required
                        >

                            @if($order->status === 'In route')

                                <option value="loaded">
                                    In route evidence
                                </option>

                            @endif

                            @if($order->status === 'Delivered')

                                <option value="unloaded">
                                    Delivered evidence
                                </option>

                            @endif

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Upload Evidence
                    </button>

                </form>

            </div>

        </div>

    @else

        <div class="alert alert-warning">

            This order is currently in
            <strong>{{ $order->status }}</strong>
            status.

            Evidence photos can only be uploaded when
            the order is:

            <strong>In route</strong>
            or
            <strong>Delivered</strong>.

        </div>

    @endif

</div>

@endsection