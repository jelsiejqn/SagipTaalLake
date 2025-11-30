@extends('layouts.app')

@section('title', 'All Events')

@section('content')
<h1 style="margin-bottom: 1.5rem;">Upcoming Events</h1>

@if($upcomingEvents->count() > 0)
<div class="grid grid-3">
    @foreach($upcomingEvents as $event)
    <div class="card">
        <h3 style="margin-bottom: 0.5rem;">{{ $event->title }}</h3>
        <p style="color: #666; margin-bottom: 0.5rem;">
            <strong>Date:</strong> {{ $event->event_date->format('M d, Y h:i A') }}
        </p>
        <p style="color: #666; margin-bottom: 0.5rem;">
            <strong>Location:</strong> {{ $event->location }}
        </p>
        @if($event->badge)
        <p style="color: #2c5f2d; margin-bottom: 0.5rem;">
            <strong>Badge:</strong> {{ $event->badge->name }}
        </p>
        @endif
        <p style="margin-bottom: 1rem;">{{ Str::limit($event->description, 120) }}</p>

        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('user.events.show', $event) }}" class="btn btn-primary">View Details</a>

            @if(in_array($event->id, $userEventIds))
            <span class="btn btn-secondary" style="cursor: default;">Joined</span>
            @else
            <form method="POST" action="{{ route('user.events.join', $event) }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-primary">Join Event</button>
            </form>
            @endif
        </div>
    </div>
    @endforeach
</div>
@else
<div class="card">
    <p style="text-align: center; color: #666;">No upcoming events at the moment. Check back later!</p>
</div>
@endif
@endsection