@extends('layouts.public')

@section('title', $event->title)

@push('styles')
<style>
    /* Container */
    .event-detail-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 2rem;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    /* Back Link */
    .back-link {
        color: #486848;
        text-decoration: none;
        margin-bottom: 1.5rem;
        display: inline-block;
        font-weight: 500;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    /* Alerts */
    .alert {
        padding: 1rem;
        margin: 1rem 0;
        border-radius: 8px;
        font-size: 0.95rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
    }

    /* Event Grid */
    .modal-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 1rem;
    }

    @media (max-width: 768px) {
        .modal-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Event Image */
    .modal-image img {
        width: 100%;
        border-radius: 12px;
        object-fit: cover;
    }

    /* Event Details */
    .modal-details h2 {
        margin-bottom: 1rem;
        color: #2c5f2d;
        font-size: 1.75rem;
    }

    .modal-description {
        margin-bottom: 1.5rem;
        line-height: 1.8;
        color: #555;
    }

    .modal-datetime p {
        margin-bottom: 0.5rem;
        color: #333;
        font-weight: 500;
    }

    /* Buttons */
    .volunteer-button,
    .cancel-button {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.95rem;
        cursor: pointer;
        border: none;
        transition: 0.25s;
        display: inline-block;
        text-align: center;
        margin-top: 0.5rem;
    }

    .volunteer-button {
        background-color: #486848;
        color: #fff;
    }

    .volunteer-button:hover {
        background-color: #60856c;
    }

    .cancel-button {
        background-color: #dc3545;
        color: #fff;
        margin-left: 10px;
    }

    .cancel-button:hover {
        background-color: #c82333;
    }

    /* Badges */
    .joined-badge,
    .cancelled-badge {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        display: inline-block;
        margin-top: 0.5rem;
    }

    .joined-badge {
        background-color: #6c757d;
        color: #fff;
    }

    .cancelled-badge {
        background-color: #dc3545;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="event-detail-container">
    <a href="{{ url('/events') }}" class="back-link">&larr; Back to Events</a>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @if(session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    <div class="modal-grid">
        <!-- Event Image -->
        <div class="modal-image">
            <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/sample1.png') }}" alt="{{ $event->title }}">
        </div>

        <!-- Event Details -->
        <div class="modal-details">
            <h2>{{ $event->title }}</h2>
            <p class="modal-description">{{ $event->description }}</p>

            <div class="modal-datetime">
                <p><strong>Date:</strong> {{ $event->event_date->format('l, F d, Y') }}</p>
                <p><strong>Time:</strong> {{ $event->event_date->format('h:i A') }}</p>
                <p><strong>Location:</strong> {{ $event->location }}</p>
                <p><strong>Volunteers:</strong> {{ $volunteersCount }}@if($event->max_volunteers) / {{ $event->max_volunteers }}@endif</p>
            </div>

            <!-- Volunteer Buttons -->
            <div class="modal-buttons">
                @auth
                @if($isJoined)
                <span class="joined-badge">You have joined this event</span>
                <form method="POST" action="{{ route('user.events.cancel', $event) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="cancel-button" onclick="return confirm('Are you sure you want to cancel your registration?')">
                        Cancel Registration
                    </button>
                </form>
                @elseif($isCancelled)
                <span class="cancelled-badge">You cancelled this event</span>
                @if($event->max_volunteers && $volunteersCount >= $event->max_volunteers)
                <p style="margin-top: 0.5rem; color: #666;">Event is now full</p>
                @else
                <form method="POST" action="{{ route('user.events.join', $event) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="volunteer-button">Re-join Event</button>
                </form>
                @endif
                @else
                @if($event->max_volunteers && $volunteersCount >= $event->max_volunteers)
                <span class="joined-badge">Event Full</span>
                @else
                <form method="POST" action="{{ route('user.events.join', $event) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="volunteer-button">Join This Event</button>
                </form>
                @endif
                @endif
                @else
                <a href="{{ route('login') }}" class="volunteer-button">Login to Join</a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection