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
                        <h3>{{ $eventDetails->title }}</h3>
                        <ul class="event-info-meta">
                            <li><i class="bx bx-calendar"></i> {{ \Carbon\Carbon::parse($eventDetails->date)->format('d F, Y') }}</li>
                            <li><i class="bx bx-time"></i> {{ \Carbon\Carbon::parse($eventDetails->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($eventDetails->end_time)->format('H:i') }}</li>
                        </ul>
                    </div>

                    <div class="event-details-image">
                        <img src="{{ asset('assets/images/events.webp') }}" alt="{{ $eventDetails->title }}">
                    </div>

                    <div class="event-details-desc">
                        <p>{{ $eventDetails->description }}</p>
                    </div>



                    <div class="event-info-links">
                        <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($eventDetails->title) }}&dates={{ \Carbon\Carbon::parse($eventDetails->date . ' ' . $eventDetails->start_time)->format('Ymd\THis\Z') }}/{{ \Carbon\Carbon::parse($eventDetails->date . ' ' . $eventDetails->end_time)->format('Ymd\THis\Z') }}&details={{ urlencode($eventDetails->description) }}&location={{ urlencode($eventDetails->venue) }}" target="_blank">+ Google Calendar</a>
                        {{-- <a href="#">+ iCal Export</a> --}}
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
                            <li><span>Department:</span> {{ $eventDetails->department }}</li>
                            <li><span>Mode:</span> {{ $eventDetails->mode }}</li>
                            <li><span>Location:</span> {{ $eventDetails->location }}</li>
                            <li><span>Venue:</span> {{ $eventDetails->venue }}</li>
                            @if($eventDetails->price_type !== 'Idle')
    <li><span>Price Type:</span> {{ $eventDetails->price_type }}</li>
@else
    <li><span>Price Type:</span> Paid</li>
@endif

                            <li><span>Amount:</span> {{ $eventDetails->amount }}</li>
                            <li><span>Created At:</span> {{ \Carbon\Carbon::parse($eventDetails->created_at)->format('d F, Y H:i') }}</li>
                            <li><span>Updated At:</span> {{ \Carbon\Carbon::parse($eventDetails->updated_at)->format('d F, Y H:i') }}</li>
                        </ul>
                    </div>

                    <div class="widget widget_event_details">
                        <h3 class="widget-title">Organizer</h3>

                        <ul>
                            <li><span>Conducted By:</span> {{ $eventDetails->conducted_by }}</li>
                        </ul>
                    </div>

                    <div class="widget widget_event_details">
                        <h3 class="widget-title">Venue</h3>

                        <ul>
                            <li><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($eventDetails->venue) }}" target="_blank">{{ $eventDetails->venue }}</a></li>
                            <li><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($eventDetails->venue) }}" target="_blank">+ Google Map</a></li>
                        </ul>
                    </div>

                    <div class="widget widget_event_details">
                        <h3 class="widget-title">Register Here</h3>

                        <div class="event-details">
                            <div class="event-info-links">
                                <a href="" target="_blank">Register</a>

                            </div>
                        </div>

                    </div>


                </aside>
            </div>
        </div>
    </div>
</div>

@endsection
