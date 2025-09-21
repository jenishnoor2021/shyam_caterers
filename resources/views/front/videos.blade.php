@extends('layouts.front')

@section('content')

<section class="inner-banner">
    <div class="image-layer" style="background-image: url({{asset('front_assets/images/background/about-bg.jpg')}})"></div>
    <div class="auto-container">
        <div class="inner">
            <h1><span>Videos</span></h1>
        </div>
    </div>
</section>

<!-- Wedding Catering -->

<section class="team-section">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-1.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-6.png')}}" alt="" title="" loading="lazy"></div>
    <div class="auto-container">
        <div class="owl-carousel gallery-carousel owl-theme">
            @foreach($videos as $video)
            <div class="item">
                <video width="100" controls>
                    <source src="{{ $video->file }}" type="video/mp4" loading="lazy">
                    Your browser does not support the video tag.
                </video>
            </div>
            @endforeach
        </div>
    </div>
</section>


@endsection

@section('page_script')
<script>
    $(document).ready(function() {
        $(".gallery-carousel").owlCarousel({
            items: 3,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                },
            },
        });
    });
</script>
@endsection