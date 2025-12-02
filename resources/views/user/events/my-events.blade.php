@extends('layouts.public') <!-- Consistent navbar -->

@section('title', 'My Events')

@section('content')
<br> <br> <br>
<br>
<div class="events-container">
    <h1 class="events-title">My Events</h1>

    <!-- Joined Events -->
    <div class="events-section">
        <div class="section-container">
            <h2 class="section-title joined">Joined Events</h2>
            @if($joinedEvents->count() > 0)
            <div class="events-grid">
                @foreach($joinedEvents as $event)
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
                            <span class="event-date">{{ $event->event_date->format('M d, Y h:i A') }}</span>
                            <div class="event-actions">
                                <form method="POST" action="{{ route('user.events.cancel', $event) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-cancel" onclick="return confirm('Are you sure?')">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-events-message">
                <h2>No joined events yet.</h2>
            </div>
            @endif
        </div>
    </div>

    <!-- Past Events -->
    <div class="events-section">
        <div class="section-container">
            <h2 class="section-title past">Past Events (Completed)</h2>
            @if($pastEvents->count() > 0)
            <div class="events-grid">
                @foreach($pastEvents as $event)
                <div class="event-card">
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
                            <span class="event-date">{{ $event->event_date->format('M d, Y h:i A') }}</span>
                            <span class="badge-earned">
                                @if($event->badge)
                                ✓ {{ $event->badge->name }}
                                @else
                                No badge
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-events-message">
                <h2>No completed events yet.</h2>
            </div>
            @endif
        </div>
    </div>

    <!-- Cancelled Events -->
    <div class="events-section">
        <div class="section-container">
            <h2 class="section-title cancelled">Cancelled Events</h2>
            @if($cancelledEvents->count() > 0)
            <div class="events-grid">
                @foreach($cancelledEvents as $event)
                <div class="event-card">
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
                            <span class="event-date">{{ $event->event_date->format('M d, Y h:i A') }}</span>
                            <span class="badge-cancelled">Cancelled</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-events-message">
                <h2>No cancelled events.</h2>
            </div>
            @endif
        </div>
    </div>
</div>

<br> <br> <br>
<br> <br>

<style>
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

    .events-section {
        margin-bottom: 3rem;
    }

    .section-container {
        background: #fff;
        border-radius: 40px;
        padding: 25px 20px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    .section-title.joined,
    .section-title.past {
        color: #2c5f2d;
    }

    .section-title.cancelled {
        color: #dc3545;
    }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .event-card {
        background: white;
        border-radius: 30px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.25s, box-shadow 0.25s;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .polaroid {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .polaroid-image {
        height: 200px;
        overflow: hidden;
    }

    .polaroid-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 30px 30px 0 0;
        transition: transform 0.3s;
    }

    .polaroid-image img:hover {
        transform: scale(1.05);
    }

    .polaroid-content {
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .polaroid-content h3 {
        margin: 0 0 10px 0;
        font-size: 1.2rem;
        color: #486848ff;
    }

    .polaroid-content p {
        margin: 0 0 10px 0;
        font-size: 0.95rem;
        color: #555;
    }

    .event-date {
        font-size: 0.85rem;
        font-weight: 600;
        color: #60856cff;
        margin-bottom: 10px;
    }

    .event-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .btn-cancel {
        background-color: #ffc107;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        color: #000;
        cursor: pointer;
        font-size: 0.85rem;
        transition: background 0.3s;
    }

    .btn-cancel:hover {
        background-color: #e0a800;
    }

    .badge-earned {
        color: #2c5f2d;
        font-weight: bold;
    }

    .badge-cancelled {
        color: #dc3545;
        font-weight: bold;
    }

    .no-events-message {
        text-align: center;
        padding: 50px 20px;
        color: #486848ff;
    }

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
@endsection