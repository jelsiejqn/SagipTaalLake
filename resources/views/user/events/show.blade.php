@extends('layouts.public')

@section('title', $event->title)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Events.css') }}">
<style>
    .event-detail-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 2rem;
    }

    .back-link {
        color: #2c5f2d;
        text-decoration: none;
        margin-bottom: 1.5rem;
        display: inline-block;
        font-weight: 500;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .modal-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .modal-image img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .modal-details h2 {
        margin-bottom: 1rem;
        color: #2c5f2d;
    }

    .modal-description {
        margin-bottom: 1.5rem;
        line-height: 1.8;
        color: #666;
    }

    .modal-datetime {
        margin-bottom: 1.5rem;
    }

    .modal-datetime p {
        margin-bottom: 0.5rem;
        color: #333;
    }

    .volunteer-button, .cancel-button {
        background-color: #28a745;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
    }

    .volunteer-button:hover {
        background-color: #218838;
    }

    .cancel-button {
        background-color: #dc3545;
        margin-left: 10px;
    }

    .cancel-button:hover {
        background-color: #c82333;
    }

    .joined-badge {
        background-color: #6c757d;
        color: white;
        padding: 12px 24px;
        border-radius: 4px;
        display: inline-block;
    }

    @media (max-width: 768px) {
        .modal-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="event-detail-container">
    <a href="{{ route('user.events.index') }}" class="back-link">&larr; Back to Events</a>

    <div class="modal-grid">
        <div class="modal-image">
            @if($event->image)
            <img src="{{ $event->image }}" alt="{{ $event->title }}" />
            @else
            <img src="{{ asset('images/sample1.png') }}" alt="{{ $event->title }}" />
            @endif
        </div>
        <div class="modal-details">
            <h2>{{ $event->title }}</h2>
            <p class="modal-description">{{ $event->description }}</p>
            <div class="modal-datetime">
                <p><strong>Date:</strong> {{ $event->event_date->format('l, F d, Y') }}</p>
                <p><strong>Time:</strong> {{ $event->event_date->format('h:i A') }}</p>
                <p><strong>Location:</strong> {{ $event->location }}</p>
                <p><strong>Volunteers:</strong> {{ $volunteersCount }}@if($event->max_volunteers) / {{ $event->max_volunteers }}@endif</p>
            </div>

            <div class="modal-buttons">
                @auth
                    @if($isJoined)
                        <span class="joined-badge">✓ You have joined this event</span>
                        <form method="POST" action="{{ route('user.events.cancel', $event) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="cancel-button" onclick="return confirm('Are you sure you want to cancel your registration?')">
                                Cancel Registration
                            </button>
                        </form>
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
                    <a href="{{ route('login') }}" class="volunteer-button" style="text-decoration: none; display: inline-block;">Login to Join</a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection