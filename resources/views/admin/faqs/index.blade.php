{{-- resources/views/admin/faqs/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Manage FAQs')

@section('content')
<div class="admin-header">
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

<div class="content-card">
    <div class="content-card-header">
        <h2>All FAQs ({{ $faqs->total() }})</h2>
    </div>

    @if($faqs->count() > 0)
    <table class="table">
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
                <td>
                    @if($faq->image_url)
                        <img src="{{ $faq->image_url }}" alt="FAQ Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>
                    <span class="badge {{ $faq->is_active ? 'badge-success' : 'badge-secondary' }}">
                        {{ $faq->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.faqs.show', $faq) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container">
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
.btn-group {
    display: flex;
    gap: 5px;
}
.badge {
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
}
.badge-success {
    background-color: #28a745;
    color: white;
}
.badge-secondary {
    background-color: #6c757d;
    color: white;
}
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
.pagination-container {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}
</style>
@endsection