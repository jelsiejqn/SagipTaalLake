@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="max-width: 500px; margin: 2rem auto;">
    <div class="card">
        <h2 style="margin-bottom: 1.5rem; text-align: center;">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
        </form>

        <p style="text-align: center; margin-top: 1rem;">
            Don't have an account? <a href="{{ route('register') }}" style="color: #2c5f2d;">Register here</a>
        </p>
    </div>
</div>
@endsection