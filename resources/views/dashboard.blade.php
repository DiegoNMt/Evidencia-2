@extends('layouts.app')

@section('content')
<h1>Dashboard</h1>

<ul>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li><a href="{{ route('orders.index') }}">Orders</a></li>
    <li><a href="{{ route('orders.archived') }}">Archived Orders</a></li>
</ul>
@endsection