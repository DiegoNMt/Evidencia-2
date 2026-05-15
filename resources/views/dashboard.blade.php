@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- PAGE TITLE --}}
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-medium-emphasis">
            Welcome to the Halcón administrative panel.
        </p>
    </div>

    {{-- QUICK STATS --}}
    <div class="row">

        <div class="col-sm-6 col-lg-3">

            <div class="card text-white bg-primary mb-4">

                <div class="card-body pb-0 d-flex justify-content-between align-items-start">

                    <div>
                        <div class="fs-4 fw-semibold">
                            Orders
                        </div>

                        <div>
                            Manage customer orders
                        </div>
                    </div>

                </div>

                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                </div>

            </div>

        </div>

        <div class="col-sm-6 col-lg-3">

            <div class="card text-white bg-success mb-4">

                <div class="card-body pb-0 d-flex justify-content-between align-items-start">

                    <div>
                        <div class="fs-4 fw-semibold">
                            Users
                        </div>

                        <div>
                            Employee management
                        </div>
                    </div>

                </div>

                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                </div>

            </div>

        </div>

        <div class="col-sm-6 col-lg-3">

            <div class="card text-white bg-warning mb-4">

                <div class="card-body pb-0 d-flex justify-content-between align-items-start">

                    <div>
                        <div class="fs-4 fw-semibold">
                            Search
                        </div>

                        <div>
                            Public order tracking
                        </div>
                    </div>

                </div>

                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                </div>

            </div>

        </div>

        <div class="col-sm-6 col-lg-3">

            <div class="card text-white bg-danger mb-4">

                <div class="card-body pb-0 d-flex justify-content-between align-items-start">

                    <div>
                        <div class="fs-4 fw-semibold">
                            Archived
                        </div>

                        <div>
                            Restore archived orders
                        </div>
                    </div>

                </div>

                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                </div>

            </div>

        </div>

    </div>

    {{-- QUICK ACTIONS --}}
    <div class="card mb-4">

        <div class="card-header">
            <strong>Quick Actions</strong>
        </div>

        <div class="card-body">

            <div class="d-flex flex-wrap gap-3">

                <a href="{{ route('orders.index') }}"
                   class="btn btn-primary">
                    Manage Orders
                </a>

                <a href="{{ route('orders.create') }}"
                   class="btn btn-success">
                    Create Order
                </a>

                <a href="{{ route('users.index') }}"
                   class="btn btn-info text-white">
                    Manage Users
                </a>

                <a href="{{ route('orders.archived') }}"
                   class="btn btn-danger">
                    Archived Orders
                </a>

                <a href="{{ route('home') }}"
                   class="btn btn-secondary">
                    Public Search
                </a>

            </div>

        </div>

    </div>

</div>

@endsection