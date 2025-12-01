@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="admin-header">
    <h1>Admin Dashboard</h1>
    <p>Welcome back! Here's what's happening with your organization.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number">{{ $totalEvents }}</div>
        <div class="stat-label">Total Events</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $upcomingEvents }}</div>
        <div class="stat-label">Upcoming Events</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $totalVolunteers }}</div>
        <div class="stat-label">Total Volunteers</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $totalBadges }}</div>
        <div class="stat-label">Total Badges</div>
    </div>
</div>

<div class="content-card">
    <div class="content-card-header">
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
                    <a href="{{ route('admin.events.show', $event) }}" class="btn btn-primary btn-sm">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">No events created yet.</div>
    @endif
</div>
@endsection