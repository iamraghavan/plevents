@extends('admin.layouts.admin')
@section('admin_content')
    <h1>{{ $session->title }}</h1>
    <p>{{ $session->description }}</p>
    <p>Conducted by: {{ $session->conducted_by }}</p>
    <p>Date: {{ $session->date }}</p>
    <p>Start Time: {{ $session->start_time }}</p>
    <p>End Time: {{ $session->end_time }}</p>
    <p>Location: {{ $session->location }}</p>
    <p>Venue: {{ $session->venue }}</p>
    <p>Department: {{ $session->department }}</p>
    <p>Mode: {{ $session->mode }}</p>
    @if($session->mode === 'Online' || $session->mode === 'Hybrid')
        <p>Meeting URL: <a href="{{ $session->meeting_url }}">{{ $session->meeting_url }}</a></p>
    @endif
    <p>Price: {{ $session->price_type === 'Free' ? 'Free' : '₹' . $session->amount }}</p>
@endsection
