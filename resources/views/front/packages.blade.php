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

@php
    $packages = [
        // Package 1
        [
            'name' => 'Package - 1',
            'items_count' => 13,
            'items' => [
                ['name' => 'સ્વીટ', 'qty' => 1],
                ['name' => 'રોટી / પુરી', 'qty' => 1],
                ['name' => 'ફરસાણ' , 'qty' => 1],
                ['name' => 'ગુજરાતી શાક', 'qty' => 1],
                ['name' => 'ચટણી', 'qty' => 1],
                ['name' => 'ગ્રીન સલાડ', 'qty' => 1],
                ['name' => 'દાળ / કઢી', 'qty' => 1],
                ['name' => 'ભાત / પુલાવ', 'qty' => 1],
                ['name' => 'પાપડ', 'qty' => 1],
                ['name' => 'છાસ', 'qty' => 1],
                ['name' => 'મીનરલ વોટર (200ml)', 'qty' => 1],
                ['name' => 'મુખવાસ', 'qty' => 1],
            ],
        ],
        // Package 2
        [
            'name' => 'Package - 2',
            'items_count' => 15,
            'items' => [
                ['name' => 'સ્વીટ', 'qty' => 2],
                ['name' => 'રોટી / પુરી', 'qty' => 1],
                ['name' => 'ફરસાણ ', 'qty' => 1],
                ['name' => 'ગુજરાતી શાક', 'qty' => 1],
                ['name' => 'પંજાબી શાક', 'qty' => 1],
                ['name' => 'ચટણી', 'qty' => 1],
                ['name' => 'ગ્રીન સલાડ ', 'qty' => 1],
                ['name' => 'દાળ / કઢી', 'qty' => 1],
                ['name' => 'ભાત / પુલાવ', 'qty' => 1],
                ['name' => 'પાપડ', 'qty' => 1],
                ['name' => 'છાસ', 'qty' => 1],
                ['name' => 'મીનરલ વોટર (200ml)', 'qty' => 1],
                ['name' => 'મુખવાસ', 'qty' => 1],
            ],
        ],
        // Package 3
        [
            'name' => 'Package - 3',
            'items_count' => 17,
            'items' => [
                ['name' => 'લિકવીડ સ્વીટ', 'qty' => 1],
                ['name' => 'સ્વીટ ', 'qty' => 2],
                ['name' => 'ફરસાણ', 'qty' => 2],
                ['name' => 'રોટી / પુરી', 'qty' => 2],
                ['name' => 'ગુજરાતી શાક', 'qty' => 1],
                ['name' => 'પંજાબી શાક', 'qty' => 1],
                ['name' => 'ચટણી', 'qty' => 2],
                ['name' => 'ગ્રીન સલાડ', 'qty' => 1],
                ['name' => 'દાળ / કઢી', 'qty' => 1],
                ['name' => 'ભાત / પુલાવ', 'qty' => 1],
                ['name' => 'પાપડ', 'qty' => 1],
                ['name' => 'છાસ', 'qty' => 1],
                ['name' => 'મીનરલ વોટર (200ml)', 'qty' => 1],
                ['name' => 'મુખવાસ', 'qty' => 1],
            ],
        ],
        // Package 4
        [
            'name' => 'Package - 4',
            'items_count' => 15,
            'items' => [
                ['name' => 'વેલકમ (ડ્રિન્ક્સ)', 'qty' => 1],
                ['name' => 'સુપ', 'qty' => 1],
                ['name' => 'ચાઇનીઝ', 'qty' => 1],
                ['name' => 'ઇટાલીયન', 'qty' => 1],
                ['name' => 'સાઉથ ઇન્ડીયન', 'qty' => 1],
                ['name' => 'સ્વીટ ', 'qty' => 1],
                ['name' => 'રોટી', 'qty' => 1],
                ['name' => 'શાક', 'qty' => 1],
                ['name' => 'છાસ', 'qty' => 1],
                ['name' => 'પાપડ', 'qty' => 1],
                ['name' => 'દાળ-ભાત', 'qty' => 1],
                ['name' => 'મીનરલ વોટર (200ml)', 'qty' => 1],
                ['name' => 'મુખવાસ', 'qty' => 3],
            ],
        ],
        // Package 5
        [
            'name' => 'Package - 5',
            'items_count' => 26,
            'items' => [
                ['name' => 'વેલકમ (ડ્રિન્ક્સ)', 'qty' => 2],
                ['name' => 'મોબાઇલ સ્ટાર્ટર ', 'qty' => 2],
                ['name' => 'સુપ', 'qty' => 2],
                ['name' => 'લિકવીડ', 'qty' => 1],
                ['name' => 'સ્વીટ', 'qty' => 1],
                ['name' => 'ફરસાણ', 'qty' => 1],
                ['name' => 'રોટી / પુરી', 'qty' => 1],
                ['name' => 'તંદૂર', 'qty' => 1],
                ['name' => 'ગુજરાતી શાક', 'qty' => 1],
                ['name' => 'પંજાબી શાક', 'qty' => 1],
                ['name' => 'સલાડ કાઉન્ટર', 'qty' => 3],
                ['name' => 'ચટણી', 'qty' => 2],
                ['name' => 'દાળ / કઢી / દાળફ્રાય', 'qty' => 1],
                ['name' => 'ભાત / જીરા રાઇસ', 'qty' => 1],
                ['name' => 'પાપડ', 'qty' => 1],
                ['name' => 'છાસ', 'qty' => 1],
                ['name' => 'મીનરલ વોટર (200ml)', 'qty' => 1],
                ['name' => 'મુખવાસ', 'qty' => 3],
            ],
        ],
        // Package 6
        [
            'name' => 'Package - 6',
            'items_count' => 33,
            'items' => [
                ['name' => 'વેલકમ (ડ્રિન્ક્સ)', 'qty' => 2],
                ['name' => 'મોબાઇલ સ્ટાર્ટર', 'qty' => 2],
                ['name' => 'સુપ', 'qty' => 2],
                ['name' => 'ચાઇનીઝ', 'qty' => 1],
                ['name' => 'લાઇવ ચાટ', 'qty' => 1],
                ['name' => 'ચાઇનીઝ', 'qty' => 1],
                ['name' => 'લિકવીડ', 'qty' => 1],
                ['name' => 'સ્વીટ', 'qty' => 2],
                ['name' => 'ફરસાણ', 'qty' => 1],
                ['name' => 'રોટી / પુરી', 'qty' => 1],
                ['name' => 'તંદૂર', 'qty' => 1],
                ['name' => 'ગુજરાતી શાક', 'qty' => 1],
                ['name' => 'પંજાબી શાક', 'qty' => 1],
                ['name' => 'સલાડ કાઉન્ટર', 'qty' => 3],
                ['name' => 'ચટણી', 'qty' => 2],
                ['name' => 'દાળ / કઢી / દાળફ્રાય', 'qty' => 2],
                ['name' => 'ભાત / જીરા રાઇસ', 'qty' => 1],
                ['name' => 'પાપડ', 'qty' => 1],
                ['name' => 'છાસ', 'qty' => 1],
                ['name' => 'મીનરલ વોટર (200ml)', 'qty' => 1],
                ['name' => 'મુખવાસ', 'qty' => 3],
            ],
        ],
        // Package 7
        [
            'name' => 'Package - 7',
            'items_count' => 40,
            'items' => [
                ['name' => 'વેલકમ (ડ્રિન્ક્સ)', 'qty' => 3],
                ['name' => 'મોબાઇલ સ્ટાર્ટર', 'qty' => 3],
                ['name' => 'સુપ', 'qty' => 2],
                ['name' => 'ચાઇનીઝ', 'qty' => 1],
                ['name' => 'ઇટાલીયન / મેકસિકન', 'qty' => 1],
                ['name' => 'ચાઇનીઝ', 'qty' => 1],
                ['name' => 'લિકવીડ', 'qty' => 1],
                ['name' => 'સ્વીટ', 'qty' => 2],
                ['name' => 'સ્પેશ્યલ સ્વીટ', 'qty' => 1],
                ['name' => 'ફરસાણ', 'qty' => 2],
                ['name' => 'રોટી / પુરી / પરોઠા', 'qty' => 1],
                ['name' => 'તંદૂર', 'qty' => 1],
                ['name' => 'ગુજરાતી શાક', 'qty' => 1],
                ['name' => 'પંજાબી શાક', 'qty' => 2],
                ['name' => 'સલાડ કાઉન્ટર', 'qty' => 3],
                ['name' => 'ચટણી', 'qty' => 2],
                ['name' => 'દાળ / કઢી / દાળફ્રાય', 'qty' => 2],
                ['name' => 'ભાત / જીરા રાઇસ', 'qty' => 1],
                ['name' => 'પાપડ', 'qty' => 1],
                ['name' => 'છાસ', 'qty' => 1],
                ['name' => 'મીનરલ વોટર (200ml)', 'qty' => 1],
                ['name' => 'મુખવાસ', 'qty' => 2],
                ['name' => 'આઇસક્રીમ', 'qty' => 1],
            ],
        ],
        // Package 8
        [
            'name' => 'Package - 8',
            'items_count' => 54,
            'items' => [
                ['name' => 'મોકટેલ બાર', 'qty' => 1],
                ['name' => 'વેલકમ (ડ્રિન્ક્સ)', 'qty' => 1],
                ['name' => 'મોબાઇલ સ્ટાર્ટર', 'qty' => 3],
                ['name' => 'સુપ', 'qty' => 2],
                ['name' => 'ચાઇનીઝ', 'qty' => 1],
                ['name' => 'ઇટાલીયન', 'qty' => 1],
                ['name' => 'મેકસિકન', 'qty' => 1],
                ['name' => 'ચાઇનીઝ', 'qty' => 1],
                ['name' => 'લિકવીડ', 'qty' => 1],
                ['name' => 'સ્વીટ', 'qty' => 2],
                ['name' => 'સ્પેશ્યલ સ્વીટ', 'qty' => 1],
                ['name' => 'ફરસાણ', 'qty' => 2],
                ['name' => 'રોટી / પુરી', 'qty' => 2],
                ['name' => 'તંદૂર', 'qty' => 1],
                ['name' => 'ગુજરાતી શાક', 'qty' => 1],
                ['name' => 'પંજાબી શાક', 'qty' => 2],
                ['name' => 'સલાડ કાઉન્ટર', 'qty' => 2],
                ['name' => 'ચટણી', 'qty' => 2],
                ['name' => 'દાળ / કઢી / દાળફ્રાય / જીરા રાઇસ', 'qty' => 1],
                ['name' => 'પાપડ', 'qty' => 1],
                ['name' => 'છાસ', 'qty' => 1],
                ['name' => 'મીનરલ વોટર (200ml)', 'qty' => 1],
                ['name' => 'મુખવાસ', 'qty' => 2],
                ['name' => 'સુપ બાર', 'qty' => 1],
                ['name' => 'ડેઝર્ટ સર્વિસ', 'qty' => 1],
                ['name' => 'લાઇવ આઇસક્રીમ કાઉન્ટર (એક્ઝક્લૂસીવ)', 'qty' => 1],
            ],
        ],
    ];
@endphp


<section class="booking-form team-section form section--packages">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-1.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-6.png')}}" alt="" title="" loading="lazy"></div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 w-full">
        @foreach($packages as $package)
            <div class="rounded-2xl overflow-hidden">
                <!-- Header -->
                <div class="bg-black text-white text-center py-3">
                    <h2 class="text-lg font-bold">{{ $package['name'] }}</h2>
                    <p class="text-sm">In this package {{ $package['items_count'] }} items</p>
                </div>

                <!-- Items -->
                <ul class="p-4 space-y-1 text-gray-800 font-medium">
                    @foreach($package['items'] as $item)
                        <li class="flex justify-between border-b last:border-none py-1">
                            <span>{{ $item['name'] }}</span>
                            <span>{{ $item['qty'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
    
</section>

<style>
    .section--packages .grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 30px;
        max-width: 90%;
        margin: 0 auto;
    }
    .section--packages .grid .rounded-2xl.overflow-hidden {
        background: #FFF;
        border-radius: 15px;
        box-shadow: 0 0px 10px 0px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    .section--packages .grid .rounded-2xl.overflow-hidden div {
        color: #000 !important;
    }
    .section--packages .grid .rounded-2xl.overflow-hidden .bg-black {
        background: #e4c590;
    }
    .section--packages .grid .rounded-2xl.overflow-hidden .bg-black h2 {
        font-size: 34px;
        font-weight: 600;
    }
    .section--packages .grid .rounded-2xl.overflow-hidden .bg-black p {
        margin: 0;
        color: #000;
    }
    .section--packages .grid .rounded-2xl.overflow-hidden ul {
        
    }
    .section--packages .grid .rounded-2xl.overflow-hidden ul li.flex {
        display: flex;
        justify-content: space-between;
        position: relative;
        color: #000;
        padding-left: 25px;
    }
    .section--packages .grid .rounded-2xl.overflow-hidden ul li:before {
        content: '';
        background: var(--main-color);
        height: 12px;
        width: 12px;
        position: absolute;
        top: 11px;
        left: 0;
        transform: rotate(45deg);
    }
    @media(max-width: 991px) {
        .section--packages .grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    @media(max-width: 543px) {
        .section--packages .grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
    }
</style>

@endsection

@section('page_script')

@endsection