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

    /* Dashboard Header */
    .admin-header {
        margin-bottom: 25px;
    }

    .admin-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .admin-header p {
        font-size: 0.95rem;
        color: #6c757d;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.07);
        border: 1px solid #e6e6e6;
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #2c5f2d;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        margin-top: 5px;
    }

    /* Content Card Section */
    .content-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.07);
        border: 1px solid #e6e6e6;
        margin-bottom: 25px;
    }

    .content-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .content-card-header h2 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c3e50;
    }

    /* Tables */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    table th,
    table td {
        padding: 12px 14px;
        border-bottom: 1px solid #e2e2e2;
    }

    table th {
        background: #f7f9f7;
        text-align: left;
        font-size: 0.9rem;
        color: #2c3e50;
        font-weight: 600;
    }

    table td {
        font-size: 0.9rem;
        color: #4a4a4a;
    }

    tr:hover td {
        background: #f2f7f2;
    }

    /* Buttons */
    .btn {
        padding: 7px 14px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #2c5f2d;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #244d24;
    }

    .btn-info {
        background: #3b82f6;
        color: white;
    }

    .btn-info:hover {
        background: #2563eb;
    }

    .btn-sm {
        padding: 5px 10px;
    }

    /* Badge */
    .badge {
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: white;
    }

    /* Empty state */
    .no-data {
        padding: 20px;
        text-align: center;
        color: #6c757d;
        font-size: 0.95rem;
    }
</style>
@endsection