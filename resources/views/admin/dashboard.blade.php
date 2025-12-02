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

<!-- Recent Events Section -->
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

<!-- FAQs Section -->
<div class="content-card" style="margin-top: 30px;">
    <div class="content-card-header">
        <h2>Frequently Asked Questions</h2>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Add New FAQ</a>
    </div>

    @if(isset($recentFaqs) && $recentFaqs->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Order</th>
                <th>Question</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentFaqs as $faq)
            <tr>
                <td>{{ $faq->display_order }}</td>
                <td>{{ Str::limit($faq->question, 60) }}</td>
                <td>
                    <span class="badge {{ $faq->is_active ? 'badge-success' : 'badge-secondary' }}">
                        {{ $faq->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.faqs.show', $faq) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-primary btn-sm">Edit</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @else
    <div class="no-data">
        <p>No FAQs created yet.</p>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Create your first FAQ</a>
    </div>
    @endif
</div>

<style>
.btn-group {
    display: flex;
    gap: 5px;
}
.badge {
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}
.badge-success {
    background-color: #28a745;
    color: white;
}
.badge-secondary {
    background-color: #6c757d;
    color: white;
}
</style>
@endsection