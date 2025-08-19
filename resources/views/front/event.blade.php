@extends('layouts.front')

@section('content')

@php
$backgroundPath = $event->poster != '/events/' ? $event->poster : '';
$defaultPath = 'front_assets/images/background/weddingpic.jpg'; // Change this to your actual default image path

$imageToUse = (!empty($backgroundPath) && file_exists(public_path($backgroundPath))) ? $backgroundPath : $defaultPath;
@endphp

<section class="inner-banner">
    <div class="image-layer" style="background-image: url('{{ asset($imageToUse) }}')"></div>
    <div class="auto-container">
        <div class="inner">
            <h1><span> {{ $event->event_type }}</span></h1>
        </div>
    </div>
</section>

<section class="fluid-section9">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-1.png')}}" alt="" title="" loading="lazy">></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-2.png')}}" alt="" title="" loading="lazy">></div>
    <div class="outer-container">
        <div class="title-box centered">
            <h1 class="title-box-heading">YOUR BIG DAY, OUR <br>TRUSTED EXPERTISE
            </h1>
        </div>

        @php
        $imagePath = $event->file && file_exists(public_path($event->file))
        ? $event->file
        : 'defaults/event_default.jpg';
        @endphp

        <div class="row clearfix">
            <!--Col-->
            <div class="image-col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="image-layer2" style="background-image: url('{{ asset($imagePath) }}')"></div>
                    <div class="image">
                        <img src="{{ asset($imagePath) }}" alt="" loading="lazy">
                    </div>
                </div>
            </div>
            <!--Col-->
            <div class="content-col col-xl-6 col-lg-6 col-md-12 col-sm-12">

                <div class="inner clearfix wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
                    <div class="content-box">
                        <div class="title-box centered">


                            <div class="text">
                                <p class="fluid-section-paragraph text-align">{{ $event->detail ?? 'No description available.' }}
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="image-gallery">
    <div class="carousel-box">
        <div class="auto-container">
            <div class="image-gallery-slider owl-theme owl-carousel">
                <!--Slide Item-->

                @forelse ($event->images as $img)
                <div class="gallery-block">
                    <div class="image">
                        <a href="{{ asset($img->file) }}" class="lightbox-image" data-fancybox="gallery"><img src="{{ asset($img->file) }}" alt="" loading="lazy"></a>
                    </div>
                </div>
                @empty
                <!-- Fallback Default Images -->
                <div class="col-md-4">
                    <img src="{{ asset('assets/defaults/default1.jpg') }}" class="img-fluid rounded" alt="Default" loading="lazy">>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/defaults/default2.jpg') }}" class="img-fluid rounded" alt="Default" loading="lazy">>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/defaults/default3.jpg') }}" class="img-fluid rounded" alt="Default" loading="lazy">>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection