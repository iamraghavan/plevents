<div class="navbar-area">
    <div class="main-responsive-nav">
        <div class="container">
            <div class="main-responsive-menu mean-container">
                <div class="mean-bar">
                    <a href="#nav" class="meanmenu-reveal" style="right: 0px; left: auto; text-align: center; text-indent: 0px; font-size: 18px;">
                        <span><span><span></span></span></span>
                    </a>
                    <nav class="mean-nav">
                        <ul class="navbar-nav m-auto" style="display: none;">
                            <li class="nav-item"><a href="{{ route('index') }}" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Schedule</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Speakers</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Communities</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Code of Conduct</a></li>
                            @if(Auth::check())
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <img src="{{ Auth::user()->profile_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle profile-img">
                                    <span class="profile-name">{{ Auth::user()->name }}</span>
                                    <i class="bx bx-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu" style="display: none;">
                                    <li class="nav-item"><a href=" " class="nav-link">Dashboard</a></li>
                                    <li class="nav-item"><a href=" " class="nav-link">Profile</a></li>
                                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Logout</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="logo">
                    <a href="{{ route('index') }}">
                        <img src="https://www.townscript.com/v2/assets/images/ts-logo.svg" class="black-logo" alt="image">
                        <img src="https://www.townscript.com/v2/assets/images/ts-logo.svg" class="white-logo" alt="image">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-navbar">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="https://www.townscript.com/v2/assets/images/ts-logo.svg" class="black-logo" alt="image">
                    <img src="https://www.townscript.com/v2/assets/images/ts-logo.svg" class="white-logo" alt="image">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item"><a href="{{ route('index') }}" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Schedule</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Speakers</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Communities</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Code of Conduct</a></li>
                        @if(Auth::check())
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="{{ Auth::user()->profile_url }}" alt="{{ Auth::user()->name }} Profile" class="rounded-circle profile-img">
                                <span class="profile-name">{{ Auth::user()->name }}</span>
                                <i class="bx bx-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href=" " class="nav-link">Dashboard</a></li>
                                <li class="nav-item"><a href=" " class="nav-link">Profile</a></li>
                                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Logout</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>


                </div>
            </nav>
        </div>
    </div>


</div>


<style>/* Container for the profile item */


    /* Style for the profile image */
    .profile-img {
        width: 40px; /* Adjust the size as needed */
        height: 40px; /* Maintain aspect ratio */
        object-fit: cover; /* Ensure the image fits well */
        border-radius: 50%; /* Makes the image rounded */
    }

    /* Style for the profile name */
    .profile-name {
        margin-left: 10px; /* Space between image and name */
    }

    /* Style for the dropdown menu */
    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #fff; /* Background color of the dropdown */
        border: 1px solid #ddd; /* Border for the dropdown */
        border-radius: 4px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Subtle shadow */
        z-index: 1000; /* Ensure dropdown is on top of other elements */
    }

    /* Style for dropdown menu items */
    .dropdown-menu .nav-item {
        border-bottom: 1px solid #000; /* Black border at the bottom of each item */
    }

    .dropdown-menu .nav-item:last-child {
        border-bottom: none; /* Remove border from the last item */
    }

    /* Style for dropdown menu links */
    .dropdown-menu .nav-link {
        display: block;
        padding: 10px 15px; /* Padding inside the dropdown items */
        color: #333; /* Text color */
        text-decoration: none; /* Remove underline */
    }

    /* Hover effect for dropdown links */
    .dropdown-menu .nav-link:hover {
        background-color: #f0f0f0; /* Background color on hover */
    }
    </style>
