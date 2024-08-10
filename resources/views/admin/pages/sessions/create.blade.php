@extends('admin.layouts.admin')

@section('admin_content')


    <div class="container">
        <h1>Create Session</h1>
        <form action="{{ route('sessions.store', ['token' => $token]) }}" method="POST">
            @csrf
            @include('admin.pages.sessions.partials.form', ['session' => new App\Models\Session])
            <button type="submit" class="btn btn-primary">Save Session</button>
        </form>
    </div>

@endsection
