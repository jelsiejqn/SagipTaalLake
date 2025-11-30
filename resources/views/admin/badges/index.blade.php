@extends('layouts.app')

@section('title', 'Manage Badges')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h1>Manage Badges</h1>
    <a href="{{ route('admin.badges.create') }}" class="btn btn-primary">Create New Badge</a>
</div>

<div class="card">
    @if($badges->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Icon</th>
                <th>Name</th>
                <th>Description</th>
                <th>Events Using</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($badges as $badge)
            <tr>
                <td style="font-size: 2rem;">{{ $badge->icon ?? '🏆' }}</td>
                <td>{{ $badge->name }}</td>
                <td>{{ $badge->description ?? 'N/A' }}</td>
                <td>{{ $badge->events()->count() }}</td>
                <td>
                    <a href="{{ route('admin.badges.edit', $badge) }}" class="btn btn-secondary" style="font-size: 0.875rem; padding: 0.375rem 0.75rem;">Edit</a>
                    <form method="POST" action="{{ route('admin.badges.destroy', $badge) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="font-size: 0.875rem; padding: 0.375rem 0.75rem;" onclick="return confirm('Are you sure you want to delete this badge?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $badges->links() }}
    </div>
    @else
    <p style="text-align: center; color: #666; padding: 2rem 0;">No badges found.</p>
    @endif
</div>
@endsection