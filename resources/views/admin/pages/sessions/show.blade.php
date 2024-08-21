@extends('admin.layouts.admin')

@section('admin_content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4>{{ $session->title }}</h4>
                </div>
                <div class="card-body">
                    <h4>Description:</h4>
                    <p>{{ $session->description }}</p>

                    <h4>Session Details:</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th>Conducted By</th>
                                    <td>{{ $session->conducted_by }}</td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td>{{ $session->date }}</td>
                                </tr>
                                <tr>
                                    <th>Start Time</th>
                                    <td>{{ $session->start_time }}</td>
                                </tr>
                                <tr>
                                    <th>End Time</th>
                                    <td>{{ $session->end_time }}</td>
                                </tr>
                                <tr>
                                    <th>Location</th>
                                    <td>{{ $session->location }}</td>
                                </tr>
                                <tr>
                                    <th>Venue</th>
                                    <td>{{ $session->venue }}</td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>{{ $session->department }}</td>
                                </tr>
                                <tr>
                                    <th>Mode</th>
                                    <td>{{ $session->mode }}</td>
                                </tr>
                                @if($session->mode === 'Online' || $session->mode === 'Hybrid')
                                    <tr>
                                        <th>Meeting URL</th>
                                        <td><a href="{{ $session->meeting_url }}">{{ $session->meeting_url }}</a></td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $session->price_type === 'Free' ? 'Free' : '₹' . $session->amount }}</td>
                                </tr>
                                <tr>
                                    <th>Actions</th>
                                    <td>

                                        <a href="{{ route('sessions.edit', ['session' => $session->id, 'token' => $token]) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        <form action="{{ route('sessions.destroy', ['session' => $session->id, 'token' => $token]) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
