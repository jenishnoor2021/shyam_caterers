@extends('layouts.front')

@section('page_style')

@endsection

@section('content')
<!--Map Section-->
<section class="inner-banner">
    <div class="image-layer" style="background-image: url({{asset('front_assets/images/resource/aboutbg.jpg')}})"></div>
    <div class="auto-container">
        <div class="inner">
            <h1><span>Packages</span></h1>
        </div>
    </div>
</section>
<!--Contact Info Section-->

<section class="booking-form team-section form">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-1.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-6.png')}}" alt="" title="" loading="lazy"></div>
    <p>Packages</p>
</section>

@endsection

@section('page_script')

@endsection