<div class="container mt-4">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $session->title) }}">
                </div>

                <div class="form-group">
                    <label for="conducted_by">Conducted By</label>
                    <input type="text" name="conducted_by" id="conducted_by" class="form-control" value="{{ old('conducted_by', $session->conducted_by) }}">
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $session->date) }}">
                </div>

                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="text" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', \Carbon\Carbon::parse($session->start_time)->format('h:i A')) }}">
                </div>

                <div class="form-group">
                    <label for="end_time">End Time</label>
                    <input type="text" name="end_time" id="end_time" class="form-control" value="{{ old('end_time', \Carbon\Carbon::parse($session->end_time)->format('h:i A')) }}">
                </div>

                <div class="form-group">
                    <label for="venue">Venue</label>
                    <input type="text" name="venue" id="venue" class="form-control" value="{{ old('venue', $session->venue) }}">
                </div>

                <div class="form-group">
                    <label for="price_type">Price Type</label>
                    <select name="price_type" id="price_type" class="form-control">
                        <option value="Free" {{ old('price_type', $session->price_type) === 'Free' ? 'selected' : '' }}>Free</option>
                        <option value="Idle" {{ old('price_type', $session->price_type) === 'Idle' ? 'selected' : '' }}>Idle</option>
                    </select>
                </div>

                <div class="form-group" id="amount-group">
                    <label for="amount">Amount (₹)</label>
                    <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $session->amount) }}" step="0.01">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $session->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $session->location) }}">
                </div>

                <div class="form-group">
                    <label for="department">Department</label>
                    <select name="department" id="department" class="form-control">
                        <option value="Mechanical Engineering" {{ old('department', $session->department) === 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
                        <option value="Civil Engineering" {{ old('department', $session->department) === 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                        <option value="Electrical and Electronics Engineering" {{ old('department', $session->department) === 'Electrical and Electronics Engineering' ? 'selected' : '' }}>Electrical and Electronics Engineering</option>
                        <option value="Electronics and Communication Engineering" {{ old('department', $session->department) === 'Electronics and Communication Engineering' ? 'selected' : '' }}>Electronics and Communication Engineering</option>
                        <option value="Computer Science and Engineering" {{ old('department', $session->department) === 'Computer Science and Engineering' ? 'selected' : '' }}>Computer Science and Engineering</option>
                        <option value="Information Technology" {{ old('department', $session->department) === 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                        <option value="Biomedical Engineering" {{ old('department', $session->department) === 'Biomedical Engineering' ? 'selected' : '' }}>Biomedical Engineering</option>
                        <option value="Computer Science & Business Systems Engineering" {{ old('department', $session->department) === 'Computer Science & Business Systems Engineering' ? 'selected' : '' }}>Computer Science & Business Systems Engineering</option>
                        <option value="Artificial Intelligence and Data Science" {{ old('department', $session->department) === 'Artificial Intelligence and Data Science' ? 'selected' : '' }}>Artificial Intelligence and Data Science</option>
                        <option value="MCA" {{ old('department', $session->department) === 'MCA' ? 'selected' : '' }}>MCA</option>
                        <option value="MBA" {{ old('department', $session->department) === 'MBA' ? 'selected' : '' }}>MBA</option>
                        <option value="Science & Humanities" {{ old('department', $session->department) === 'Science & Humanities' ? 'selected' : '' }}>Science & Humanities</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="mode">Mode</label>
                    <select name="mode" id="mode" class="form-control">
                        <option value="Online" {{ old('mode', $session->mode) === 'Online' ? 'selected' : '' }}>Online</option>
                        <option value="Offline" {{ old('mode', $session->mode) === 'Offline' ? 'selected' : '' }}>Offline</option>
                        <option value="Hybrid" {{ old('mode', $session->mode) === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                </div>

                <div class="form-group" id="meeting-url-group">
                    <label for="meeting_url">Meeting URL (if Online/Hybrid)</label>
                    <input type="url" name="meeting_url" id="meeting_url" class="form-control" value="{{ old('meeting_url', $session->meeting_url) }}">
                </div>
            </div>
        </div>


</div>
<style>
    .form-group {
        margin-bottom: 1.5rem;
    }

    #amount-group {
        display: none;
    }

    #meeting-url-group {
        display: none;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Show/Hide Amount Field Based on Price Type
        const priceTypeSelect = document.getElementById('price_type');
        const amountGroup = document.getElementById('amount-group');
        const amountInput = document.getElementById('amount');

        function toggleAmountField() {
            if (priceTypeSelect.value === 'Free') {
                amountGroup.style.display = 'none';
                amountInput.value = 0; // Set amount to 0
            } else {
                amountGroup.style.display = 'block';
            }
        }

        priceTypeSelect.addEventListener('change', toggleAmountField);
        toggleAmountField(); // Initial call to set state based on initial value

        // Show/Hide Meeting URL Field Based on Mode
        const modeSelect = document.getElementById('mode');
        const meetingUrlGroup = document.getElementById('meeting-url-group');

        function toggleMeetingUrlField() {
            if (modeSelect.value === 'Online' || modeSelect.value === 'Hybrid') {
                meetingUrlGroup.style.display = 'block';
            } else {
                meetingUrlGroup.style.display = 'none';
            }
        }

        modeSelect.addEventListener('change', toggleMeetingUrlField);
        toggleMeetingUrlField(); // Initial call to set state based on initial value
    });
</script>
