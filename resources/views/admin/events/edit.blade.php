@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div style="margin-bottom: 1rem;">
    <a href="{{ route('admin.events.index') }}" style="color: #2c5f2d; text-decoration: none;">&larr; Back to Events</a>
</div>

<div class="card">
    <h1 style="margin-bottom: 1.5rem;">Edit Event</h1>

    <form method="POST" action="{{ route('admin.events.update', $event) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Event Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
            @error('title')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" required>{{ old('description', $event->description) }}</textarea>
            @error('description')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="event_date">Event Date & Time</label>
            <input type="datetime-local" id="event_date" name="event_date" class="form-control" value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required>
            @error('event_date')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $event->location) }}" required>
            @error('location')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="max_volunteers">Maximum Volunteers (Optional)</label>
            <input type="number" id="max_volunteers" name="max_volunteers" class="form-control" value="{{ old('max_volunteers', $event->max_volunteers) }}" min="1">
            @error('max_volunteers')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="badge_id">Assign Badge (Optional)</label>
            <select id="badge_id" name="badge_id" class="form-control">
                <option value="">No Badge</option>
                @foreach($badges as $badge)
                <option value="{{ $badge->id }}" {{ old('badge_id', $event->badge_id) == $badge->id ? 'selected' : '' }}>
                    {{ $badge->name }}
                </option>
                @endforeach
            </select>
            @error('badge_id')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">Update Event</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection