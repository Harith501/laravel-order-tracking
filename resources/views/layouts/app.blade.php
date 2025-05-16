<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Daily Order Tracker')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">

    {{-- Header --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('front') }}">SINOR TECHNOLOGY SDN BHD</a>

            <div class="d-flex">
                <a class="btn btn-outline-primary me-2" href="{{ route('orders.index') }}">Orders</a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-fill">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        &copy; {{ date('Y') }} Sinor Technology Sdn Bhd. All rights reserved.
    </footer>

</body>
</html>