@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2>Register for {{ $event->title }}</h2>

    <form id="registration-form" action="{{ route('event.register.payment') }}" method="POST">
        @csrf

        <!-- Hidden fields for event ID and Google UID -->
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <input type="hidden" id="google_uid" name="google_uid">

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" maxlength="10" required>
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="address_1">Address:</label>
            <input type="text" class="form-control" id="address_1" name="address_1" value="{{ old('address_1') }}" required>
        </div>

        <!-- City -->
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
        </div>

        <!-- Country -->
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" required>
        </div>

        <!-- Pincode -->
        <div class="form-group">
            <label for="pincode">Pincode:</label>
            <input type="text" class="form-control" id="pincode" name="pincode" value="{{ old('pincode') }}" maxlength="10" required>
        </div>

        <!-- Amount -->
        <div class="form-group">
            <label for="amount">Amount (INR):</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ $event->amount }}" required readonly>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
    </form>
</div>


<script>
    // JavaScript code to set the Google UID value
    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve the Google UID from the session using a data attribute
        const googleUid = @json(session('google_uid'));

        // Set the value of the hidden input field
        if (googleUid) {
            document.getElementById('google_uid').value = googleUid;
        }
    });
</script>
@endsection
