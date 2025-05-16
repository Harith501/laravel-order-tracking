@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">
        <h1 class="mb-4">Admin Dashboard</h1>

        <p>Welcome, Admin! Here you can manage orders, view statistics, and more.</p>

        <!-- Orders Management Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Manage Orders</h3>
            </div>
            <div class="card-body">
                <p>You can view and manage all orders here.</p>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">View Orders</a>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Statistics</h3>
            </div>
            <div class="card-body">
                <p>View important statistics about orders, completed installations, etc.</p>
                <!-- Add relevant statistics or charts here -->
                <button class="btn btn-info">View Stats</button>
            </div>
        </div>

        <!-- Admin Tools Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Admin Tools</h3>
            </div>
            <div class="card-body">
                <p>Here you can access various admin tools to help with managing the platform.</p>
                <!-- Add tools or links to admin functionalities -->
                <button class="btn btn-secondary">Admin Tool 1</button>
                <button class="btn btn-secondary">Admin Tool 2</button>
            </div>
        </div>
    </div>
@endsection
