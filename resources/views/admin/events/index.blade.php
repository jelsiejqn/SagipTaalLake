@extends('layouts.admin')

@section('title', 'Manage Events')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h1>Manage Events</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Create New Event</a>
</div>

<div class="card">
    @if($events->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Badge</th>
                <th>Volunteers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->event_date->format('M d, Y h:i A') }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->badge ? $event->badge->name : 'None' }}</td>
                <td>{{ $event->joinedUsers()->count() }}</td>
                <td>
                    <a href="{{ route('admin.events.show', $event) }}" class="btn btn-primary" style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">View</a>
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-secondary" style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">Edit</a>
                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="font-size: 0.875rem; padding: 0.375rem 0.75rem;" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $events->links() }}
    </div>
    @else
    <p style="text-align: center; color: #666; padding: 2rem 0;">No events found.</p>
    @endif
</div>
@endsection
