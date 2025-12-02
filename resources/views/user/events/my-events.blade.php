@extends('layouts.public')


@section('title', 'My Events')

@push('styles')


<!-- MY EVENTS PAGE STYLING (HORIZONTAL CARDS) -->
<style>
    body {
        background: url("{{ asset('images/BG2.jpg') }}") no-repeat center center fixed;
        background-size: cover;
    }

    .events-container {
        max-width: 1200px;
        margin: 120px auto 40px auto;
        /* space for fixed navbar */
        padding: 10px 20px;
    }

    h1 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 30px;
        color: #486848ff;
    }

    .events-section {
        margin-bottom: 3rem;
    }

    .section-container {
        background: #fff;
        border-radius: 30px;
        padding: 25px 20px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .section-title.joined,
    .section-title.past {
        color: #2c5f2d;
    }

    .section-title.cancelled {
        color: #dc3545;
    }

    /* Horizontal Cards */
    .event-card {
        display: flex;
        gap: 20px;
        background: white;
        border-radius: 25px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        padding: 15px;
        transition: 0.25s;
        margin-bottom: 20px;
    }

    .event-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .polaroid-image img {
        width: 180px;
        height: 140px;
        object-fit: cover;
        border-radius: 20px;
    }

    .event-info {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .event-info h3 {
        margin: 0;
        color: #486848ff;
    }

    .event-date,
    .event-location {
        font-size: 0.9rem;
        color: #555;
    }

    .event-actions {
        margin-top: 10px;
        display: flex;
        gap: 8px;
    }

    .btn-view {
        background: #2c5f2d;
        color: white;
        padding: 7px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        text-decoration: none;
    }

    .btn-cancel {
        background-color: #ffc107;
        border: none;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
        cursor: pointer;
    }

    .badge-earned {
        font-weight: bold;
        color: #2c5f2d;
    }

    .badge-cancelled {
        font-weight: bold;
        color: #dc3545;
    }

    .no-events-message {
        text-align: center;
        padding: 40px 20px;
        color: #486848ff;
    }

    @media (max-width: 768px) {
        .event-card {
            flex-direction: column;
            text-align: center;
        }

        .polaroid-image img {
            width: 100%;
            height: 180px;
        }

        .event-info {
            align-items: center;
        }
    }
</style>
@endpush


@section('content')

<div class="events-container">
    <h1>My Events</h1>

    <!-- JOINED EVENTS -->
    <div class="events-section">
        <div class="section-container">
            <h2 class="section-title joined">Joined Events</h2>

            @if($joinedEvents->count() > 0)
            @foreach($joinedEvents as $event)
            <div class="event-card" onclick="window.location='{{ route('user.events.show', $event) }}'">

                <div class="polaroid-image">
                    <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/sample1.png') }}">
                </div>

                <div class="event-info">
                    <h3>{{ $event->title }}</h3>
                    <span class="event-date">{{ $event->event_date->format('M d, Y h:i A') }}</span>
                    <span class="event-location">{{ $event->location }}</span>

                    <div class="event-actions">
                        <a href="{{ route('user.events.show', $event) }}" class="btn-view">View</a>

                        <form method="POST" action="{{ route('user.events.cancel', $event) }}">
                            @csrf
                            <button class="btn-cancel" onclick="return confirm('Cancel this event?')">Cancel</button>
                        </form>
                    </div>
                </div>

            </div>
            @endforeach
            @else
            <div class="no-events-message">You haven't joined any events yet.</div>
            @endif
        </div>
    </div>

    <!-- PAST EVENTS -->
    <div class="events-section">
        <div class="section-container">
            <h2 class="section-title past">Past Events (Completed)</h2>

            @if($pastEvents->count() > 0)
            @foreach($pastEvents as $event)
            <div class="event-card">

                <div class="polaroid-image">
                    <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/sample1.png') }}">
                </div>

                <div class="event-info">
                    <h3>{{ $event->title }}</h3>
                    <span class="event-date">{{ $event->event_date->format('M d, Y h:i A') }}</span>
                    <span class="event-location">{{ $event->location }}</span>

                    <span class="badge-earned">
                        @if($event->badge)
                        ✓ {{ $event->badge->name }}
                        @else
                        No badge
                        @endif
                    </span>
                </div>

            </div>
            @endforeach
            @else
            <div class="no-events-message">No completed events yet.</div>
            @endif
        </div>
    </div>

    <!-- CANCELLED EVENTS -->
    <div class="events-section">
        <div class="section-container">
            <h2 class="section-title cancelled">Cancelled Events</h2>

            @if($cancelledEvents->count() > 0)
            @foreach($cancelledEvents as $event)
            <div class="event-card">

                <div class="polaroid-image">
                    <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/sample1.png') }}">
                </div>

                <div class="event-info">
                    <h3>{{ $event->title }}</h3>
                    <span class="event-date">{{ $event->event_date->format('M d, Y h:i A') }}</span>
                    <span class="event-location">{{ $event->location }}</span>

                    <span class="badge-cancelled">Cancelled</span>
                </div>

            </div>
            @endforeach
            @else
            <div class="no-events-message">No cancelled events.</div>
            @endif
        </div>
    </div>

</div>

@endsection