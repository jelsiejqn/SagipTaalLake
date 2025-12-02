@extends('layouts.public')

@section('title', 'Developers - Sagip Taal Lake')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/Developers.css') }}">
@endpush

@section('content')
<div class="developers-page">
    <br/> <br/>
    <h1>Meet the Developers</h1>
    <div class="dev-grid">
        <div class="dev-card">
            <img src="{{ asset('images/ID-Dionne.jpg') }}" alt="Blacer, Dionne Catherine" />
            <h3>Blacer, Dionne Catherine</h3>
            <p>Developer</p>
        </div>
        <div class="dev-card">
            <img src="{{ asset('images/ID-Jamie.jpg') }}" alt="Hernandez, Jose Maria" />
            <h3>Hernandez, Jose Maria</h3>
            <p>Developer</p>
        </div>
        <div class="dev-card">
            <img src="{{ asset('images/ID-Jelsie.PNG') }}" alt="Joaquin, Jelsie Kianna" />
            <h3>Joaquin, Jelsie Kianna</h3>
            <p>Developer</p>
        </div>
    </div>
</div>
@endsection
