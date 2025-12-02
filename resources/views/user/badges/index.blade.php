@extends('layouts.public')

@section('title', 'My Badges')

@push('styles')
<style>
    body {
        background: url("{{ asset('images/BG2.jpg') }}") no-repeat center center fixed;
        background-size: cover;
    }

    .badges-container {
        max-width: 1100px;
        margin: 120px auto 40px auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #486848ff;
        font-size: 2rem;
        margin-bottom: 2rem;
    }

    .grid-4 {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 25px;
    }

    .card {
        background: #ffffff;
        border-radius: 25px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        transition: 0.25s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .badge-icon {
        font-size: 3.2rem;
        margin-bottom: 1rem;
        display: block;
    }

    .badge-name {
        font-size: 1.2rem;
        font-weight: bold;
        color: #486848ff;
        margin-bottom: 0.5rem;
    }

    .badge-description {
        color: #555;
        font-size: 0.9rem;
        margin-bottom: 0.8rem;
    }

    .badge-earned {
        color: #2c5f2d;
        font-weight: bold;
        font-size: 0.85rem;
    }

    .empty-card {
        padding: 2rem;
        background: #ffffff;
        border-radius: 25px;
        text-align: center;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .browse-btn {
        display: inline-block;
        background: #486848ff;
        color: white;
        padding: 10px 18px;
        border-radius: 18px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 1rem;
        transition: 0.2s;
    }

    .browse-btn:hover {
        background: #60856cff;
    }
</style>
@endpush

@section('content')

<div class="badges-container">

    <h1>My Badges</h1>

    @if($badges->count() > 0)
    <div class="grid-4">
        @foreach($badges as $badge)
        <div class="card">

            <span class="badge-icon">
                @if($badge->icon)
                {{ $badge->icon }}
                @else
                🏆
                @endif
            </span>

            <h3 class="badge-name">{{ $badge->name }}</h3>

            @if($badge->description)
            <p class="badge-description">{{ $badge->description }}</p>
            @endif

            <p class="badge-earned">
                ✓ Earned: {{ \Carbon\Carbon::parse($badge->pivot->earned_at)->format('M d, Y') }}
            </p>

        </div>
        @endforeach
    </div>

    @else

    <div class="empty-card">
        <p style="color: #666; font-size: 1rem;">
            You haven't earned any badges yet. Complete events to earn badges!
        </p>

        <a href="{{ route('user.events.index') }}" class="browse-btn">
            Browse Events
        </a>
    </div>

    @endif

</div>

@endsection