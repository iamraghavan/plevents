@extends('layout.app')
@section('content')

<x-page-banner
    title="Events"
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('index')],
        ['label' => 'Events', 'url' => '#'],
        // ['label' => ]
    ]"
/>
<div class="event-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="event-details">
                    <div class="event-details-header">
                        <a href="{{ route('events.index') }}" class="back-all-event"><i class="bx bx-chevron-left"></i> Back To All Events</a>
                        <h3>{{ $event->title }}</h3>
                        <ul class="event-info-meta">
                            <li><i class="bx bx-calendar"></i> {{ \Carbon\Carbon::parse($event->date)->format('d F, Y') }}</li>
                            <li><i class="bx bx-time"></i> {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</li>
                        </ul>
                    </div>

                    <div class="event-details-image">
                        <img src="{{ asset('assets/images/events.webp') }}" alt="{{ $event->title }}">
                    </div>

                    <div class="event-details-desc">
                        <p>{{ $event->description }}</p>
                    </div>

                    <div class="event-info-links">
                        @if($event->meeting_url)
                            <a href="{{ $event->meeting_url }}" target="_blank">Join Meeting</a>
                        @endif
                    </div>

                    <div class="post-navigation">
                        {{-- <div class="navigation-links">
                            @if($previousEvent)
                                <div class="nav-previous">
                                    <a href="{{ route('events.show', ['id' => $previousEvent->id, 'slug' => str_slug($previousEvent->title)]) }}"><i class="bx bx-chevron-left"></i> Prev Events</a>
                                </div>
                            @endif

                            @if($nextEvent)
                                <div class="nav-next">
                                    <a href="{{ route('events.show', ['id' => $nextEvent->id, 'slug' => str_slug($nextEvent->title)]) }}">Next Events <i class="bx bx-chevron-right"></i></a>
                                </div>
                            @endif
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <aside class="widget-area" id="secondary">
                    <div class="widget widget_event_details">
                        <h3 class="widget-title">Details</h3>

                        <ul>
                            <li><span>Department:</span> {{ $event->department }}</li>
                            <li><span>Mode:</span> {{ $event->mode }}</li>
                            <li><span>Location:</span> {{ $event->location }}</li>
                            <li><span>Venue:</span> {{ $event->venue }}</li>
                            <li><span>Price Type:</span> {{ $event->price_type }}</li>
                            <li><span>Amount:</span> {{ $event->amount }}</li>
                            <li><span>Created At:</span> {{ \Carbon\Carbon::parse($event->created_at)->format('d F, Y H:i') }}</li>
                            <li><span>Updated At:</span> {{ \Carbon\Carbon::parse($event->updated_at)->format('d F, Y H:i') }}</li>
                        </ul>
                    </div>

                    <div class="widget widget_event_details">
                        <h3 class="widget-title">Organizer</h3>

                        <ul>
                            <li><span>Conducted By:</span> {{ $event->conducted_by }}</li>
                        </ul>
                    </div>

                    <div class="widget widget_event_details">
                        <h3 class="widget-title">Venue</h3>

                        <ul>
                            <li><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->venue) }}" target="_blank">{{ $event->venue }}</a></li>
                            <li><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->venue) }}" target="_blank">+ Google Map</a></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

@endsection
