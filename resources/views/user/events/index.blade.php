@extends('layouts.public')

@section('title', 'All Events')

@push('styles')
<style>
    body {
        background: url("{{ asset('images/BG2.jpg') }}") no-repeat center center fixed;
        background-size: cover;
    }

    .events-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .events-title {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 30px;
        color: #486848ff;
        /* olive green */
    }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
    }

    /* Polaroid Card */
    .event-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.25s, box-shadow 0.25s;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    /* Polaroid wrapper */
    .polaroid {
        background: white;
        padding: 12px 12px 25px 12px;
        /* thicker bottom */
        display: flex;
        flex-direction: column;
        height: 100%;
        border-radius: 12px;
    }

    /* Image area */
    .polaroid-image {
        width: 100%;
        height: 200px;
        background: #fff;
        border-radius: 6px;
        overflow: hidden;
        margin-bottom: 12px;
        /* spacing like a real polaroid */
    }

    .polaroid-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0;
        /* remove rounded edges */
        transition: transform 0.3s;
    }

    .polaroid-image img:hover {
        transform: scale(1.05);
    }

    /* Content text */
    .polaroid-content {
        padding: 0 5px;
        /* small subtle padding */
        display: flex;
        flex-direction: column;
    }


    .event-date {
        font-size: 0.85rem;
        font-weight: 600;
        color: #60856cff;
        /* lighter olive green */
    }

    /* No events message */
    .no-events-message {
        text-align: center;
        padding: 50px 20px;
        color: #486848ff;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .polaroid-content h3 {
            font-size: 1rem;
        }

        .polaroid-content p {
            font-size: 0.9rem;
        }

        .event-date {
            font-size: 0.8rem;
        }
    }
</style>
@endpush

@section('content')

<br> <br> <br>
<br>
<div class="events-container">
    <h1 class="events-title">Upcoming Events</h1>

    @if($upcomingEvents->count() > 0)
    <div class="events-grid">
        @foreach($upcomingEvents as $event)
        <div class="event-card" onclick="window.location='{{ route('user.events.show', $event) }}'" style="cursor: pointer;">
            <div class="polaroid">
                <div class="polaroid-image">
                    @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" />
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
<br> <br> <br>
<br>
@endsection