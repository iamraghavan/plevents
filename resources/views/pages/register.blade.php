    @extends('layout.app')

    @section('content')


    <div class="container mt-5">
        <div class="row">
        <div class="col-lg-7">
            <div class="register-form">
                <h2>Register for Event</h2>
            <form id="registration-form" action="{{route('register')}}" method="POST">
                @csrf

                <!-- Hidden fields for event ID and Google UID -->
                <input type="hidden" name="event_id" id="event_id" value="{{ $selectedEvent ? $selectedEvent->id : '' }}">
                <input type="hidden" id="google_uid" name="google_uid" value="">

                <!-- Event Title (Dropdown) -->
                <div class="form-group">
                    <label for="event_title">Event :</label>
                    <select class="form-control" id="event_title" name="event_title" required>
                        <option value="">Select an Event</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ $selectedEvent->id == $event->id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ Auth::check() ? Auth::user()->name : old('name') }}"
                        {{ Auth::check() ? '' : '' }} required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                        {{ Auth::check() ? 'readonly' : '' }} required>
                </div>

                <!-- Phone (with country dropdown and validation) -->
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                    <small id="phone-error" class="text-danger"></small>
                </div>


                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address_1" name="address"
                        value="{{ old('address') }}" required>
                </div>

                <div class="form-group">
                    <label for="country">Country:</label>
                    <select class="form-control" id="country" name="country" required>
                        <option value="">Select Country</option>
                        <!-- Dynamically populated -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="state">State:</label>
                    <select class="form-control" id="state" name="state" required>
                        <option value="">Select State</option>
                        <!-- Dynamically populated -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ old('city') }}" required>
                </div>


                <!-- Pincode -->
                <div class="form-group">
                    <label for="pincode">Pincode:</label>
                    <input type="text" class="form-control" id="pincode" name="pincode"
                        value="{{ old('pincode') }}" maxlength="10" required>
                    <small id="pincode-error" class="text-danger"></small>
                </div>

                <!-- Amount -->
                <div class="form-group" id="amount-group">
                    <label for="amount">Amount (INR):</label>
                <input type="number" class="form-control" id="amount" name="amount"
                    value="{{ $selectedEvent ? $selectedEvent->amount : '' }}" readonly>
                </div>
                <p class="description">By registering for this event, you agree to the <a href="#terms-and-conditions">terms and conditions</a> and <a href="#payment-policy">payment policy</a> outlined below. Please ensure you have read and understood them before proceeding with your registration.</p>
                <!-- Submit Button -->

                <button type="submit" class="default-btn">Register <span></span></button>

            </form>


            </div>
        </div>



        <div class="col-lg-5">
            <!-- Event details here -->
            <div class="captureCard card border-0">
                <div class="card-body d-flex flex-column justify-content-between text-white p-0">
                    <div class="p-4 bg-top">
                        <div class="d-flex flex-row justify-content-center">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <h1 id="event-title" class="text-white text-align-center"></h1>
                                <span id="event-location" class="mb-2 text-white"></span>
                                <span id="event-date-time"></span>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <i class="fa fa-calendar fa-3x"></i>
                            </div>

                        </div>
                    </div>
                    <div class="bg-danger p-4">
                        <div class="d-flex flex-column justify-content-between">
                            <div class="d-flex flex-row justify-content-between text-center">
                                <div>
                                    <span id="event-department" class="mb-2"></span> |
                                    <span id="event-mode"></span>
                                </div>
                                <div>

                                    <span id="event-price-type"></span>
                                </div>
                                <div>
                                    <span class=" mb-2 font-weight-bold">Amount</span> -
                                    <span id="event-amount"></span>
                                </div>
                            </div>
                            <div class="doted-lines">
                                <hr class="dotted-line">
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <div class="d-flex flex-column">
                                    <div>

                                        <span id='event-venue'></span> |
                                        <span id="event-name">{{ Auth::check() ? Auth::user()->name : old('name') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="d-flex flex-column">
                                    <div class="qr-code">
                                        {!! $qrCode !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
    $welcomeMessage = 'Get ready for an unforgettable experience! I just registered for the event.';
@endphp

                    <div class="card-footer bg-top p-3">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="d-flex flex-column">

                                <div class="social-icons d-flex flex-row">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}&quote={{ urlencode($welcomeMessage) }}" target="_blank" class="mr-5">
                                        <i class="bx bxl-facebook" style="font-size: 24px; color: #fff;"></i>
                                    </a>

                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($welcomeMessage) }} {{ urlencode(request()->fullUrl()) }}" target="_blank" class="mr-5">
                                        <i class="bx bxl-whatsapp" style="font-size: 24px; color: #fff;"></i>
                                    </a>

                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($welcomeMessage) }}&summary=&source=" target="_blank" class="mr-5">
                                        <i class="bx bxl-linkedin" style="font-size: 24px; color: #fff;"></i>
                                    </a>

                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($welcomeMessage) }}" target="_blank" class="mr-5">
                                        <i class="bx bxl-twitter" style="font-size: 24px; color: #fff;"></i>
                                    </a>

                                    <a href="mailto:?subject={{ urlencode($welcomeMessage) }}&body={{ urlencode(request()->fullUrl()) }}" target="_blank" class="mr-5">
                                        <i class="bx bxs-envelope" style="font-size: 24px; color: #fff;"></i>
                                    </a>

                                    <a href="#" target="_blank" class="mr-5">
                                        <i class="bx bxl-rss" style="font-size: 24px; color: #fff;"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#" id="download" class="btn btn-success"><i class="bx bx-download" style="font-size: 18px; margin-right: 5px;"></i> Download Image</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>





        </div>
    </div>

    <style>
        .bg-blue {
            background: blue;
        }

        .dotted-line {
            border: 1px dashed #fff;
        }

        .img-fluid {
            width: 114px;
            height: auto;
        }

        .bg-top {
            background: #8E24AA;
        }

        .card-footer {
            border-top: 1px solid #ddd;
        }

        .qr-code {

            border: 1rem solid #fff;
            padding: 1rem;
            margin: 1rem
        }

        .qr-code svg {
            width: 100%;
            height: 100%;
        }


        .social-icons a {
    margin-right: 10px;
    color: #fff;
}

.social-icons a:hover {
    /* color: #fff; */
    text-decoration: none;
}

.card-footer .btn-success {
    background-color: #dc3545;
    border-color: #dc3545;
    color: #fff;
}

.card-footer .btn-success:hover {
    background-color: #dc354681;
    border-color: #dc354681;
    color: #fff;
}

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.3.4/build/css/intlTelInput.css">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.3.4/build/js/intlTelInput.min.js"></script>
    <script>



    const input = document.querySelector("#phone");
    window.intlTelInput(input, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.3.4/build/js/utils.js",
        autoPlaceholder: "off",
        nationalMode: false,
        separateDialCode: true,
        initialCountry: "in", // Set India as the default country
        preferredCountries: ["in"],
        format: "international", // Add this option to display country code
    });

    // Set the default country code to +91 (India)
    input.value = "+91";

    input.addEventListener("keyup", () => {
        const isValid = input.getAttribute("data-valid");
        if (isValid === "true") {
        input.classList.add("valid");
        input.classList.remove("error");
        } else {
        input.classList.add("error");
        input.classList.remove("valid");
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
            const googleUid = @json(session('google_uid'));

            if (googleUid) {
                const googleUidInput = document.getElementById('google_uid');
                if (googleUidInput) {
                    googleUidInput.value = googleUid;
                } else {
                    console.error('Google UID input field not found.');
                }
            } else {
                console.log('Google UID not found in session.');
            }

            const eventTitleSelect = document.getElementById('event_title');
            const amountInput = document.getElementById('amount');
            const amountGroup = document.getElementById('amount-group');
            const eventIdInput = document.getElementById('event_id');

            eventTitleSelect.addEventListener('change', function() {
                const selectedEventId = eventTitleSelect.value;
                const selectedEvent = @json($events).find(event => event.id == selectedEventId);

                if (selectedEvent) {
                    eventIdInput.value = selectedEvent.id;
                    amountInput.value = selectedEvent.amount;

                    // Reflect ID and title in the URL
                    const url = new URL(window.location.href);
                    url.searchParams.set('id', selectedEvent.id);
                    url.searchParams.set('title', encodeURIComponent(selectedEvent.title));
                    window.history.replaceState({}, '', url);

                    // Hide or disable the amount field if the event is free or the amount is 0
                    if (selectedEvent.price_type === 'free' || selectedEvent.amount == 0) {
                        amountGroup.style.display = 'none'; // Hide the amount field
                        amountInput.disabled = true; // Disable the amount input
                    } else {
                        amountGroup.style.display = ''; // Show the amount field
                        amountInput.disabled = false; // Enable the amount input
                    }
                }
            });

            // Trigger change event on page load to handle pre-selected event
            eventTitleSelect.dispatchEvent(new Event('change'));
        });


        const eventTitleSelect = document.getElementById('event_title');
    const events = @json($events);

    eventTitleSelect.addEventListener('change', function() {
        const selectedEventId = eventTitleSelect.value;
        const selectedEvent = events.find(event => event.id == selectedEventId);

        if (selectedEvent) {
            document.getElementById('event-title').textContent = selectedEvent.title;
            document.getElementById('event-location').textContent = selectedEvent.location;
            document.getElementById('event-date-time').textContent = selectedEvent.date + ' ' + selectedEvent.start_time;
            document.getElementById('event-department').textContent = selectedEvent.department;
            document.getElementById('event-mode').textContent = selectedEvent.mode;
            document.getElementById('event-price-type').textContent = selectedEvent.price_type;
            document.getElementById('event-amount').textContent = selectedEvent.amount + ' INR';
            document.getElementById('event-venue').textContent = selectedEvent.venue;
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        const eventNameSpan = document.getElementById('event-name');
        const nameInput = document.getElementById('name');

        nameInput.addEventListener('input', function() {
            eventNameSpan.textContent = nameInput.value;
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');

    // Fetch countries from Rest Countries API
    fetch('https://restcountries.com/v3.1/all')
        .then(response => response.json())
        .then(data => {
            data.forEach(country => {
                let option = document.createElement('option');
                option.value = country.cca2; // Use country code for fetching states
                option.text = country.name.common;
                countrySelect.add(option);
            });
        });

    // Handle country change
    countrySelect.addEventListener('change', function () {
        const countryCode = this.value;

        // Clear previous state and city options
        stateSelect.innerHTML = '<option value="">Select State</option>';
        citySelect.innerHTML = '<option value="">Select City</option>';

        if (countryCode) {
            // Fetch states from CountryStateCity API
            fetch(`https://countriesnow.space/api/v0.1/countries/states`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ iso2: countryCode })
            })
            .then(response => response.json())
            .then(data => {
                data.data.states.forEach(state => {
                    let option = document.createElement('option');
                    option.value = state.name;
                    option.text = state.name;
                    stateSelect.add(option);
                });
            });
        }
    });

    // Handle state change


});

const downloadButton = document.getElementById('download');

downloadButton.addEventListener('click', () => {


    const eventNameSpan = document.getElementById('event-name');
  const nameInput = document.getElementById('name');

  nameInput.addEventListener('input', function() {
    eventNameSpan.textContent = nameInput.value;
  });


  const card = document.querySelector('.captureCard');
  if (!card) {
    console.error("Element with class 'captureCard' not found!");
    return;
  }

  // Hide the footer content
  const footer = card.querySelector('.card-footer');
  footer.style.display = 'none';

  // Add the thanks note
const thanksNote = document.createElement('div');
  thanksNote.innerHTML = `
    Thank you so much for registering for the event! We’re excited to have you join us and look forward to seeing you there. Please don't hesitate to reach out if you have any questions or need further information.

    Best regards,
    Dr. S.Palani Murugan
    E.G.S Pillay Engineering College
  `;
  thanksNote.style.fontSize = '18px';
  thanksNote.style.fontWeight = 'bold';
  thanksNote.style.color = '#000';
  thanksNote.style.padding = '10px';
  thanksNote.style.background = '#fff';
  card.appendChild(thanksNote);

  // Add the logo
  const logo = document.createElement('img');
logo.src = '/assets/images/logo_tran.svg';
logo.crossOrigin = 'anonymous'; // Add this attribute
logo.style.width = 'auto';
logo.style.height = '100px';
logo.style.margin = '20px auto';
logo.style.display = 'block';
card.appendChild(logo);

  // Add a white header background
  const header = card.querySelector('.card-body');
  header.style.background = '#fff';

  // Delay the html2canvas call until the elements are visible in the DOM
  setTimeout(() => {
    html2canvas(card, {
      useCORS: true,
      logging: true,
      scale: 2
    }).then(canvas => {
      const link = document.createElement('a');
      const randomNumber = Math.floor(10000 + Math.random() * 90000);
        link.download = `egspec-event-${randomNumber}.png`;
      link.href = canvas.toDataURL();
      link.click();

      // Remove the added elements
      thanksNote.remove();
      logo.remove();
      footer.style.display = 'block';
      header.style.background = '';
    });
  }, 100);
});


    </script>


    @endsection
