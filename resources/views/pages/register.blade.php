@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2>Register for {{ $event->title }}</h2>

    <form id="registration-form" action="{{ route('event.register.payment') }}" method="POST">
        @csrf

        <!-- Hidden fields for event ID and Google UID -->
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <input type="hidden" id="google_uid" name="google_uid" value="">


        <!-- Name -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ Auth::check() ? Auth::user()->name : old('name') }}"
                   {{ Auth::check() ? 'readonly' : '' }} required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                   {{ Auth::check() ? 'readonly' : '' }} required>
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone"
                   value="{{ old('phone') }}" maxlength="10" required>
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="address_1">Address:</label>
            <input type="text" class="form-control" id="address_1" name="address_1"
                   value="{{ old('address_1') }}" required>
        </div>

        <!-- City -->
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city"
                   value="{{ old('city') }}" required>
        </div>

        <!-- Country -->
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" id="country" name="country"
                   value="{{ old('country') }}" required>
        </div>

        <!-- Pincode -->
        <div class="form-group">
            <label for="pincode">Pincode:</label>
            <input type="text" class="form-control" id="pincode" name="pincode"
                   value="{{ old('pincode') }}" maxlength="10" required>
        </div>

        <!-- Amount -->
        <div class="form-group">
            <label for="amount">Amount (INR):</label>
            <input type="number" class="form-control" id="amount" name="amount"
                   value="{{ $event->amount }}" required readonly>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
    </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const googleUid = @json(session('google_uid'));

    if (googleUid) {
        const googleUidInput = document.getElementById('google_uid');
        if (googleUidInput) {
            googleUidInput.value = googleUid;
            // console.log('Google UID set in input:', googleUidInput.value);
        } else {
            console.error('Google UID input field not found.');
        }
    } else {
        console.log('Google UID not found in session.');
    }
});

</script>
@endsection
