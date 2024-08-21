@extends('admin.layouts.admin')

@section('admin_content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5>Edit Session</h5>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('sessions.update', $session->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('admin.pages.sessions.partials.form', ['session' => $session])

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block">Update Session</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
