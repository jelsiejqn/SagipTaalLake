@extends('layouts.app')

@section('title', 'My Badges')

@section('content')
<h1 style="margin-bottom: 1.5rem;">My Badges</h1>

@if($badges->count() > 0)
<div class="grid grid-4">
    @foreach($badges as $badge)
    <div class="card" style="text-align: center;">
        <div style="font-size: 3rem; margin-bottom: 1rem;">
            @if($badge->icon)
            {{ $badge->icon }}
            @else
            🏆
            @endif
        </div>
        <h3 style="margin-bottom: 0.5rem;">{{ $badge->name }}</h3>
        @if($badge->description)
        <p style="color: #666; font-size: 0.875rem; margin-bottom: 0.5rem;">{{ $badge->description }}</p>
        @endif
        <p style="color: #2c5f2d; font-size: 0.875rem; font-weight: bold;">
            ✓ Earned: {{ \Carbon\Carbon::parse($badge->pivot->earned_at)->format('M d, Y') }}
        </p>
    </div>
    @endforeach
</div>
@else
<div class="card">
    <p style="text-align: center; color: #666; padding: 2rem 0;">
        You haven't earned any badges yet. Complete events to earn badges!
    </p>
    <div style="text-align: center; margin-top: 1rem;">
        <a href="{{ route('user.events.index') }}" class="btn btn-primary">Browse Events</a>
    </div>
</div>
@endif
@endsection