@extends('admin.layouts.admin')

@section('admin_content')
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h2>Admin Dashboard</h2>
                </div>
                <div class="card-body">
                    <h4>Welcome, {{ $name }}!</h4>
                    <p>Email: {{ $email }}</p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('sessions.index', ['token' => $token]) }}" class="btn btn-primary btn-block">
                                View All Sessions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-block">
                    Logout
                </button>
            </form>

            <div class="card-body">
                <h4>Laravel v{{ Illuminate\Foundation\Application::VERSION }}</h4>


            </div>
        </div>
    </div>


</div>
@endsection
