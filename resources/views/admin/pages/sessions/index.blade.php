@extends('admin.layouts.admin')

@section('admin_content')
    <h1>Sessions</h1>
    <a href="{{ route('sessions.create', ['token' => $token]) }}" class="btn btn-primary">Create Session</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Conducted By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sessions as $session)
                <tr>
                    <td>{{ $session->title }}</td>
                    <td>{{ $session->date }}</td>
                    <td>{{ $session->start_time }}</td>
                    <td>{{ $session->end_time }}</td>
                    <td>{{ $session->conducted_by }}</td>
                    <td>
                        <a href="{{ route('sessions.show', ['session' => $session->id, 'token' => $token]) }}" class="btn btn-info">View</a>
                        <a href="{{ route('sessions.edit', ['session' => $session->id, 'token' => $token]) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('sessions.destroy', ['session' => $session->id, 'token' => $token]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
