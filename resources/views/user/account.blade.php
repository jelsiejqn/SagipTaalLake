@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
<div class="card">
    <h1 style="margin-bottom: 1.5rem;">Account Settings</h1>
    
    <div class="form-group">
        <label>Name</label>
        <p>{{ auth()->user()->name }}</p>
    </div>
    
    <div class="form-group">
        <label>Email</label>
        <p>{{ auth()->user()->email }}</p>
    </div>
    
    <div class="form-group">
        <label>Member Since</label>
        <p>{{ auth()->user()->created_at->format('M d, Y') }}</p>
    </div>
</div>
@endsection
