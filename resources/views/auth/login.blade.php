@extends('layouts.public')

@section('title', 'Login')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Login.css') }}">
@endpush

@section('content')
<div class="login-container">
    <div class="login-form">
        <h2 class="login-title">Login</h2>

        @if($errors->any())
        <p class="error-message">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autofocus
                />
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                />
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <p class="signup-link">
            Don't have an account? <a href="{{ route('register') }}">Sign up</a>
        </p>
    </div>
</div>
@endsection