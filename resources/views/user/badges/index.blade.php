@extends('layouts.public') <!-- Consistent navbar -->

@section('title', 'My Badges')

@section('content')
<br> <br> <br>
<br>

<div class="events-container">
    <h1 class="events-title">My Badges</h1>

    <div class="events-section">
        <div class="section-container">
            @if($badges->count() > 0)
            <div class="events-grid">
                @foreach($badges as $badge)
                <div class="event-card">
                    <div class="polaroid">
                        <div class="polaroid-image" style="display:flex; align-items:center; justify-content:center; font-size: 3rem;">
                            @if($badge->icon)
                            {{ $badge->icon }}
                            @else
                            🏆
                            @endif
                        </div>
                        <div class="polaroid-content" style="text-align:center;">
                            <h3>{{ $badge->name }}</h3>
                            @if($badge->description)
                            <p style="color: #666; font-size: 0.875rem; margin-bottom: 0.5rem;">{{ $badge->description }}</p>
                            @endif
                            <p style="color: #2c5f2d; font-size: 0.875rem;">
                                Earned: {{ $badge->pivot->earned_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-events-message">
                <p>You haven't earned any badges yet. Complete events to earn badges!</p>
                <div style="text-align:center; margin-top:1rem;">
                    <a href="{{ route('user.events.index') }}" class="btn btn-primary">Browse Events</a>
                </div>
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
        height: 150px;
        overflow: hidden;
        border-radius: 30px 30px 0 0;
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
    }
</style>
@endsection