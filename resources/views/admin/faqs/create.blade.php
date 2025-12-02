{{-- resources/views/admin/faqs/create.blade.php --}}

@extends('layouts.admin')

@section('title', 'Create FAQ')

@section('content')
<div class="admin-header-flex">
    <h1>Create New FAQ</h1>
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to FAQs
    </a>
</div>

<div class="card table-card">
    <form action="{{ route('admin.faqs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="question">Question <span class="required">*</span></label>
            <input type="text"
                class="form-control @error('question') is-invalid @enderror"
                id="question"
                name="question"
                value="{{ old('question') }}"
                required>
            @error('question')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="answer">Answer <span class="required">*</span></label>
            <textarea class="form-control @error('answer') is-invalid @enderror"
                id="answer"
                name="answer"
                rows="5"
                required>{{ old('answer') }}</textarea>
            @error('answer')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">FAQ Image (Optional)</label>
            <input type="file"
                class="form-control @error('image') is-invalid @enderror"
                id="image"
                name="image"
                accept="image/*"
                onchange="previewImage(event)">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Accepted formats: JPG, PNG, GIF (Max: 2MB)</small>

            <div id="imagePreview" class="image-preview-new" style="margin-top: 10px; display: none;">
                <img id="preview" src="" alt="Preview" class="faq-new-image">
            </div>
        </div>

        <div class="form-group">
            <label for="display_order">Display Order <span class="required">*</span></label>
            <input type="number"
                class="form-control @error('display_order') is-invalid @enderror"
                id="display_order"
                name="display_order"
                value="{{ old('display_order', 0) }}"
                min="0"
                required>
            @error('display_order')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Lower numbers appear first</small>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox"
                    class="form-check-input"
                    id="is_active"
                    name="is_active"
                    value="1"
                    {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active (Show on website)</label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create FAQ
            </button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
    .admin-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .card.table-card {
        background: #fff;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }

    .form-control:focus {
        outline: none;
        border-color: #4CAF50;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }

    .required {
        color: #dc3545;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .text-muted {
        color: #6c757d;
        font-size: 13px;
    }

    textarea {
        resize: vertical;
    }

    .image-preview-new img.faq-new-image {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
    }
</style>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    }
</script>
@endsection