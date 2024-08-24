<div>
    <h4>{{ $event->title }}</h4>
    <p>{{ $event->description }}</p>
    <p><strong>Conducted by:</strong> {{ $event->conducted_by }}</p>
    <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('g:i a') }}</p>
    <p><strong>End Time:</strong> {{ \Carbon\Carbon::parse($event->end_time)->format('g:i a') }}</p>
    <p><strong>Venue:</strong> {{ $event->venue }}</p>
    <p><strong>Mode:</strong> {{ $event->mode }}</p>
    <p><strong>Price:</strong> {{ $event->amount }}</p>
</div>
