<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="https://www.townscript.com/v2/assets/images/ts-logo.svg" alt="Eventsss Logo" width="120" height="30">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Speakers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Communities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Code of Conduct</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Dashboard</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('google.login') }}">Login with Google</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
/* Navbar background and link styling */
.navbar {
    background-color: #343a40; /* Dark background */
}
.navbar .navbar-nav .nav-item {
    margin: 0 1rem;
    font-weight: 700;
    text-transform: uppercase;
}

.navbar .navbar-brand img {
    max-height: 40px; /* Adjust logo size */
    width: auto;
}

.navbar .nav-link {
    color: #000; /* White text color */
    padding: 10px 15px;
    font-weight: 600;
    font-size: 1rem;
    transition: color 0.3s ease;
}

.navbar .nav-link:hover,
.navbar .nav-link.active {
    color: #fc5a1b; /* Highlight color */
}




/* Dropdown menu styling */
.navbar .dropdown-menu {
    background-color: #fff; /* Match the navbar background */
    border: none;
}

.navbar .dropdown-menu .dropdown-item {
    color: #000;
    transition: background-color 0.3s ease;
}

.navbar .dropdown-menu .dropdown-item:hover {
    background-color: #495057;
}

/* Toggle button styling */
.navbar-toggler {
    border: none;
}

.navbar-toggler-icon {
    background-image: url('data:image/svg+xml;charset=UTF8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"%3E%3Cpath stroke="rgba%2888, 88, 88, 0.7%29" stroke-width="2" linecap="round" linejoin="round" d="M4 7h22M4 15h22M4 23h22"/%3E%3C/svg%3E');
}

/* Mobile dropdown styling */
@media (max-width: 991.98px) {
    .navbar .navbar-brand {
        margin-left: 0; /* Remove any automatic centering */
        margin-right: auto; /* Ensure it stays left */
    }
    .navbar .navbar-nav {
        background-color: #ffffff;
    }

    .navbar .navbar-nav .nav-item {
        padding: 0.5rem;
        border-bottom: 2px solid #bfbfbf;
    }

    .navbar .dropdown-menu {
        position: static;
        float: none;
        width: auto;
        margin-top: 0;
        background-color: #cfcfcf;
    }
}
</style>
