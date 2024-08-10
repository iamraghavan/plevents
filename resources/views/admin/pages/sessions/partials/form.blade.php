<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $session->title) }}">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control">{{ old('description', $session->description) }}</textarea>
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
    <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', $session->start_time) }}">
</div>

<div class="form-group">
    <label for="end_time">End Time</label>
    <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time', $session->end_time) }}">
</div>

<div class="form-group">
    <label for="location">Location</label>
    <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $session->location) }}">
</div>

<div class="form-group">
    <label for="venue">Venue</label>
    <input type="text" name="venue" id="venue" class="form-control" value="{{ old('venue', $session->venue) }}">
</div>

<div class="form-group">
    <label for="department">Department</label>
    <input type="text" name="department" id="department" class="form-control" value="{{ old('department', $session->department) }}">
</div>

<div class="form-group">
    <label for="mode">Mode</label>
    <select name="mode" id="mode" class="form-control">
        <option value="Online" {{ old('mode', $session->mode) === 'Online' ? 'selected' : '' }}>Online</option>
        <option value="Offline" {{ old('mode', $session->mode) === 'Offline' ? 'selected' : '' }}>Offline</option>
        <option value="Hybrid" {{ old('mode', $session->mode) === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
    </select>
</div>

<div class="form-group">
    <label for="meeting_url">Meeting URL (if Online/Hybrid)</label>
    <input type="url" name="meeting_url" id="meeting_url" class="form-control" value="{{ old('meeting_url', $session->meeting_url) }}">
</div>

<div class="form-group">
    <label for="price_type">Price Type</label>
    <select name="price_type" id="price_type" class="form-control">
        <option value="Free" {{ old('price_type', $session->price_type) === 'Free' ? 'selected' : '' }}>Free</option>
        <option value="Idle" {{ old('price_type', $session->price_type) === 'Idle' ? 'selected' : '' }}>Idle</option>
    </select>
</div>

<div class="form-group">
    <label for="amount">Amount (₹)</label>
    <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $session->amount) }}" step="0.01">
</div>
