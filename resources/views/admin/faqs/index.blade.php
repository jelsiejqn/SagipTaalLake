{{-- resources/views/admin/faqs/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Manage FAQs')

@section('content')
<div class="admin-header-flex">
    <h1>Manage FAQs</h1>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New FAQ
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card table-card">
    @if($faqs->count() > 0)
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Question</th>
                <th>Answer Preview</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
            <tr>
                <td>{{ $faq->display_order }}</td>
                <td>{{ Str::limit($faq->question, 50) }}</td>
                <td>{{ Str::limit($faq->answer, 80) }}</td>
                <td class="text-center">
                    @if($faq->image_url)
                    <img src="{{ $faq->image_url }}" alt="FAQ Image" class="faq-image">
                    @else
                    <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>
                    <span class="badge {{ $faq->is_active ? 'badge-success' : 'badge-secondary' }}">
                        {{ $faq->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="table-actions">
                    <a href="{{ route('admin.faqs.show', $faq) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $faqs->links() }}
    </div>
    @else
    <div class="no-data">
        <p>No FAQs found.</p>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Create your first FAQ</a>
    </div>
    @endif
</div>

<style>
    /* Header */
    .admin-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    /* Card */
    .table-card {
        background: #fff;
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
        vertical-align: middle;
        /* fix vertical alignment */
    }

    .admin-table th {
        background-color: #f4f4f4;
        font-weight: 600;
        color: #486848;
    }

    .faq-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }

    /* Actions */
    .table-actions {
        display: flex;
        gap: 5px;
        justify-content: center;
        align-items: center;
        /* vertically center buttons */
    }

    .inline-form {
        display: inline;
    }

    /* Buttons */
    .btn-sm {
        font-size: 0.875rem;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary {
        background-color: #486848;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #60856c;
    }

    .btn-info {
        background-color: #17a2b8;
        color: #fff;
        border: none;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-danger {
        background-color: #e63946;
        color: #fff;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c71c2b;
    }

    /* Badges */
    .badge {
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        color: #fff;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-secondary {
        background-color: #6c757d;
    }

    /* Alerts */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    /* No data */
    .no-data {
        text-align: center;
        padding: 2rem 0;
    }
</style>
@endsection