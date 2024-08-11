<div class="events-schedules-area ptb-100">
    <div class="container">
        <div class="section-title">
            {{-- <span>Event Schedule</span> --}}
            <h2>Event Schedule</h2>
        </div>
        @foreach($events as $index => $event)
        <div class="events-schedules-table">

                <div class="row align-items-center">
                    <div class="col-lg-1">
                        <div class="number">{{ sprintf('%02d', $index + 1) }}</div>
                    </div>
                    <div class="col-lg-2">
                        <div class="time-content">
                            <p><i class="bx bx-calendar"></i> {{ \Carbon\Carbon::parse($event->start_time)->format('g:i a') }}</p>
                            <span style="">to</span>
                            <p><i class="bx bx-calendar"></i> {{ \Carbon\Carbon::parse($event->end_time)->format('g:i a') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="content-title">
                            <h6>{{ $event->title }}</h6>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="time-content">
                            <h6>{{ $event->venue }}</h6>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="content-btn">
                            <a href="{{ $event->register_url }}" class="default-btn">
                                <i class="bx bx-arrow-to-right"></i> Register Now
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>

        </div>
        @endforeach

        <!-- View More Event Schedule Button -->
        <div class="text-center mt-4">
            <a href="{{ route('events.index') }}" class="default-btn">
                View More Event Schedule
                <span></span>
            </a>
        </div>
    </div>
</div>
