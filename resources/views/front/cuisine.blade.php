@extends('layouts.front')

@section('content')

@php
$backgroundPath = $cuisine->file != '/cusinecategory/' ? $cuisine->file : '';
$defaultPath = 'front_assets/images/background/weddingpic.jpg'; // Change this to your actual default image path

$imageToUse = (!empty($backgroundPath) && file_exists(public_path($backgroundPath))) ? $backgroundPath : $defaultPath;
@endphp

<section class="inner-banner">
    <div class="image-layer" style="background-image: url('{{ asset($imageToUse) }}')"></div>
    <div class="auto-container">
        <div class="inner">
            <h1><span> {{ $cuisine->category_name }}</span></h1>
        </div>
    </div>
</section>

<section class="image-gallery cuisuine-gallery">
    <div class="carousel-box">
        <div class="auto-container">
            <div class="image-gallery-slider owl-theme owl-carousel">
                <!--Slide Item-->

                @forelse ($cuisine->items as $img)
                <div class="gallery-block my-5">
                    <div class="image">
                        <a href="{{ asset($img->file) }}" class="lightbox-image" data-fancybox="gallery"><img src="{{ asset($img->file) }}" alt="" loading="lazy"></a>
                    </div>
                </div>
                @empty
                <!-- Fallback Default Images -->
                <div class="">
                    <img src="{{ asset('defaults/event_default.jpg') }}" class="img-fluid rounded" alt="Default" loading="lazy">
                </div>
                <div class="">
                    <img src="{{ asset('defaults/event_default.jpg') }}" class="img-fluid rounded" alt="Default" loading="lazy">
                </div>
                <div class="">
                    <img src="{{ asset('defaults/event_default.jpg') }}" class="img-fluid rounded" alt="Default" loading="lazy">
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection