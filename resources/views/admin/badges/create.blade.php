@extends('layouts.admin')

@section('title', 'Create Badge')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Events.css') }}">
<style>
    .edit-badge-wrap {
        max-width: 700px;
        margin: 2rem auto;
        padding: 1rem;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        padding: 1.25rem;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.35rem;
        color: #2c5f2d;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.6rem 0.75rem;
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        font-size: 0.95rem;
        background: #fff;
        box-shadow: inset 0 1px 0 rgba(0,0,0,0.02);
        margin-bottom: 0.75rem;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .error-message {
        color: #c0392b;
        font-size: 0.875rem;
        margin-top: -0.5rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .hint {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: -0.25rem;
        margin-bottom: 0.5rem;
    }

    .actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 0.25rem;
    }

    .btn {
        padding: 0.6rem 1rem;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .btn-primary {
        background: #2c5f2d;
        color: #fff;
        box-shadow: 0 6px 18px rgba(44,95,45,0.08);
    }

    .btn-secondary {
        background: #f1f3f5;
        color: #333;
        border: 1px solid #e8e8e8;
    }
</style>
@endpush

@section('content')
<div class="edit-badge-wrap">
    <div class="card-header">
        <a href="{{ route('admin.badges.index') }}" style="color: #2c5f2d; text-decoration: none; font-weight: 600;">&larr; Back to Badges</a>
        <h1 style="margin: 0; font-size: 1.25rem; color: #2c5f2d;">Create Badge</h1>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.badges.store') }}">
            @csrf

            <div class="form-column">
                <div>
                    <label for="name">Badge Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="description">Description (Optional)</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="icon">Icon/Emoji (Optional)</label>
                    <input type="text" id="icon" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="🏆">
                    <div class="hint">You can use an emoji or any character. Example: 🏆 🌟 ⭐ 🎖️</div>
                    @error('icon')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">Create Badge</button>
                    <a href="{{ route('admin.badges.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
