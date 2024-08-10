@extends('admin.layouts.admin')

@section('admin_content')
<div class="container">
    <h2>Admin Dashboard</h2>

    <div class="card">
        <div class="card-header">
            Welcome, {{ $name }}!
        </div>
        <div class="card-body">
            <p>Email: {{ $email }}</p>
        </div>

<div class="mx-5 my-5">

    <a href="{{ route('sessions.index', ['token' => $token]) }}">View All Sessions</a>

</div>

    </div>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection
