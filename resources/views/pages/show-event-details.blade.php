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
<div class="event-details-area ptb-100" id='vanakam_da_mapla'>
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
                        {{-- <p>{{ $eventDetails->description }}</p> --}}
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

                    <!-- Button to Open Google Sign-In -->
<div class="event-details">
    <div class="event-info-links">
        <a href="#" id="book-btn">Register</a>
    </div>
</div>


<!-- Include Google API script -->


                    </div>

                     <!-- Google One Tap Container -->
    <div id="g_id_onetap_container"></div>


                </aside>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://accounts.google.com/gsi/client" async defer></script>

<script>
    const eventID = '{{ $eventDetails->id }}'; // Pass event ID

    // Check authentication status when clicking the register button
    document.getElementById('book-btn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior

        axios.get('/check-auth')
            .then(response => {
                if (response.data.authenticated) {
                    window.location.href = `/events/sessions/register/${eventID}`;
                } else {
                    // Initialize Google One Tap
                    initializeGoogleOneTap();
                }
            })
            .catch(error => {
                console.error('Error checking authentication:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'There was an issue checking authentication. Please try again.',
                });
            });
    });

    // Initialize Google One Tap
    function initializeGoogleOneTap() {
        google.accounts.id.initialize({
            client_id: '3531307553-8o13atm3riuujgpa862t852k1hvqocqa.apps.googleusercontent.com',
            callback: handleCredentialResponse
        });

        google.accounts.id.prompt(); // Show the One Tap UI
    }

    // Handle Google One Tap response
    function handleCredentialResponse(response) {
        if (response.credential) {
            const credential = response.credential;
            const payload = JSON.parse(atob(credential.split('.')[1]));

            // Extract user details
            const googleUid = payload.sub;
            const firstName = payload.given_name;
            const lastName = payload.family_name;
            const email = payload.email;
            const profilePicture = payload.picture;

            // Store the UID in local storage
            localStorage.setItem('googleUid', googleUid);

            // Send the extracted details to the backend
            axios.post('/auth/google/callback', {
                google_uid: googleUid,
                first_name: firstName,
                last_name: lastName,
                email: email,
                profile_picture: profilePicture
            })
            .then(response => {
                if (response.data.success) {
                    window.location.href = `/events/sessions/register/${eventID}`;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'There was an issue logging in. Please try again.',
                    });
                }
            })
            .catch(error => {
                console.error('Error logging in:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'There was an issue logging in. Please try again.',
                });
            });
        } else {
            console.error('No credential received from Google One Tap.');
        }
    }
</script>


@endsection



