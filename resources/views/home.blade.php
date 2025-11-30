@extends('layouts.app')

@section('title', 'Home - Sagip Taal Lake')

@section('content')
<div class="card">
    <h1 style="color: #2c5f2d; margin-bottom: 1rem;">Welcome to Sagip Taal Lake</h1>
    <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
        Join us in our mission to protect and preserve Taal Lake. Volunteer for environmental events and make a difference!
    </p>

    @guest
    <div style="display: flex; gap: 1rem;">
        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
        <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
    </div>
    @else
    <a href="{{ route('user.events.index') }}" class="btn btn-primary">View All Events</a>
    @endguest
</div>

@if($upcomingEvents->count() > 0)
<h2 style="margin-top: 2rem; margin-bottom: 1rem;">Upcoming Events</h2>
<div class="grid grid-3">
    @foreach($upcomingEvents as $event)
    <div class="card">
        <h3 style="margin-bottom: 0.5rem;">{{ $event->title }}</h3>
        <p style="color: #666; margin-bottom: 0.5rem;">
            <strong>Date:</strong> {{ $event->event_date->format('M d, Y h:i A') }}
        </p>
        <p style="color: #666; margin-bottom: 1rem;">
            <strong>Location:</strong> {{ $event->location }}
        </p>
        <p style="margin-bottom: 1rem;">{{ Str::limit($event->description, 100) }}</p>
        @auth
        <a href="{{ route('user.events.show', $event) }}" class="btn btn-primary">View Details</a>
        @else
        <a href="{{ route('login') }}" class="btn btn-primary">Login to Join</a>
        @endauth
    </div>
    @endforeach
</div>
@endif
@endsection