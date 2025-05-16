@extends('layouts.app')

@section('title', 'Order List')

@section('content')
    <h2 class="mb-4">Order List</h2>

    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <div class="row mb-3 align-items-center">
        <!-- Create New Order button -->
        <div class="col-md-6">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">Create New Order</a>
        </div>

        <!-- Search form -->
        <div class="col-md-6">
            <form action="{{ route('orders.index') }}" method="GET" class="d-flex justify-content-end">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Search by">
                <button type="submit" class="btn btn-success">Search</button>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order No</th>
                <th>Customer Name</th>
                <th>Installation Date</th>
                <th>Exchange</th>
                <th>Work Activity</th>
                <th>ID Slot Order</th>
                <th>Team Leader</th>
                <th>Team Member 1</th>
                <th>Team Member 2</th>
                <th>Team Member 3</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->order_no }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->installation_date }}</td>
                    <td>{{ $order->exchange }}</td>
                    <td>{{ $order->work_activity }}</td>
                    <td>{{ $order->id_slot_order }}</td>
                    <td>{{ $order->team_leader }}</td>
                    <td>{{ $order->team_member_1 }}</td>
                    <td>{{ $order->team_member_2 }}</td>
                    <td>{{ $order->team_member_3 }}</td>
                    <td>{{ $order->order_status }}</td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
