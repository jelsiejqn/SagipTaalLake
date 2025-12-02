@extends('layouts.admin')

@section('title', 'Manage Badges')

@section('content')
<div class="admin-header-flex">
    <h1>Manage Badges</h1>
    <a href="{{ route('admin.badges.create') }}" class="btn btn-primary">Create New Badge</a>
</div>

<div class="card table-card">
    @if($badges->count() > 0)
    <table class="admin-table">
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
                <td style="font-size: 2rem; text-align: center;">{{ $badge->icon ?? '🏆' }}</td>
                <td>{{ $badge->name }}</td>
                <td>{{ $badge->description ?? 'N/A' }}</td>
                <td>{{ $badge->events()->count() }}</td>
                <td class="table-actions">
                    <a href="{{ route('admin.badges.edit', $badge) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.badges.destroy', $badge) }}" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this badge?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $badges->links() }}
    </div>
    @else
    <p class="no-events-text">No badges found.</p>
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
        background-color: #4ea576ff;
        color: #fff;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #75d278ff;
    }

    .btn-danger {
        background-color: #e63946;
        color: #fff;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c71c2b;
    }

    /* No badges text */
    .no-events-text {
        text-align: center;
        color: #666;
        padding: 2rem 0;
    }

    /* Pagination wrapper */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
    }
</style>
@endsection