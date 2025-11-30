@extends('layouts.app')

@section('title', 'Create Badge')

@section('content')
<div style="margin-bottom: 1rem;">
    <a href="{{ route('admin.badges.index') }}" style="color: #2c5f2d; text-decoration: none;">&larr; Back to Badges</a>
</div>

<div class="card">
    <h1 style="margin-bottom: 1.5rem;">Create New Badge</h1>

    <form method="POST" action="{{ route('admin.badges.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Badge Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="icon">Icon/Emoji (Optional)</label>
            <input type="text" id="icon" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="🏆">
            <small style="color: #666; font-size: 0.875rem;">You can use an emoji or any character. Example: 🏆 🌟 ⭐ 🎖️</small>
            @error('icon')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">Create Badge</button>
            <a href="{{ route('admin.badges.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection