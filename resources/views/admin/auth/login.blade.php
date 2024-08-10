@extends('admin.layouts.admin')

@section('admin_content')
<div class="container">
    <h2>Login</h2>
    <form method="POST" action="{{ route('auth.admin-login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
            @error('email')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Login</button>

        @if ($errors->has('email'))
            <div class="alert alert-danger mt-3">{{ $errors->first('email') }}</div>
        @endif
    </form>

</div>
@endsection
