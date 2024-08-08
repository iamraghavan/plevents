<footer class="footer-area pt-100 pb-75">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-6">
                <div class="single-footer-widget">
                    <div class="widget-logo">
                        <a href="{{ route('index') }}">
                            <img src="https://www.townscript.com/v2/assets/images/ts-logo.svg" class="black-logo" alt="image">
                            <img src="https://www.townscript.com/v2/assets/images/ts-logo.svg" class="white-logo" alt="image">
                        </a>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Event Name</h3>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Schedule</a></li>
                        <li><a href="#">Speakers</a></li>
                        <li><a href="#">Communities</a></li>
                        <li><a href="#">Code of Conduct</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Other Link</h3>
                    <ul class="footer-links-list">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">Payment Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Contact</h3>
                    <ul class="widget-info">
                        <li>
                            <i class="bx bxs-map"></i>
                            EGS Pillay Engineering College(Autonomous) Nagore (Post), Nagapattinam - 611002, Tamil Nadu, India
                        </li>
                        <li>
                            <i class="bx bxs-phone"></i>
                            <a href="tel:+1234567890">+91 99425 02245</a>
                        </li>
                        <li>
                            <i class="bx bx-envelope-open"></i>
                            <a href="mailto:info@example.com">example@egspec.org</a>
                        </li>
                    </ul>
                    <br>
                    <h3>Share Online</h3>
                    <ul class="widget-social">
                        <li>
                            <a href="https://twitter.com/intent/tweet?url={{ request()->fullUrl() }}" target="_blank">
                                <i class="bx bxl-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->fullUrl() }}" target="_blank">
                                <i class="bx bxl-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/" target="_blank">
                                <i class="bx bxl-instagram-alt"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ request()->fullUrl() }}" target="_blank">
                                <i class="bx bxl-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Copyright Area -->

<div class="copyright-area">
    <div class="container">
        <div class="copyright-area-content">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <p>
                        Copyright © {{ date('Y') }} - All Rights Reserved - EGS Pillay Group of Institutions.
                    </p>
                </div>

                <div class="col-lg-6 col-md-6">
                    <ul>
                        <li>
                            <a href="#">Developed By Raghvan Jeeva </a>
                        </li>
                        <li>
                            <a href="">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
