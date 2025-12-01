@extends('layouts.public')

@section('title', 'All Events')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Events.css') }}">
@endpush

@section('content')
<div class="events-container">
    <h1 class="events-title">Upcoming Events</h1>

    @if($upcomingEvents->count() > 0)
    <div class="events-grid">
        @foreach($upcomingEvents as $event)
        <div class="event-card" onclick="window.location='{{ route('user.events.show', $event) }}'" style="cursor: pointer;">
            <div class="polaroid">
                <div class="polaroid-image">
                    @if($event->image)
                    <img src="{{ $event->image }}" alt="{{ $event->title }}" />
                    @else
                    <img src="{{ asset('images/sample1.png') }}" alt="{{ $event->title }}" />
                    @endif
                </div>
                <div class="polaroid-content">
                    <h3>{{ $event->title }}</h3>
                    <p>{{ Str::limit($event->description, 80) }}</p>
                    <span class="event-date">{{ $event->event_date->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="no-events-message">
        <h2>No upcoming events</h2>
        <p>Check back soon for new events!</p>
    </div>
    @endif
</div>
@endsection