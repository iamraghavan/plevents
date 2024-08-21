@extends('admin.layouts.admin')

@section('admin_content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5>Create Session</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sessions.store', ['token' => $token]) }}" method="POST">
                            @csrf
                            @include('admin.pages.sessions.partials.form', ['session' => new App\Models\Session])

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block">Save Session</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
