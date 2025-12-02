@extends('layouts.public')

@section('title', 'Sign Up')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Signup.css') }}">
@endpush

@section('content')
<section class="signup-section">
    <div class="signup-container">
        <h2 class="signup-title">Create your account</h2>
        
        <form class="signup-form" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="name-grid">
                <div>
                    <input
                        type="text"
                        name="name"
                        placeholder="Full Name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                    />
                    @error('name')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    required
                />
                @error('email')
                <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                />
                @error('password')
                <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    required
                />
            </div>

            <button type="submit" class="signup-button">Sign Up</button>
        </form>

        <p style="text-align: center; margin-top: 1rem; color: #666;">
            Already have an account? <a href="{{ route('login') }}" style="color: #2c5f2d; text-decoration: none; font-weight: 500;">Login here</a>
        </p>
    </div>
</section>
@endsection