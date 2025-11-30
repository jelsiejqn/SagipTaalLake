@extends('layouts.app')

@section('title', 'Event Details')

@section('content')
<div style="margin-bottom: 1rem;">
    <a href="{{ route('admin.events.index') }}" style="color: #2c5f2d; text-decoration: none;">&larr; Back to Events</a>
</div>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1.5rem;">
        <div>
            <h1 style="margin-bottom: 0.5rem;">{{ $event->title }}</h1>
            <p style="color: #666;">Created: {{ $event->created_at->format('M d, Y') }}</p>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-secondary">Edit Event</a>
            <form method="POST" action="{{ route('admin.events.destroy', $event) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete Event</button>
            </form>
        </div>
    </div>

    <div style="margin-bottom: 2rem;">
        <h3 style="margin-bottom: 0.5rem;">Event Details</h3>
        <p style="margin-bottom: 0.5rem;"><strong>Date & Time:</strong> {{ $event->event_date->format('l, F d, Y \a\t h:i A') }}</p>
        <p style="margin-bottom: 0.5rem;"><strong>Location:</strong> {{ $event->location }}</p>
        <p style="margin-bottom: 0.5rem;"><strong>Maximum Volunteers:</strong> {{ $event->max_volunteers ?? 'Unlimited' }}</p>
        @if($event->badge)
        <p style="margin-bottom: 0.5rem;"><strong>Badge Reward:</strong> {{ $event->badge->name }}</p>
        @endif
    </div>

    <div style="margin-bottom: 2rem;">
        <h3 style="margin-bottom: 0.5rem;">Description</h3>
        <p style="line-height: 1.8;">{{ $event->description }}</p>
    </div>

    <div>
        <h3 style="margin-bottom: 1rem;">Registered Volunteers ({{ $volunteers->count() }})</h3>
        @if($volunteers->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Registered Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($volunteers as $volunteer)
                <tr>
                    <td>{{ $volunteer->name }}</td>
                    <td>{{ $volunteer->email }}</td>
                    <td>
                        @if($volunteer->pivot->status == 'joined')
                        <span style="color: #2c5f2d; font-weight: bold;">Joined</span>
                        @elseif($volunteer->pivot->status == 'cancelled')
                        <span style="color: #dc3545; font-weight: bold;">Cancelled</span>
                        @else
                        <span style="color: #6c757d; font-weight: bold;">{{ ucfirst($volunteer->pivot->status) }}</span>
                        @endif
                    </td>
                    <td>{{ $volunteer->pivot->created_at->format('M d, Y h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p style="text-align: center; color: #666; padding: 2rem 0;">No volunteers have registered yet.</p>
        @endif
    </div>
</div>
@endsection