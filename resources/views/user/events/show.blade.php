@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div style="margin-bottom: 1rem;">
    <a href="{{ route('user.events.index') }}" style="color: #2c5f2d; text-decoration: none;">&larr; Back to Events</a>
</div>

<div class="card">
    <h1 style="margin-bottom: 1rem;">{{ $event->title }}</h1>

    <div style="margin-bottom: 1.5rem;">
        <p style="margin-bottom: 0.5rem;">
            <strong>Date & Time:</strong> {{ $event->event_date->format('l, F d, Y \a\t h:i A') }}
        </p>
        <p style="margin-bottom: 0.5rem;">
            <strong>Location:</strong> {{ $event->location }}
        </p>
        <p style="margin-bottom: 0.5rem;">
            <strong>Volunteers Joined:</strong> {{ $volunteersCount }}
            @if($event->max_volunteers)
            / {{ $event->max_volunteers }}
            @endif
        </p>
        @if($event->badge)
        <p style="margin-bottom: 0.5rem;">
            <strong>Reward Badge:</strong> {{ $event->badge->name }}
            @if($event->badge->description)
            - {{ $event->badge->description }}
            @endif
        </p>
        @endif
    </div>

    <div style="margin-bottom: 1.5rem;">
        <h3 style="margin-bottom: 0.5rem;">Description</h3>
        <p style="line-height: 1.8;">{{ $event->description }}</p>
    </div>

    <div style="display: flex; gap: 1rem;">
        @if($isJoined)
        <span class="btn btn-secondary" style="cursor: default;">You have joined this event</span>
        <form method="POST" action="{{ route('user.events.cancel', $event) }}">
            @csrf
            <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to cancel your registration?')">
                Cancel Registration
            </button>
        </form>
        @else
        @if($event->max_volunteers && $volunteersCount >= $event->max_volunteers)
        <span class="btn btn-secondary" style="cursor: default;">Event Full</span>
        @else
        <form method="POST" action="{{ route('user.events.join', $event) }}">
            @csrf
            <button type="submit" class="btn btn-primary">Join This Event</button>
        </form>
        @endif
        @endif
    </div>
</div>
@endsection