@extends('layouts.admin')

@section('title', 'Manage Events')

@section('content')
<div class="admin-header-flex">
    <h1>Manage Events</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Create New Event</a>
</div>

<div class="card table-card">
    @if($events->count() > 0)
    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Volunteers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td class="table-image">
                    @if($event->image)
                    <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
                    @else
                    <span class="no-image">No image</span>
                    @endif
                </td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->event_date->format('M d, Y h:i A') }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->joinedUsers()->count() }}</td>
                <td class="table-actions">
                    <a href="{{ route('admin.events.show', $event) }}" class="btn btn-primary btn-sm">View</a>
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this event?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="custom-pagination">
        <a href="{{ $events->previousPageUrl() }}" class="arrow left" @if($events->onFirstPage()) disabled @endif>&larr;</a>

        <div class="page-numbers">
            @for ($i = 1; $i <= $events->lastPage(); $i++)
                <a href="{{ $events->url($i) }}" class="page @if($i == $events->currentPage()) active @endif">{{ $i }}</a>
                @endfor
        </div>

        <a href="{{ $events->nextPageUrl() }}" class="arrow right" @if($events->currentPage() == $events->lastPage()) disabled @endif>&rarr;</a>
    </div>
    @else
    <p class="no-events-text">No events found.</p>
    @endif
</div>

<style>
    /* Header Flex */
    .admin-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    /* Card */
    .table-card {
        background: #ffffff;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    /* Table */
    .admin-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .admin-table th,
    .admin-table td {
        padding: 0.75rem;
        border-bottom: 1px solid #ddd;
    }

    .admin-table th {
        background-color: #f4f4f4;
        font-weight: 600;
        color: #486848;
    }

    /* Image column */
    .table-image img {
        height: 50px;
        width: 80px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .no-image {
        color: #777;
        font-size: 0.85rem;
    }

    /* Actions */
    .table-actions {
        display: flex;
        gap: 5px;
        justify-content: center;
    }

    .inline-form {
        display: inline;
    }

    /* Buttons */
    .btn-sm {
        font-size: 0.875rem;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #486848;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #60856c;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-danger {
        background-color: #e63946;
        color: #fff;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c71c2b;
    }

    /* No events text */
    .no-events-text {
        text-align: center;
        color: #666;
        padding: 2rem 0;
    }

    /* Custom Pagination */
    .custom-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
        max-width: 100%;
    }

    .custom-pagination .arrow {
        font-size: 1.2rem;
        color: #486848;
        text-decoration: none;
        padding: 0.5rem;
        user-select: none;
    }

    .custom-pagination .arrow[disabled] {
        color: #ccc;
        pointer-events: none;
    }

    .custom-pagination .page-numbers {
        display: flex;
        gap: 0.5rem;
        flex: 1;
        justify-content: center;
    }

    .custom-pagination .page-numbers .page {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        text-decoration: none;
        color: #2c5f2d;
        background: #f0f0f0;
        font-size: 0.875rem;
    }

    .custom-pagination .page-numbers .page.active {
        background: #2c5f2d;
        color: white;
    }

    @media (max-width: 768px) {
        .custom-pagination .page-numbers {
            flex-wrap: wrap;
            gap: 0.3rem;
        }
    }
</style>
@endsection