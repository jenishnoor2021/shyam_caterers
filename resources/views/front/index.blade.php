@extends('layouts.front')

@section('page_style')

@endsection

@section('content')
<!-- Banner Section -->
<section class="banner-section" style="z-index: 1">
    <div class="banner-container">
        @if($slider && Str::endsWith($slider->file, ['.mp4', '.webm', '.ogg']))
        <video autoplay="" muted="" loop="" playsinline="" class="banner-video">
            <source src="{{ asset($slider->file) }}" type="video/mp4">
        </video>
        @else
        <!-- Show default fallback video -->
        <video autoplay="" muted="" loop="" playsinline="" class="banner-video">
            <source src="{{ asset('/defaults/slider.mp4') }}" type="video/mp4">
        </video>
        @endif
        <div class="auto-container mt-5">
            <div class="content-box">
                <div class="content ">
                    <div class="clearfix">
                        <div class="inner">
                            <h1 class="main-heading "> Crafting Culinary Experiences</h1>
                            <h1 class="main-heading1">for All Your Events.</h1>
                            <a href="{{URL::to('/contact')}}" type="submit" class="theme-btn btn-style-one clearfix">
                                <span class="btn-wrap">
                                    <span class="text-one">Contact Us</span>
                                    <span class="text-two">Contact Us</span>
                                </span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--End Banner Section -->


<!--<ins class="adsbygoogle"-->
<!--     style="display:block"-->
<!--     data-ad-client="ca-pub-2600387064208986"-->
<!--     data-ad-slot="5176367379"-->
<!--     data-ad-format="auto"-->
<!--     data-full-width-responsive="true"></ins>-->
<!--<script>-->
<!--     (adsbygoogle = window.adsbygoogle || []).push({});-->
<!--</script>-->

<!--We Offer Section-->
<section class="we-offer-section">
    <div class="left-bot-bg"><img src="{{ asset('front_assets/images/background/bg-1.png') }}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{ asset('front_assets/images/background/bg-2.png') }}" alt="" title="" loading="lazy"></div>
    <div class="auto-container">
        <div class="title-box centered">

            <h2>We Celebrate Flavor, Culture,<br> and Connection.</h2>
            <div class="text">We use finest, freshest ingredients to design dishes that not only look stunning
                but taste extraordinary. From timeless traditional classics to innovative fusion creations,
                we’ve options to suit every palate. </div>
        </div>
        <div class="row justify-content-center clearfix">

            <?php
            $defaultImages = [
                '/defaults/dishe-1.jpg',
                '/defaults/dishe-2.jpg',
                '/defaults/dishe-3.jpg'
            ];

            $dishImages = [];
            $dishImagesDelay = ['0', '300', '600'];

            foreach ($dishes as $dish) {
                $dishImages[] = $dish->file;
            }

            // Fill with defaults if less than 3
            while (count($dishImages) < 3) {
                $dishImages[] = array_shift($defaultImages);
            }
            ?>

            <!--Block-->
            @foreach ($dishImages as $index => $image)
            <div class="offer-block col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="{{$dishImagesDelay[$index]}}ms">
                    <div class="image"><a href="#"><img src="{{ asset($image) }}" alt="" loading="lazy"></a></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!--Story Section-->
<section class="story-section">
    <div class="left-bot-bg"><img src="{{ asset('front_assets/images/background/bg-25.png') }}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{ asset('front_assets/images/background/bg-5.png') }}" alt="" title="" loading="lazy"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <!--Col-->
            <div class="text-col col-xl-5 col-lg-5 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="title-box centered">
                        <div class="subtitle"><span>ABOUT US</span></div>
                        <div class="pattern-image2"><img src="{{ asset('front_assets/images/icons/separator.svg') }}" alt="" title="" loading="lazy"></div>
                        <h2>Catering Our Way For All Your Special Occasion.
                        </h2>
                        <div class="text">SHYAM CATERERS is renowned as one of the best caterers in India,
                            established for 37+ years. Founded on a love for exceptional cuisine and memorable
                            experiences, we specialize in creating delightful culinary moments that bring people
                            together.<br>

                            We pride ourselves on crafting customized menus that cater to your tastes, preferences
                            and event needs. Whether you’re hosting a lavish wedding function, or a corporate event,
                            our excellent team ensures every detail is flawlessly executed.
                        </div>
                    </div>
                    <div class="booking-info">

                        <div class="link-box">
                            <a href="{{ URL::to('/contact') }}" class="theme-btn btn-style-two clearfix">
                                <span class="btn-wrap">
                                    <span class="mobile"><i class="icon far fa-phone"></i> +91 {{ $surat_contact }}</span>
                                    <span class="text-two"><i class="icon far fa-phone"></i> +91 {{ $surat_contact }}</span>
                                </span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <!--Col-->
            <div class="image-col col-xl-7 col-lg-7 col-md-12 col-sm-12">
                <div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">

                    <div class="images parallax-scene-1">
                        <div class="image" data-depth="0.15"><img src="{{ asset('front_assets/images/resource/bhujiya2.jpg') }}" alt="" class="bhujiya" loading="lazy"></div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!--Special Offer Section-->
<section class="special-offer">

    <div class="outer-container">
        <div class="left-bot-bg"><img src="{{ asset('front_assets/images/background/bg-1.png') }}" alt="" title="" loading="lazy"></div>
        <div class="right-top-bg"><img src="{{ asset('front_assets/images/background/bg-2.png') }}" alt="" title="" loading="lazy"></div>
        <div class="auto-container">
            <div class="title-box centered">
                <div class="special-offer-heading"><span>What We Do?</span></div>
                <div class="pattern-image"><img src="{{ asset('front_assets/images/icons/separator.svg') }}" alt="" title="" loading="lazy"></div>
                <div class="special-offer-paragraph">SHYAM CATERERS, we specialize in creating unforgettable culinary experiences for every
                    occasion. Whether it’s a grand celebration or a corporate event, our catering service is here to
                    make your event truly exceptional.
                </div>
            </div>
            <div class="dish-gallery-slider owl-theme owl-carousel">
                <!--Slide Item-->
                @foreach ($eventTypes as $index => $eventtype)
                <div class="offer-block-two {{$index % 2 == 0 ? 'mt-3' : 'margin-top'}}">
                    <div class="inner-box">
                        <div class="image"><a href="{{ route('site.event', $eventtype->id) }}"><img src="{{ asset($eventtype->file) }}" alt="" class="image {{$index % 2 == 0 ? '7' : '6'}}" loading="lazy"></a>
                        </div>
                        <h4><a href="{{ route('site.event', $eventtype->id) }}">{{ $eventtype->event_type }}</a></h4>
                        <div class="text desc"><span class="para-color">{{ \Illuminate\Support\Str::limit($eventtype->detail, 100, '...') }}</span></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="why-us">
    <div class="left-bot-bg"><img src="{{ asset('front_assets/images/background/bg-5.png') }}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{ asset('front_assets/images/background/bg-2.png') }}" alt="" title="" loading="lazy"></div>
    <div class="auto-container">
        <div class="title-box centered">
            <div class="subtitle"><span>WHY CHOOSE US</span></div>
            <div class="pattern-image2"><img src="{{ asset('front_assets/images/icons/separator.svg') }}" alt="" title="" loading="lazy"></div>
            <div class="why-us-paragraph">
                <div class="why-us-para">At Shyam Caterers & Event Management, we believe every occasion deserves to be celebrated with perfection. With a legacy that began in 1988, we bring over three decades of expertise, trust, and innovation to the table. Our strength lies in delivering authentic flavors with world-class presentation, supported by a highly professional and dedicated team. From intimate gatherings to grand weddings, corporate functions, and large-scale religious events with audiences of over 15 lakh, we ensure flawless planning, seamless execution, and unmatched hospitality. With multiple branches across Gujarat and a reputation built on quality and reliability, choosing us means choosing peace of mind, unforgettable experiences, and celebrations that your guests will always remember.</div>
            </div>
            <h2>Our Strength</h2>
        </div>
        <div class="row clearfix">
            <!--Block-->
            <div class="why-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="icon-box"><img src="{{ asset('front_assets/images/resource/why-icon-1.png') }}" alt="" loading="lazy"></div>
                    <h4>Premium & Quality Ingredients</h4>
                    <div class="text">We prioritize serving the highest quality to ensure every dish is bursting with extraordinary experiences.</div>
                </div>
            </div>

            <!--Block-->
            <div class="why-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                    <div class="icon-box"><img src="{{ asset('front_assets/images/resource/why-icon-3.png') }}" alt="" loading="lazy"></div>
                    <h4>Unmatched Expertise</h4>
                    <div class="text">With years of experience in catering service for all occasions: weddings, corporate events and outdoor events; our team knows how to deliver flawless service, every time.</div>
                </div>
            </div>

            <!--Block-->
            <div class="why-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                    <div class="icon-box"><img src="{{ asset('front_assets/images/resource/why-icon-2.png') }}" alt="" loading="lazy"></div>
                    <h4>Seamless Execution</h4>
                    <div class="text">From setup to cleanup, we handle every detail, allowing you to focus on enjoying the event.</div>
                </div>
            </div>

            <!--Block-->
            <div class="why-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="900ms">
                    <div class="icon-box"><img src="{{ asset('front_assets/images/resource/why-icon-4.png') }}" alt="" loading="lazy"></div>
                    <h4>Presentation that Speaks Volumes</h4>
                    <div class="text">We don’t just cook, we create. Each dish is designed to look as good as it tastes, adding a touch of elegance to your event.</div>
                </div>
            </div>

        </div>
    </div>
</section>

<div id="gallery-content">
</div>

<div id="reel-content">
</div>

@endsection

@section('page_script')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    window.addEventListener('load', function() {
        fetch('/load-gallery')
            .then(response => response.text())
            .then(html => {
                document.getElementById('gallery-content').innerHTML = html;

                $(".gallery-carousel").owlCarousel({
                    items: 2,
                    loop: true,
                    margin: 10,
                    nav:true,
                    navText: [ '<span class="icon fa-light fa-angle-left"></span>', '<span class="icon fa-light fa-angle-right"></span>' ],
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
                            items: 2,
                        },
                    },
                });
            });

        fetch('/load-reel')
            .then(response => response.text())
            .then(html => {
                document.getElementById('reel-content').innerHTML = html;

                console.log($('.reels-carousel .item').length);

                $(".reels-carousel").owlCarousel({
                    items: 3,
                    loop: true,
                    margin: 10,
                    autoplay: true,
                    center: true,
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
    });
</script>
@endsection