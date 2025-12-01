<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sagip Taal Lake')</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @stack('styles')
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .main-content {
            min-height: calc(100vh - 200px);
        }

        .alert {
            padding: 1rem;
            margin: 1rem auto;
            max-width: 1200px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    @include('partials.navbar')

    <div class="main-content">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </div>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
