<!-- resources/views/components/hero-section.blade.php -->
<div class="main-banner-area-box" x-data="countdownTimer()" x-init="startTimer()">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="main-banner-content-box">
                    <p class="sub-title wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="2000ms">Our Upcoming Events:</p>
                    <h1 class="wow fadeInUp animated" data-wow-delay="100ms" data-wow-duration="1000ms">EGSPEC Biggest Event 2024</h1>

                    <div class="banner-soon-content wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="2000ms">
                        <div id="timer">
                            <div id="days" x-text="days"></div>
                            <div id="hours" x-text="hours"></div>
                            <div id="minutes" x-text="minutes"></div>
                            <div id="seconds" x-text="seconds"></div>
                        </div>
                    </div>

                    <ul class="banner-list wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="2000ms">
                        <li><i class="bx bx-calendar"></i> 05/08/2024</li>
                        <li>GLOBAL AZURE 2024-CHENNAI</li>
                    </ul>

                    <ul class="banner-btn-list wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="2000ms">
                        <li><a href="#" class="default-btn"><i class="bx bx-arrow-to-right"></i> Register Now<span></span></a></li>
                        <li class="calender-btn"><i class="bx bxs-plus-circle"></i> <a href="#">Add a Calendar</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="main-banner-image-wrap wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="2000ms">
                    <img src="{{ asset('assets/h-img.webp') }}" alt="image">
                </div>
            </div>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    function countdownTimer() {
        var endTime = new Date("August 10, 2024 11:30:00 GMT+0530"),
            endTime = endTime.getTime() / 1000,
            now = new Date(),
            now = now.getTime() / 1000,
            timeLeft = endTime - now,
            days = Math.floor(timeLeft / 86400),
            hours = Math.floor((timeLeft - 86400 * days) / 3600),
            minutes = Math.floor((timeLeft - 86400 * days - 3600 * hours) / 60),
            seconds = Math.floor(
              timeLeft - 86400 * days - 3600 * hours - 60 * minutes
            );

        hours < 10 && (hours = "0" + hours),
        minutes < 10 && (minutes = "0" + minutes),
        seconds < 10 && (seconds = "0" + seconds);

        $("#days").html(days + "<span>Days</span>");
        $("#hours").html(hours + "<span>Hours</span>");
        $("#minutes").html(minutes + "<span>Minutes</span>");
        $("#seconds").html(seconds + "<span>Seconds</span>");

        setTimeout(countdownTimer, 1000);
    }

    countdownTimer();
</script>
