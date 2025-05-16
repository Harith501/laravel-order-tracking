@extends('layouts.app')

@section('title', 'Sinor Technology Order Tracking')

@section('content')
    <div class="text-center py-5">
        <h1 class="mb-4">Welcome to Daily Order Tracker</h1>
        <p class="lead">Manage your team's daily installation orders efficiently.</p>

        @auth
            @if (Auth::user()->admin)
                <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3">Go to Orders</a>
            @endif
        @endauth
    </div>
@endsection
