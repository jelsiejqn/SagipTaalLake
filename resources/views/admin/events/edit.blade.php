@extends('layouts.admin')

@section('title', 'Edit Event')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Events.css') }}">
<style>
    /* Container */
    .edit-event-wrap {
        max-width: 980px;
        margin: 2rem auto;
        padding: 1rem;
    }

    /* Card Header */
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .card-header a {
        color: #2c5f2d;
        text-decoration: none;
        font-weight: 600;
    }

    .card-header a:hover {
        text-decoration: underline;
    }

    .card-header h1 {
        margin: 0;
        font-size: 1.25rem;
        color: #2c5f2d;
    }

    /* Card */
    .card {
        background: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.5rem;
    }

    @media (max-width: 900px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Form Columns */
    .form-column {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    /* Form Row */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 0.75rem;
    }

    @media (max-width: 800px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    /* Labels */
    label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.35rem;
        color: #2c5f2d;
        font-size: 0.95rem;
    }

    /* Inputs and Textareas */
    .form-control {
        width: 100%;
        padding: 0.6rem 0.75rem;
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        font-size: 0.95rem;
        background: #fff;
        box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.02);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* Error messages */
    .error-message {
        color: #c0392b;
        font-size: 0.875rem;
        margin-top: 0.35rem;
    }

    /* Sidebar */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    /* Image preview */
    .image-preview {
        background: #f8f9fa;
        border: 1px dashed #e1e1e1;
        border-radius: 8px;
        padding: 0.75rem;
        text-align: center;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 220px;
        border-radius: 6px;
        object-fit: cover;
    }

    /* Meta Box */
    .meta-box {
        background: #fcfcfc;
        border-radius: 8px;
        padding: 0.75rem;
        border: 1px solid #f0f0f0;
        font-size: 0.95rem;
        color: #444;
    }

    .meta-box strong {
        color: #2c5f2d;
    }

    /* Form Actions */
    .actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .btn {
        padding: 0.6rem 1rem;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        text-align: center;
    }

    .btn-primary {
        background: #2c5f2d;
        color: #fff;
        box-shadow: 0 6px 18px rgba(44, 95, 45, 0.08);
    }

    .btn-primary:hover {
        background: #3b7850;
    }

    .btn-secondary {
        background: #f1f3f5;
        color: #333;
        border: 1px solid #e8e8e8;
    }

    .btn-secondary:hover {
        background: #e2e5e8;
    }

    /* Hint text */
    .hint {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
</style>
@endpush

@section('content')
<div class="edit-event-wrap">
    <div class="card-header">
        <a href="{{ route('admin.events.index') }}">&larr; Back to Events</a>
        <h1>Edit Event</h1>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <!-- LEFT: Main form -->
                <div class="form-column">
                    <div>
                        <label for="title">Event Title</label>
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ old('title', $event->title) }}" required>
                        @error('title') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" required>{{ old('description', $event->description) }}</textarea>
                        @error('description') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-row">
                        <div>
                            <label for="event_date">Event Date & Time</label>
                            <input type="datetime-local" id="event_date" name="event_date" class="form-control"
                                value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required>
                            @error('event_date') <div class="error-message">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" class="form-control"
                                value="{{ old('location', $event->location) }}" required>
                            @error('location') <div class="error-message">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="badge_id">Assign Badge (Optional)</label>
                            <select id="badge_id" name="badge_id" class="form-control">
                                <option value="">No Badge</option>
                                @foreach($badges as $badge)
                                <option value="{{ $badge->id }}" {{ old('badge_id', $event->badge_id) == $badge->id ? 'selected' : '' }}>
                                    {{ $badge->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('badge_id') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div>
                            <label for="max_volunteers">Maximum Volunteers</label>
                            <input type="number" id="max_volunteers" name="max_volunteers" class="form-control"
                                value="{{ old('max_volunteers', $event->max_volunteers) }}" min="1" required>
                            @error('max_volunteers') <div class="error-message">{{ $message }}</div> @enderror
                            <div class="hint">Minimum 1 volunteer is required.</div>
                        </div>

                        <div>
                            <label for="image">Event Image</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*" @if(!$event->image) required @endif>
                            @error('image') <div class="error-message">{{ $message }}</div> @enderror
                            <div class="hint">Recommended: 1200x600px (JPG/PNG).</div>
                        </div>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Update Event</button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>

                <!-- RIGHT: Sidebar -->
                <aside class="sidebar">
                    <div class="image-preview">
                        @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                        @else
                        <div style="padding: 2rem; color: #6c757d;">No image uploaded yet</div>
                        @endif
                    </div>

                    <div class="meta-box">
                        <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem;">
                            <strong>Created</strong>
                            <span>{{ $event->created_at->format('M d, Y') }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem;">
                            <strong>Last Updated</strong>
                            <span>{{ $event->updated_at->diffForHumans() }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between;">
                            <strong>ID</strong>
                            <span>#{{ $event->id }}</span>
                        </div>
                    </div>
                </aside>
            </div>
        </form>
    </div>
</div>
@endsection