<div class="speakers-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h2>{{ $title }}</h2>
            <p>{{ $description }}</p>
        </div>

        <div class="row justify-content-center">
            @foreach($speakers as $speaker)
                <div class="col-lg-3 col-md-6">
                    <div class="single-speakers">
                        <div class="speakers-image">
                            <a href="{{ $speaker['profileUrl'] }}"><img src="{{ $speaker['imageUrl'] }}" alt="image"></a>
                        </div>

                        <div class="speakers-content">
                            <h3>
                                <a href="{{ $speaker['profileUrl'] }}">{{ $speaker['name'] }}</a>
                            </h3>
                            <span>{{ $speaker['title'] }}</span>

                            <ul class="social">
                                @foreach($speaker['socialLinks'] as $platform => $url)
                                    <li>
                                        <a href="{{ $url }}" target="_blank"><i class="bx bxl-{{ $platform }}"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="view-all-btn">
            <a href="{{ $viewAllUrl }}" class="default-btn"><i class="bx bx-chevron-right"></i> View All Speakers<span></span></a>
        </div>
    </div>
</div>
