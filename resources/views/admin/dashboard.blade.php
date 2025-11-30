@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h1 style="margin-bottom: 1.5rem;">Admin Dashboard</h1>

<div class="grid grid-4" style="margin-bottom: 2rem;">
    <div class="card" style="text-align: center;">
        <h3 style="font-size: 2.5rem; color: #2c5f2d; margin-bottom: 0.5rem;">{{ $totalEvents }}</h3>
        <p style="color: #666;">Total Events</p>
    </div>
    <div class="card" style="text-align: center;">
        <h3 style="font-size: 2.5rem; color: #2c5f2d; margin-bottom: 0.5rem;">{{ $upcomingEvents }}</h3>
        <p style="color: #666;">Upcoming Events</p>
    </div>
    <div class="card" style="text-align: center;">
        <h3 style="font-size: 2.5rem; color: #2c5f2d; margin-bottom: 0.5rem;">{{ $totalVolunteers }}</h3>
        <p style="color: #666;">Total Volunteers</p>
    </div>
    <div class="card" style="text-align: center;">
        <h3 style="font-size: 2.5rem; color: #2c5f2d; margin-bottom: 0.5rem;">{{ $totalBadges }}</h3>
        <p style="color: #666;">Total Badges</p>
    </div>
</div>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h2>Recent Events</h2>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Create New Event</a>
    </div>

    @if($recentEvents->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Volunteers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentEvents as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->event_date->format('M d, Y') }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->joinedUsers()->count() }}</td>
                <td>
                    <a href="{{ route('admin.events.show', $event) }}" class="btn btn-primary" style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="text-align: center; color: #666; padding: 2rem 0;">No events created yet.</p>
    @endif
</div>
@endsection