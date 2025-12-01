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
            background-color: #f4f4f4;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .navbar-menu a:hover {
            opacity: 0.8;
        }

        .navbar-menu button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1rem;
            transition: opacity 0.3s;
        }

        .navbar-menu button:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
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

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #2c5f2d;
            color: white;
        }

        .btn-primary:hover {
            background-color: #234a24;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: #2c5f2d;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table th,
        table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #f8f9fa;
        }

        .pagination .active {
            background-color: #2c5f2d;
            color: white;
            border-color: #2c5f2d;
        }

        .grid {
            display: grid;
            gap: 1.5rem;
        }

        .grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .grid-3 {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .grid-4 {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .text-center {
            text-align: center;
        }

        .mt-1 {
            margin-top: 0.5rem;
        }

        .mt-2 {
            margin-top: 1rem;
        }

        .mt-3 {
            margin-top: 1.5rem;
        }

        .mb-1 {
            margin-bottom: 0.5rem;
        }

        .mb-2 {
            margin-bottom: 1rem;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="navbar-brand">Sagip Taal Lake</a>
            <ul class="navbar-menu">
                @guest
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                @if(auth()->user()->is_admin)
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.events.index') }}">Events</a></li>
                <li><a href="{{ route('admin.badges.index') }}">Badges</a></li>
                @else
                <li><a href="{{ route('user.events.index') }}">Events</a></li>
                <li><a href="{{ route('user.events.my-events') }}">My Events</a></li>
                <li><a href="{{ route('user.badges.index') }}">My Badges</a></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container">
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
</body>

</html>