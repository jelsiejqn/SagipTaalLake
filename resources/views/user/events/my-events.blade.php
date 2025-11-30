@extends('layouts.app')

@section('title', 'My Events')

@section('content')
<h1 style="margin-bottom: 1.5rem;">My Events</h1>

<div class="card">
    <h2 style="margin-bottom: 1rem; color: #2c5f2d;">Joined Events</h2>
    @if($joinedEvents->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Event Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($joinedEvents as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->event_date->format('M d, Y h:i A') }}</td>
                <td>{{ $event->location }}</td>
                <td>
                    <a href="{{ route('user.events.show', $event) }}" class="btn btn-primary" style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">View</a>
                    <form method="POST" action="{{ route('user.events.cancel', $event) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning" style="font-size: 0.875rem; padding: 0.375rem 0.75rem;" onclick="return confirm('Are you sure?')">Cancel</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="color: #666; text-align: center; padding: 2rem 0;">You haven't joined any events yet.</p>
    @endif
</div>

<div class="card" style="margin-top: 2rem;">
    <h2 style="margin-bottom: 1rem; color: #2c5f2d;">Past Events (Completed)</h2>
    @if($pastEvents->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Event Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Badge Earned</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pastEvents as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->event_date->format('M d, Y h:i A') }}</td>
                <td>{{ $event->location }}</td>
                <td>
                    @if($event->badge)
                    <span style="color: #2c5f2d; font-weight: bold;">✓ {{ $event->badge->name }}</span>
                    @else
                    <span style="color: #666;">No badge</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="color: #666; text-align: center; padding: 2rem 0;">No completed events yet.</p>
    @endif
</div>

<div class="card" style="margin-top: 2rem;">
    <h2 style="margin-bottom: 1rem; color: #dc3545;">Cancelled Events</h2>
    @if($cancelledEvents->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Event Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cancelledEvents as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->event_date->format('M d, Y h:i A') }}</td>
                <td>{{ $event->location }}</td>
                <td><span style="color: #dc3545;">Cancelled</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="color: #666; text-align: center; padding: 2rem 0;">No cancelled events.</p>
    @endif
</div>
@endsection