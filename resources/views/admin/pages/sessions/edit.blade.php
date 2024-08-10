    @extends('admin.layouts.admin')
    @section('admin_content')

        <h1>Edit Session</h1>
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
            <button type="submit" class="btn btn-primary">Update Session</button>
        </form>




    @endsection
