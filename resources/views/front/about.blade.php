@extends('layouts.front')

@section('page_style')
<style>
    #single-image-slider .owl-nav {
        position: absolute;
        top: 40%;
        transform: translateY(-50%);
        width: 100%;
    }

    #single-image-slider .owl-nav .owl-prev {
        left: 20px;
        position: absolute;
    }

    #single-image-slider .owl-nav .owl-next {
        right: 20px;
        position: absolute;
    }

    #single-image-slider .owl-dots {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 20px 0;
    }

    #single-image-slider .owl-dots .owl-dot {
        height: 12px;
        width: 12px;
        border: 1px solid #fff;
        border-radius: 50%;
        padding: 20px 0;
    }

    #single-image-slider .owl-dots .owl-dot.active {
        background: #fff;
    }
</style>
@endsection

@section('content')

@php
$defaultPath = 'front_assets/images/resource/aboutbg.jpg';

$imageToUse = file_exists(public_path($defaultPath)) ? $defaultPath : $defaultPath;
@endphp

<!-- Inner Banner Section -->
<section class="inner-banner">
    <div class="image-layer" style="background-image: url('{{asset($imageToUse)}}')"></div>
    <div class="auto-container">
        <div class="inner">
            <h1><span>About Us</span></h1>
        </div>
    </div>
</section>
<!--End Banner Section -->

<!--About Section-->
<section class="about-section">

    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-10.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-6.png')}}" alt="" title="" loading="lazy"></div>
    <div class="auto-container">

        <div class="title-box centered">
            <div class="subtitle"><span>WHO WE ARE?</span></div>
            <div class="pattern-image">
                <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
            </div>
            <h3>
                We take pride in being one of the best Caterer in India, with <br> over 2 decades of providing
                exceptional services and making <br>your special events unforgettable.
            </h3>
        </div>
        <div class="row clearfix">
            <!--Block-->
            <div class="about-block content-block col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInUp " data-wow-duration="1500ms" data-wow-delay="0ms">


                    <div class="text">

                        <h4 class="text-heading">More Than Catering, Creating <br> Experiences/ Rooted In Tradition, Inspired By Innovation
                        </h4>
                    </div>


                    <div class="video-box">
                        <div class="about-image">
                            <a href="https://www.youtube.com/watch?v=ZETY_l3GVQg" class="lightbox-image"><img src="{{asset('front_assets/images/resource/butterpanir.jpg')}}" alt="" class="video-image" loading="lazy"></a>
                            <a href="https://www.youtube.com/watch?v=ZETY_l3GVQg" class="lightbox-image play-btn"><span class="icon fal fa-play"><i class="ripple"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>

            <!--Block-->
            <div class="about-block image-block col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                    <div class="image">
                        <img src="{{asset('front_assets/images/resource/maxican.webp')}}" alt="" loading="lazy" class="maxican">
                    </div>
                </div>
            </div>
        </div>



        <div class="fact-counter">
            <div class="row clearfix">
                <div class="fact-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner clearfix">
                        <div class="fact-count1">
                            <div class="count-box">
                                <span class="count-text" data-stop="150" data-speed="2000">0</span><i>+</i>
                            </div>
                        </div>
                        <div class="fact-title">daily order</div>
                    </div>
                </div>
                <div class="fact-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner clearfix">
                        <div class="fact-count">
                            <div class="count-box">
                                <span class="count-text" data-stop="82" data-speed="1500">0</span><i>+</i>
                            </div>
                        </div>
                        <div class="fact-title">Special Dishes</div>
                    </div>
                </div>
                <div class="fact-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner clearfix">
                        <div class="fact-count">
                            <div class="count-box">
                                <span class="count-text" data-stop="35" data-speed="1000">0</span><i>+</i>
                            </div>
                        </div>
                        <div class="fact-title">expert chef</div>
                    </div>
                </div>
                <div class="fact-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner clearfix">
                        <div class="fact-count">
                            <div class="count-box">
                                <span class="count-text" data-stop="10" data-speed="1000">0</span><i>+</i>
                            </div>
                        </div>
                        <div class="fact-title">awards won</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- <section class="fluid-section alternate founder-sec">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-1.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-6.png')}}" alt="" title="" loading="lazy"></div>
    <div class="outer-container">
        <div class="row clearfix">
            <div class="about-card col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="image">
                    <img src="{{asset('front_assets/images/resource/lalit-sir.jpeg')}}" alt="" loading="lazy">
                </div>
                <div class="content">
                    <div class="title-box centered">
                        <h1 class="founder-heading">John Deo</h1>
                        <div class="pattern-image1">
                            <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                        </div>
                        <h3 class="founder-name">Founder</h3>
                    </div>
                </div>
            </div>

            <div class="about-card col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="image">
                    <img src="{{asset('front_assets/images/resource/lalit-sir.jpeg')}}" alt="" loading="lazy">
                </div>
                <div class="content">
                    <div class="title-box centered">
                        <h1 class="founder-heading">John Deo</h1>
                        <div class="pattern-image1">
                            <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                        </div>
                        <h3 class="founder-name">Founder</h3>
                    </div>
                </div>
            </div>

            <div class="about-card col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="image">
                    <img src="{{asset('front_assets/images/resource/lalit-sir.jpeg')}}" alt="" loading="lazy">
                </div>
                <div class="content">
                    <div class="title-box centered">
                        <h1 class="founder-heading">John Deo</h1>
                        <div class="pattern-image1">
                            <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                        </div>
                        <h3 class="founder-name">Founder</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="fluid-section aboutfounder-sec">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-1.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-6.png')}}" alt="" title="" loading="lazy"></div>
    <div class="outer-container">

        <div class="row clearfix alternate">
            <!--Col-->
            <div class="content-col5 col-xl-6 col-lg-6 col-md-12 col-sm-12">

                <div class="clearfix wow fadeInRight innerAchieve" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="content-box">
                        <div class="title-box centered">

                            <h1 class="founder-heading">Founder</h1>
                            <div class="pattern-image1" style="margin: 0 auto;">
                                <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                            </div>
                            <h3 class="founder-name" style="margin: 0;margin-top:10px;">Admin</h3>
                            <div class="text">
                                <div class="text1">Mr. Lalit Jain, founder of Jain Caterers, believes that true hospitality is about creating meaningful experiences and fostering connections, not just serving food. With a commitment to authenticity, integrity, and excellence, he ensures every event reflects high standards of care and attention to detail, making Jain Caterers a trusted name in the industry. <br>

                                    Jain Caterers stands out by blending tradition with innovation, offering event experiences that honor cultural roots while meeting modern expectations. Under Mr. Jain’s leadership, Jain Caterers creates warm, inviting atmospheres for guests. He plans to expand internationally, staying true to the brand's core values of quality, purity, and excellence.
                                </div>


                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <!--Col-->
            <div class="image-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="image-layer2" style="background-image: url({{ asset('front_assets/images/resource/founder-1.jpeg') }})"></div>
                    <div class="image">
                        <img src="{{asset('front_assets/images/resource/founder-1.jpeg')}}" alt="" loading="lazy" class="">
                    </div>
                </div>
            </div>

        </div>

        <div class="row clearfix">
            <!--Col-->
            <div class="image-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="image-layer2" style="background-image: url({{ asset('front_assets/images/resource/founder-2.jpeg') }})"></div>
                    <div class="image">
                        <img src="{{asset('front_assets/images/resource/founder-2.jpeg')}}" alt="" loading="lazy" class="">
                    </div>
                </div>
            </div>
            <!--Col-->
            <div class="content-col5 col-xl-6 col-lg-6 col-md-12 col-sm-12">

                <div class="clearfix wow fadeInRight innerAchieve" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="content-box">
                        <div class="title-box centered">

                            <h1 class="founder-heading">Founder</h1>
                            <div class="pattern-image1" style="margin: 0 auto;">
                                <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                            </div>
                            <h3 class="founder-name" style="margin: 0;margin-top:10px;">Admin</h3>
                            <div class="text">
                                <div class="text1">Mr. Lalit Jain, founder of Jain Caterers, believes that true hospitality is about creating meaningful experiences and fostering connections, not just serving food. With a commitment to authenticity, integrity, and excellence, he ensures every event reflects high standards of care and attention to detail, making Jain Caterers a trusted name in the industry. <br>

                                    Jain Caterers stands out by blending tradition with innovation, offering event experiences that honor cultural roots while meeting modern expectations. Under Mr. Jain’s leadership, Jain Caterers creates warm, inviting atmospheres for guests. He plans to expand internationally, staying true to the brand's core values of quality, purity, and excellence.
                                </div>


                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix alternate">
            <!--Col-->
            <div class="content-col5 col-xl-6 col-lg-6 col-md-12 col-sm-12">

                <div class="clearfix wow fadeInRight innerAchieve" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="content-box">
                        <div class="title-box centered">

                            <h1 class="founder-heading">Founder</h1>
                            <div class="pattern-image1" style="margin: 0 auto;">
                                <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                            </div>
                            <h3 class="founder-name" style="margin: 0;margin-top:10px;">Admin</h3>
                            <div class="text">
                                <div class="text1">Mr. Lalit Jain, founder of Jain Caterers, believes that true hospitality is about creating meaningful experiences and fostering connections, not just serving food. With a commitment to authenticity, integrity, and excellence, he ensures every event reflects high standards of care and attention to detail, making Jain Caterers a trusted name in the industry. <br>

                                    Jain Caterers stands out by blending tradition with innovation, offering event experiences that honor cultural roots while meeting modern expectations. Under Mr. Jain’s leadership, Jain Caterers creates warm, inviting atmospheres for guests. He plans to expand internationally, staying true to the brand's core values of quality, purity, and excellence.
                                </div>


                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <!--Col-->
            <div class="image-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="image-layer2" style="background-image: url({{ asset('front_assets/images/resource/founder-3.jpeg') }})"></div>
                    <div class="image">
                        <img src="{{asset('front_assets/images/resource/founder-3.jpeg')}}" alt="" loading="lazy" class="">
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>



<!--Story Section-->


<!--Fluid Section-->
<section class="fluid-section7">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-4.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-2.png')}}" alt="" title="" loading="lazy"></div>
    <div class="outer-container1">
        <div class="row  clearfix ">
            <!--Col-->
            <div class="image-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="image-layer" style="background-image: url({{asset('front_assets/images/resource/history.jpg')}})"></div>
                    <div class="image">
                        <img src="{{asset('front_assets/images/resource/history.jpg')}}" alt="" loading="lazy">
                    </div>
                </div>
            </div>
            <!--Col-->
            <div class="content-col col-xl-6 col-lg-6 col-md-12 col-sm-12">

                <div class="inner clearfix wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="content-box">
                        <div class="title-box centered">

                            <h2 class="history-heading">History</h2>
                            <div class="pattern-image">
                                <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                            </div>
                            <div class="history-paragraph-text">
                                SHYAM CATERERS was born from a passion to celebrate the rich traditions of vegetarian and Jain cuisine while embracing the evolving tastes and modern settings. <br> <br>


                                Inspired by the desire to serve food that aligns with ethical values and delights every palate, we embarked on a journey to redefine catering. The idea of fusion meals came naturally to us, blending timeless flavors with innovative culinary techniques to craft experiences that bridge tradition and creativity.
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!--Fluid Section-->
<section class="fluid-section alternate">
    <div class="outer-container">
        <div class="row clearfix">
            <!--Col-->
            <div class="image-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="image-layer2" style="background-image: url({{asset('front_assets/images/resource/achievment.jpg')}})"></div>
                    <div class="image">
                        <img src="{{asset('front_assets/images/resource/achievment.jpg')}}" alt="" loading="lazy">
                    </div>
                </div>
            </div>
            <!--Col-->
            <div class="content-col5 col-xl-6 col-lg-6 col-md-12 col-sm-12">

                <div class="clearfix wow fadeInRight innerAchieve" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="content-box">
                        <div class="title-box centered">

                            <h2 class="achievement-heading">Achievements</h2>
                            <div class="pattern-image5">
                                <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                            </div>


                            <div class="text7">
                                <p><i class="fa fa-trophy" aria-hidden="true"></i> Triple events of JITO, Mumbai: We’ve served 10 lakh people over 4 days.</p>
                                <p><i class="fa fa-trophy" aria-hidden="true"></i> Pratistha Mahotsav (Andheri Stadium): Served over 20 thousand people.</p>
                                <p><i class="fa fa-trophy" aria-hidden="true"></i> Pratistha Mahotsav (Goregaon West): Served over 20 thousand people.</p>
                                <p><i class="fa fa-trophy" aria-hidden="true"></i> Pratistha Mahotsav (Vardhman Heights Lalbaug): Served over 20 thousand people.</p>
                                <p><i class="fa fa-trophy" aria-hidden="true"></i> Luxurious Shikhar Ji Sangh Yatra For Ranigaon: Served over 20 thousand people.</p>
                                <p><i class="fa fa-trophy" aria-hidden="true"></i> JITO Half-Marathon: Served breakfast for 6 thousand people.</p>
                                <p><i class="fa fa-trophy" aria-hidden="true"></i> JITO Ahimsa Run: Served breakfast for 10 thousand people.</p>
                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--Fluid Section-->

<!--Services Section-->
<section class="services-section">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-4.png')}}" alt="" title="" loading="lazy"></div>
    <div class="left-bg"><img src="{{asset('front_assets/images/background/bg-1.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-bg"><img src="{{asset('front_assets/images/background/bg-2.png')}}" alt="" title="" loading="lazy"></div>
    <div class="auto-container">

        <div class="row clearfix">
            <div class="s-col col-lg-4 col-md-6 col-sm-12">
                <div class="inner1 wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div>
                        <div class="inner">

                            <h3 class="service-section-heading3">Mission</h3>
                            <div class="pattern-image2">
                                <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                            </div>
                            <div class="service-section-text3">
                                We aim to craft unforgettable dining experiences, and deliver exceptional vegetarian, Jain and fusion cuisine that celebrates tradition and innovation.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="s-col last col-lg-4 col-md-6 col-sm-12">
                <div class="inner wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div>
                        <div class="inner">

                            <h3 class="service-section-heading">Vision</h3>
                            <div class="pattern-image2">
                                <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                            </div>
                            <div class="service-section-text">
                                We envision to inspire meaningful connections
                                through innovative, ethical, and unforgettable
                                culinary experiences that celebrate tradition and
                                creativity.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="image-col col-lg-4 col-md-12 col-sm-12">
                <div class="inner wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="image-box">
                        <img src="{{asset('front_assets/images/resource/missviss.jpg')}}" alt="" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Slider Section-->
<div id="single-image-slider">
</div>

@endsection

@section('page_script')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    window.addEventListener('load', function() {

        fetch('/load-about-slider')
            .then(response => response.text())
            .then(html => {
                document.getElementById('single-image-slider').innerHTML = html;

                $(".single-img--carousel").owlCarousel({
                    items: 3,
                    loop: true,
                    margin: 10,
                    autoplay: true,
                    navText: [
                        `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>`,
                        `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>`
                    ],
                    dots: true,
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
    });
</script>
@endsection