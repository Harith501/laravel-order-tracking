{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mt-5">
        <h2>Welcome to Sinor Technology Sdn Bhd Order System</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3">View Orders</a>
    </div>
@endsection
