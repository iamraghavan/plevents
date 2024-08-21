@extends('layout.app')
@section('content')

<x-page-banner
    title="Events"
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('index')],
        ['label' => 'Pages', 'url' => '#'],
        ['label' => 'Events']
    ]"
/>
@php
  use App\Helpers\SlugHelper;
@endphp
<div class="events-schedules-area ptb-100">
    <div class="container">
        <div class="row">
            <!-- Mobile Filter Button -->
            <div class="col-12 d-md-none mb-3">
                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#filterCanvas" aria-controls="filterCanvas">
                    <i class="bx bx-slider-alt"></i> Filters
                </button>
            </div>

            <!-- Off-Canvas Filter Section -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="filterCanvas" aria-labelledby="filterCanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="filterCanvasLabel">Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form method="GET" action="{{ route('events.index') }}">
                        <!-- Venue Filter -->
                        <div class="form-group">
                            <label for="venue">Venue</label>
                            <select name="venue" id="venue" class="form-control">
                                <option value="">All Venues</option>
                                @foreach($venues as $venue)
                                    <option value="{{ $venue }}" {{ request()->get('venue') == $venue ? 'selected' : '' }}>{{ $venue }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Department Filter -->
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select name="department" id="department" class="form-control">
                                <option value="">All Departments</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department }}" {{ request()->get('department') == $department ? 'selected' : '' }}>{{ $department }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Mode Filter -->
                        <div class="form-group">
                            <label for="mode">Mode</label>
                            <select name="mode" id="mode" class="form-control">
                                <option value="">All Modes</option>
                                <option value="Online" {{ request()->get('mode') == 'Online' ? 'selected' : '' }}>Online</option>
                                <option value="Offline" {{ request()->get('mode') == 'Offline' ? 'selected' : '' }}>Offline</option>
                            </select>
                        </div>

                        <!-- Price Type Filter -->
                        <div class="form-group">
                            <label for="price_type">Price Type</label>
                            <select name="price_type" id="price_type" class="form-control">
                                <option value="">All Types</option>
                                <option value="Free" {{ request()->get('price_type') == 'Free' ? 'selected' : '' }}>Free</option>
                                <option value="Paid" {{ request()->get('price_type') == 'Paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Apply Filters</button>
                    </form>
                </div>
            </div>

            <!-- Desktop Filter Section -->
            <div class="col-md-3 d-none d-md-block">
                <h4>Filters</h4>
                <form method="GET" action="{{ route('events.index') }}">
                    <!-- Venue Filter -->
                    <div class="form-group">
                        <label for="venue">Venue</label>
                        <select name="venue" id="venue" class="form-control">
                            <option value="">All Venues</option>
                            @foreach($venues as $venue)
                                <option value="{{ $venue }}" {{ request()->get('venue') == $venue ? 'selected' : '' }}>{{ $venue }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Department Filter -->
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select name="department" id="department" class="form-control">
                            <option value="">All Departments</option>
                            @foreach($departments as $department)
                                <option value="{{ $department }}" {{ request()->get('department') == $department ? 'selected' : '' }}>{{ $department }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Mode Filter -->
                    <div class="form-group">
                        <label for="mode">Mode</label>
                        <select name="mode" id="mode" class="form-control">
                            <option value="">All Modes</option>
                            <option value="Online" {{ request()->get('mode') == 'Online' ? 'selected' : '' }}>Online</option>
                            <option value="Offline" {{ request()->get('mode') == 'Offline' ? 'selected' : '' }}>Offline</option>
                        </select>
                    </div>

                    <!-- Price Type Filter -->
                    <div class="form-group">
                        <label for="price_type">Price Type</label>
                        <select name="price_type" id="price_type" class="form-control">
                            <option value="">All Types</option>
                            <option value="Free" {{ request()->get('price_type') == 'Free' ? 'selected' : '' }}>Free</option>
                            <option value="Paid" {{ request()->get('price_type') == 'Paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Apply Filters</button>
                </form>
            </div>

            <!-- Event Listings -->
            <div class="col-md-9">
                <div class="section-title">
                    <span>Event Schedules</span>
                    <h2>Upcoming Event Schedules</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam quis nostrud exercitation ullamco.</p>
                </div>

                <div class="row justify-content-center">
                    @foreach($events as $event)
                        <div class="col-lg-6 col-md-6 mb-4">
                            <div class="single-events-schedules">
                                <div class="events-image">
                                    <a href="{{ route('index', $event->id) }}">
                                        <img src="{{ asset('assets/images/events.webp') }}" alt="image">
                                    </a>
                                    <div class="tag">
                                        <a href="{{ route('events.index', ['category' => $event->department]) }}">
                                            {{ $event->department }}
                                        </a>
                                    </div>
                                </div>

                                <div class="events-content">
                                    <span>
                                        <i class="bx bx-calendar"></i>
                                        {{ \Carbon\Carbon::parse($event->start_time)->format('d/m/Y') }}
                                    </span>
                                    <h3>
                                        <a href="{{ route('index', $event->id) }}">
                                            {{ $event->title }}
                                        </a>
                                    </h3>
                                    <p>{{ $event->description }}</p>

<hr>

                                    <p>{{ $event->conducted_by }}</p>
                                            <p>{{ $event->location }} - {{ $event->venue }}</p>
                                            <hr>
                                    <div class="bottom-content">
                                        <div class="">
                                            <a href="{{ route('events.show', ['slug' => $event->slug]) }}" class="book-btn-one">
                                                <i class="bx bx-arrow-to-right"></i> View Event
                                            </a>




                                        </div>

                                        <div class="book-btn">
                                            <a href="{{  }}" class="book-btn-one">
                                                <i class="bx bx-arrow-to-right"></i>
                                                {{ $event->mode == 'online' ? 'Join Now' : 'Book Now' }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="pagination-area">
                            {{ $events->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection

<style>
    .form-group .form-control {
    height: auto;
    color: #a0a6ab;
    border: 1px solid #ebebeb;
    background-color: #ffffff;
    display: block;
    width: 100%;
    border-radius: 10px;
    padding: 25px;
    transition: 0.6s;
    font-size: 15px;
    font-weight: 400;
    outline: 0;
    font-family: "Poppins", sans-serif;
}
</style>
