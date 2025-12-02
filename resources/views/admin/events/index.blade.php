@extends('layouts.admin')

@section('title', 'Manage Events')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h1>Manage Events</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Create New Event</a>
</div>

<div class="card">
    @if($events->count() > 0)
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Volunteers</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <!-- IMAGE -->
                <td style="padding: 0.5rem; text-align: center;">
                    @if($event->image)
                        <img src="{{ asset('storage/'.$event->image) }}" 
                             alt="{{ $event->title }}" 
                             style="height: 50px; width: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc;">
                    @else
                        <span style="color: #777; font-size: 0.85rem;">No image</span>
                    @endif
                </td>

                <!-- TITLE -->
                <td>{{ $event->title }}</td>

                <!-- DATE -->
                <td>{{ $event->event_date->format('M d, Y h:i A') }}</td>

                <!-- LOCATION -->
                <td>{{ $event->location }}</td>

                <!-- VOLUNTEERS -->
                <td>{{ $event->joinedUsers()->count() }}</td>

                <!-- ACTIONS -->
                <td style="text-align: center;">
                    <a href="{{ route('admin.events.show', $event) }}" 
                       class="btn btn-primary" 
                       style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">
                       View
                    </a>

                    <a href="{{ route('admin.events.edit', $event) }}" 
                       class="btn btn-secondary" 
                       style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">
                       Edit
                    </a>

                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" 
                                class="btn btn-danger"
                                style="
                                    background-color: #e63946; 
                                    border: none; 
                                    color: white; 
                                    font-size: 0.875rem; 
                                    padding: 0.375rem 0.75rem; 
                                    border-radius: 6px;
                                    cursor: pointer;
                                "
                                onmouseover="this.style.backgroundColor='#c71c2b'"
                                onmouseout="this.style.backgroundColor='#e63946'"
                                onclick="return confirm('Are you sure you want to delete this event?')">
                            Delete
                        </button>
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
@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h1>Manage Events</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Create New Event</a>
</div>

<div class="card">
    @if($events->count() > 0)
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Volunteers</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <!-- IMAGE -->
                <td style="padding: 0.5rem; text-align: center;">
                    @if($event->image)
                        <img src="{{ asset('storage/'.$event->image) }}" 
                             alt="{{ $event->title }}" 
                             style="height: 50px; width: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc;">
                    @else
                        <span style="color: #777; font-size: 0.85rem;">No image</span>
                    @endif
                </td>

                <!-- TITLE -->
                <td>{{ $event->title }}</td>

                <!-- DATE -->
                <td>{{ $event->event_date->format('M d, Y h:i A') }}</td>

                <!-- LOCATION -->
                <td>{{ $event->location }}</td>

                <!-- VOLUNTEERS -->
                <td>{{ $event->joinedUsers()->count() }}</td>

                <!-- ACTIONS -->
                <td style="text-align: center;">
                    <a href="{{ route('admin.events.show', $event) }}" 
                       class="btn btn-primary" 
                       style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">
                       View
                    </a>

                    <a href="{{ route('admin.events.edit', $event) }}" 
                       class="btn btn-secondary" 
                       style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">
                       Edit
                    </a>

                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" 
                                class="btn btn-danger"
                                style="
                                    background-color: #e63946; 
                                    border: none; 
                                    color: white; 
                                    font-size: 0.875rem; 
                                    padding: 0.375rem 0.75rem; 
                                    border-radius: 6px;
                                    cursor: pointer;
                                "
                                onmouseover="this.style.backgroundColor='#c71c2b'"
                                onmouseout="this.style.backgroundColor='#e63946'"
                                onclick="return confirm('Are you sure you want to delete this event?')">
                            Delete
                        </button>
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

