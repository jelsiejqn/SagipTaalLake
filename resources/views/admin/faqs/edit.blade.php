{{-- resources/views/admin/faqs/edit.blade.php --}}

@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="admin-header">
    <h1>Edit FAQ</h1>
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to FAQs
    </a>
</div>

<div class="content-card">
    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="question">Question <span class="required">*</span></label>
            <input type="text" 
                   class="form-control @error('question') is-invalid @enderror" 
                   id="question" 
                   name="question" 
                   value="{{ old('question', $faq->question) }}" 
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
                      required>{{ old('answer', $faq->answer) }}</textarea>
            @error('answer')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">FAQ Image (Optional)</label>
            
            @if($faq->image_url)
            <div class="current-image">
                <p><strong>Current Image:</strong></p>
                <img src="{{ $faq->image_url }}" alt="Current FAQ Image" style="max-width: 200px; max-height: 200px; border-radius: 8px; margin-bottom: 10px;">
            </div>
            @endif
            
            <input type="file" 
                   class="form-control @error('image') is-invalid @enderror" 
                   id="image" 
                   name="image" 
                   accept="image/*"
                   onchange="previewImage(event)">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Upload a new image to replace the current one. Accepted formats: JPG, PNG, GIF (Max: 2MB)</small>
            
            <div id="imagePreview" style="margin-top: 10px; display: none;">
                <p><strong>New Image Preview:</strong></p>
                <img id="preview" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
            </div>
        </div>

        <div class="form-group">
            <label for="display_order">Display Order <span class="required">*</span></label>
            <input type="number" 
                   class="form-control @error('display_order') is-invalid @enderror" 
                   id="display_order" 
                   name="display_order" 
                   value="{{ old('display_order', $faq->display_order) }}" 
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
                       {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Active (Show on website)
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update FAQ
            </button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
.form-group {
    margin-bottom: 20px;
}
.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
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
.current-image {
    margin-bottom: 15px;
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