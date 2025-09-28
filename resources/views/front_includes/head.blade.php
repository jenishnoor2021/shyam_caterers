<meta charset="utf-8">
<link rel="canonical" href="{{ URL::to('/') }}">
<title>Shyam Caterers & Event Managment: SHYAM CATERERS</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="Book the best veg Caterers in India for your special day! Enjoy premium catering services across India. Perfect for weddings, parties, and events.">
<meta name="keywords" content="Best Veg Caterers in India, Catering Service">
<link rel="shortcut icon" href="{{ asset('front_assets/images/favicon.ico') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('front_assets/images/favicon.ico') }}" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!-- Stylesheets -->
<link href="{{ asset('front_assets/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('front_assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('front_assets/css/responsive.css') }}" rel="stylesheet">

<style>
    /* SITE LOADER CSS START */

    /* body.hidden {
        overflow: hidden;
    }

    .loader-mask {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fff;
        z-index: 99999;
        min-height: 100dvh;
    } */

    body.loading {
        overflow: hidden;
        height: 100%;
        touch-action: none;
        /* prevent touch scrolling */
        overscroll-behavior: none;
        /* stop rubber-band scroll */
    }

    .loader-mask {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        /* force full width */
        height: 100vh;
        /* full height of viewport */
        background: #000;
        /* match video bg */
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loader-mask .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        font-size: 0;
        display: inline-block;
        text-align: center;
        text-indent: -9999em;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .loader-mask .loader .round_loader_block {
        position: relative;
        height: 80px;
        margin-bottom: 20px;
    }

    .loader-mask .loader .round_loader_block .round_loader {
        width: 80px;
        height: 80px;
        border: 2px solid #222222;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        animation: rotation 1s linear infinite;
    }

    .loader-mask .loader .round_loader_block .round_loader:after {
        content: "";
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 88px;
        height: 88px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-bottom-color: #222;
    }

    .loader-mask .loader .round_loader_block .loader_logo {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 55px;
    }

    .loader-mask .loader .text_loader {
        font-family: Montserrat, sans-serif;
        color: #222;
        position: relative;
        font-size: clamp(1rem, 0.8875rem + 0.5625vw, 1.5625rem) !important;
        display: block;
        text-transform: uppercase;
        font-weight: 700;
    }

    .loader-mask .loader .text_loader:after {
        content: "";
        width: 5px;
        height: 5px;
        background: #222;
        position: absolute;
        bottom: 10px;
        right: -8px;
        border-radius: 10px;
        animation: LoaderDotsAnimation 1s linear infinite;
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes LoaderDotsAnimation {
        0% {
            box-shadow: 10px 0 rgba(34, 34, 34, 0), 20px 0 rgba(34, 34, 34, 0);
        }

        50% {
            box-shadow: 10px 0 #222222, 20px 0 rgba(34, 34, 34, 0);
        }

        100% {
            box-shadow: 10px 0 #222222, 20px 0 #222222;
        }
    }

    @media(max-width: 991px) {
        .loader-mask .loader .text_loader:after {
            display: none;
        }
    }

    /* SITE LOADER CSS END */

    .inner-banner {
        padding: 100px 0 100px !important;
        height: 550px;
    }

    @media(max-width: 543px) {
        .inner-banner {
            padding: 100px 0 0px !important;
            height: 400px;
        }
    }

    .owl-theme .owl-nav {
        position: absolute;
        left: -100px;
        right: -100px;
        height: 0;
        top: 50%;
        margin-top: -22px;
    }

    .owl-theme .owl-nav .owl-next,
    .owl-theme .owl-nav .owl-prev {
        position: absolute;
        top: 50%;
        display: inline-block;
        vertical-align: top;
        width: 44px;
        height: 44px;
        line-height: 44px;
        font-size: var(--font-24);
        text-align: center;
        background: transparent;
        color: var(--main-color);
        border-radius: 0%;
        -webkit-transition: all 400ms ease;
        -moz-transition: all 400ms ease;
        -ms-transition: all 400ms ease;
        -o-transition: all 400ms ease;
        transition: all 400ms ease;
    }

    .owl-theme .owl-nav .owl-next span,
    .owl-theme .owl-nav .owl-prev span {
        position: relative;
        z-index: 1;
    }

    .owl-theme .owl-nav .owl-next:before,
    .owl-theme .owl-nav .owl-prev:before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        border: 1px solid var(--main-color);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        -webkit-transition: all 400ms ease;
        -moz-transition: all 400ms ease;
        -ms-transition: all 400ms ease;
        -o-transition: all 400ms ease;
        transition: all 400ms ease;
    }

    .owl-theme .owl-nav .owl-next {
        right: 15px;
    }

    .owl-theme .owl-nav .owl-prev {
        left: 15px;
    }

    .owl-theme .owl-nav .owl-next:hover,
    .owl-theme .owl-nav .owl-prev:hover {
        color: var(--black-color);
    }

    .owl-theme .owl-nav .owl-next:hover:before,
    .owl-theme .owl-nav .owl-prev:hover:before {
        background: var(--main-color);
    }

    @media(max-width: 767px) {
        .owl-theme .owl-nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            position: unset !important;
            margin-top: 20px !important;
        }

        .owl-theme .owl-nav .owl-next,
        .owl-theme .owl-nav .owl-prev {
            position: relative !important;
            width: 34px !important;
            height: 34px !important;
            line-height: 34px !important;
        }

        .owl-theme .owl-nav .owl-prev {
            position: relative !important;
            top: unset;
            left: unset !important;
        }

        .owl-theme .owl-nav .owl-next {
            position: relative !important;
            top: unset;
            right: unset !important;
        }

        .owl-nav button {
            color: var(--black-color) !important;
        }

        .owl-nav button:before {
            background: var(--main-color) !important;
        }

        .special-offer .owl-theme .owl-nav {
            gap: 30px;
            margin-bottom: 50px;
            margin-top: 30px !important;
        }

        .special-offer .owl-theme .owl-nav .owl-next,
        .special-offer .owl-theme .owl-nav .owl-prev {
            width: 28px !important;
            height: 28px !important;
            line-height: 28px !important;
        }
    }

    .aboutfounder-sec .image-layer2 {
        border-radius: 0 100px 100px 100px;
        border: 3px solid #e4c590;
        background-position: top center !important;
    }

    .special-offer .auto-container {
        max-width: 80% !important;
    }

    @media(max-width: 767px) {
        .special-offer .auto-container {
            max-width: 100% !important;
        }
    }

    @media(max-width: 767px) {
        #gallery-content .auto-container {
            max-width: 100% !important;
        }

        #gallery-content .owl-theme .owl-nav {
            gap: 30px;
            margin-top: 40px !important;
        }
    }

    @media(max-width: 991px) {
        #reel-content .team-section.reel-section {
            padding-top: 0;
        }
    }

    .main-footer ul.links li {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-footer ul.links li a {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .main-footer ul.links li a i {
        color: var(--main-color);
    }

    #single-image-slider .single-img--carousel {
        max-width: 85%;
        margin: 0 auto;
    }

    #single-image-slider .owl-nav button {
        color: var(--black-color) !important;
    }

    #single-image-slider .owl-nav button:before {
        background: var(--main-color) !important;
    }

    #single-image-slider .owl-nav .owl-prev {
        left: 20px !important;
    }

    #single-image-slider .owl-nav .owl-next {
        right: -180px !important;
    }

    @media(max-width: 1400px) {
        #single-image-slider .owl-nav .owl-prev {
            left: 40px !important;
        }

        #single-image-slider .owl-nav .owl-next {
            right: -160px !important;
        }
    }

    @media(max-width: 1199px) {
        #single-image-slider .owl-nav button {
            width: 34px;
            height: 34px;
        }

        #single-image-slider .owl-nav .owl-prev {
            left: 55px !important;
        }

        #single-image-slider .owl-nav .owl-next {
            right: -145px !important;
        }
    }

    @media(max-width: 767px) {
        #single-image-slider {
            padding-bottom: 40px;
        }

        #single-image-slider .owl-nav {
            position: relative !important;
            left: 0 !important;
            top: 8px !important;
            gap: 200px;
        }

        #single-image-slider .owl-nav .owl-prev {
            left: 0px !important;
        }

        #single-image-slider .owl-nav .owl-next {
            right: 0px !important;
        }
    }

    @media(max-width: 599px) {
        #single-image-slider .owl-nav .owl-prev {
            left: -40px !important;
        }

        #single-image-slider .owl-nav .owl-next {
            right: -40px !important;
        }
    }

    @media(max-width: 543px) {
        #single-image-slider .owl-nav {
            top: 13px !important;
            gap: 220px;
        }

        #single-image-slider .owl-theme .owl-nav .owl-next,
        #single-image-slider .owl-theme .owl-nav .owl-prev {
            width: 25px !important;
            height: 25px !important;
            line-height: 25px !important;
        }
    }

    @media(max-width: 425px) {
        #single-image-slider .owl-nav .owl-prev {
            left: -5px !important;
        }

        #single-image-slider .owl-nav .owl-next {
            right: -5px !important;
        }
    }

    .image-gallery .gallery-block .image img {
        height: 400px;
        object-fit: cover;
    }

    .cuisuine-gallery .owl-nav button {
        color: var(--black-color) !important;
    }

    .cuisuine-gallery .owl-nav button:before {
        background: var(--main-color) !important;
    }

    .team-section .gallery-carousel .item img {
        height: 300px;
        object-fit: cover;
    }

    .gallery-carousel {
        max-width: 90%;
        margin: 0 auto;
    }

    @media(max-width: 767px) {
        .gallery-carousel {
            max-width: 100%;
        }
    }


    section.fluid-section.aboutfounder-sec {
        padding-top: 60px;
    }

    @media(min-width: 992px) {
        .desktop-hidden {
            display: none;
        }
    }

    @media(max-width: 991px) {
        .aboutfounder-sec.fluid-section .image-col .image img {
            width: 50%;
            margin: 0 auto;
            height: 600px;
            object-fit: cover;
            object-position: top;
            border-radius: 0 100px 100px 100px;
            border: 3px solid #e4c590;
        }

        .aboutfounder-sec.fluid-section .image-col .title-box {
            padding-bottom: 30px;
        }

        .mobile-hidden {
            display: none;
        }
    }

    @media(max-width: 543px) {
        .aboutfounder-sec.fluid-section .image-col .image img {
            width: 80%;
            height: 500px;
        }
    }

    @media(max-width: 767px) {
        .fluid-section7 .image-col .image {
            position: relative;
        }
    }

    @media(max-width: 543px) {
        .booking-form.team-section .auto-container {
            padding-left: 0;
            padding-right: 0;
        }

        .booking-form.team-section .auto-container .row.list .menu-item {
            margin-bottom: 0 !important;
        }

        .booking-form.team-section .auto-container .row.list .card {
            flex-direction: row !important;
        }

        .booking-form.team-section .auto-container .row.list .card img {
            width: 50px;
            height: 50px;
            aspect-ratio: unset !important;
            object-fit: cover;
        }

        .booking-form.team-section .auto-container .row.list .card .card-body {
            flex-direction: row !important;
            align-items: center;
            gap: 10px;
            padding: 10px 10px;
        }

        .booking-form.team-section .auto-container .row.list .card .card-body .name {
            font-size: 14px;
            text-align: left;
        }

        .booking-form.team-section .auto-container .row.list .card .card-body button {
            margin: 0 !important;
        }

        .category .list-group {
            max-height: 300px;
        }
    }
</style>