@extends('layout.app')
@section('content')

<x-hero-section />


<div class="about-us-area ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="about-us-image">
                    <picture>
                        <source srcset="https://via.placeholder.com/800x800.jpg" type="image/webp">
                        <img src="https://via.placeholder.com/800x800.jpg" alt="About Us Image">
                    </picture>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="about-us-content">
                    <span>Lorem ipsum dolor sit amet</span>
                    <h3>ABOUT THIS EVENT</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor. Nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh.</p>

                    <ul class="list">
                        <li><i class="bx bx-check"></i> Lorem ipsum dolor sit amet</li>
                        <li><i class="bx bx-check"></i> Lorem ipsum dolor sit amet</li>
                        <li><i class="bx bx-check"></i> Lorem ipsum dolor sit amet</li>
                        <li><i class="bx bx-check"></i> Lorem ipsum dolor sit amet</li>
                    </ul>

                    <div class="about-btn">
                        <a href="#" class="default-btn"><i class="bx bx-chevron-right"></i> About Us <span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="benefits-area pt-100 pb-75">
    <div class="container">
        <div class="section-title">
            <h2>Who Benefits?</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/2920/2920073.png" alt="Get Inspired Icon" style="width: 100px; height: 100px;">
                    <h3>Get Inspired</h3>
                    <p>Get motivated by industry leaders and innovators who will share their success stories and strategies.</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/2651/2651004.png" alt="Meet New Faces Icon" style="width: 100px; height: 100px;">
                    <h3>Meet New Faces</h3>
                    <p>Expand your professional network by meeting new people, from peers to mentors, in various industries.</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/4760/4760444.png" alt="Fresh Tech Insights Icon" style="width: 100px; height: 100px;">
                    <h3>Fresh Tech Insights</h3>
                    <p>Stay updated with the latest technological advancements and how they can benefit your business or career.</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/1256/1256655.png" alt="Networking Session Icon" style="width: 100px; height: 100px;">
                    <h3>Networking Session</h3>
                    <p>Join dedicated networking sessions to build meaningful connections with other professionals.</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/3905/3905597.png" alt="Global Event Icon" style="width: 100px; height: 100px;">
                    <h3>Global Event</h3>
                    <p>Be a part of a global event that brings together diverse perspectives and experiences from around the world.</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/1680/1680005.png" alt="Free Swags Icon" style="width: 100px; height: 100px;">
                    <h3>Free Swags</h3>
                    <p>Enjoy exclusive giveaways and swags that are a token of our appreciation for your participation.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<x-event-schedule
    eventDate="Saturday, April 27, 2024"
    eventTitle="Registration"
    registerUrl="https://egspec.org/register"
/>


<x-speakers-section
    title="Our Speakers"
    description="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam quis nostrud exercitation ullamco."
    viewAllUrl="#"
    :speakers="[
        ['profileUrl' => '#', 'imageUrl' => 'https://media.licdn.com/dms/image/D5603AQGtoIk0csT2_w/profile-displayphoto-shrink_200_200/0/1712483428471?e=2147483647&v=beta&t=VDPVymQRglsU8hbtisRaWCOrufMonV1-oOBWSFy-U0g', 'name' => 'Mr. J.S. Raghavan', 'title' => 'Developer & Business Consultant', 'socialLinks' => ['linkedin' => 'https://www.linkedin.com/', 'facebook' => 'https://www.facebook.com/']],
        // Add Extra Speakers Profile
    ]"
/>




<div class="partner-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h2>Event &amp; Venue Partner</h2>


        </div>
       <div class="partner-box">
          <div class="partner-slides owl-carousel owl-theme owl-loaded owl-drag">
             <div class="owl-stage-outer owl-height" style="height: 54.7656px;">
                <div class="owl-stage" style="transform: translate3d(-2292px, 0px, 0px); transition: all 0.5s ease 0s; width: 4584px;">
                    @foreach($partners as $partner)
                    <div class="owl-item cloned" style="width: 199.2px; margin-right: 30px;">
                        <div class="single-partner">
                            <a href="#"><img src="{{ $partner['image'] }}" alt="{{ $partner['name'] }}"></a>
                        </div>
                    </div>
                @endforeach
                </div>
             </div>
             <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="bx bx-chevron-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="bx bx-chevron-right"></i></button></div>
             <div class="owl-dots disabled"></div>
          </div>
       </div>
    </div>
 </div>

 <!-- CTA -->

 <div class="overview-area ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-12">
                <div class="overview-content">
                    <span>Hurry Up!</span>
                    <h3>Register Now</h3>
                    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis that bibendum auctor, nisi elit consequat  nec sagittis sem nibh id lorem elit.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="overview-btn">
                    <a href="" class="default-btn"><i class="bx bx-arrow-to-right"></i> Register Now<span style="top: -12.0625px; left: 163.562px;"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
