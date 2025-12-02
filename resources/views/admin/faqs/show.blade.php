{{-- resources/views/admin/faqs/show.blade.php --}}

@extends('layouts.admin')

@section('title', 'View FAQ')

@section('content')
<div class="admin-header">
    <h1>FAQ Details</h1>
    <div class="header-actions">
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to FAQs
        </a>
        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit FAQ
        </a>
    </div>
</div>

<div class="content-card">
    <div class="faq-detail">
        <div class="detail-row">
            <label>Question:</label>
            <div class="detail-value">{{ $faq->question }}</div>
        </div>

        <div class="detail-row">
            <label>Answer:</label>
            <div class="detail-value">{{ $faq->answer }}</div>
        </div>

        <div class="detail-row">
            <label>Image:</label>
            <div class="detail-value">
                @if($faq->image_url)
                <img src="{{ $faq->image_url }}" alt="FAQ Image" style="max-width: 400px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                @else
                <span class="text-muted">No image uploaded</span>
                @endif
            </div>
        </div>

        <div class="detail-row">
            <label>Display Order:</label>
            <div class="detail-value">{{ $faq->display_order }}</div>
        </div>

        <div class="detail-row">
            <label>Status:</label>
            <div class="detail-value">
                <span class="badge {{ $faq->is_active ? 'badge-success' : 'badge-secondary' }}">
                    {{ $faq->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        <div class="detail-row">
            <label>Created At:</label>
            <div class="detail-value">{{ $faq->created_at->format('M d, Y - h:i A') }}</div>
        </div>

        <div class="detail-row">
            <label>Last Updated:</label>
            <div class="detail-value">{{ $faq->updated_at->format('M d, Y - h:i A') }}</div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit FAQ
        </a>
        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Delete FAQ
            </button>
        </form>
    </div>
</div>

<style>
    .header-actions {
        display: flex;
        gap: 10px;
    }

    .faq-detail {
        padding: 20px;
    }

    .detail-row {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-row label {
        display: block;
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .detail-value {
        font-size: 16px;
        color: #333;
        line-height: 1.6;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: white;
    }

    .text-muted {
        color: #999;
        font-style: italic;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 30px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 4px;
    }
</style>
@endsection