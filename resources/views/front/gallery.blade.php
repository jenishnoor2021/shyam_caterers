@extends('layouts.front')

@section('content')

<section class="inner-banner">
    <div class="image-layer" style="background-image: url({{asset('front_assets/images/background/about-bg.jpg')}})"></div>
    <div class="auto-container">
        <div class="inner">
            <h1><span>Gallery</span></h1>
        </div>
    </div>
</section>

<!-- Wedding Catering -->
@foreach($eventGalleries as $section)
<section class="team-section">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-1.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-6.png')}}" alt="" title="" loading="lazy"></div>
    <div class="auto-container">
        <h2 class="team-heading" style="padding: 20px;">{{ $section['event']->event_type }}</h2>

        <div class="owl-carousel gallery-carousel owl-theme">
            @foreach($section['galleries'] as $gallery)
            <div class="item">
                <a href="{{ asset($gallery->file) }}" data-fancybox="wedding">
                    <img src="{{ asset($gallery->file) }}" alt="" loading="lazy">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endforeach

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