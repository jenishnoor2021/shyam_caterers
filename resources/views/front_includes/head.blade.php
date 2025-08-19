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

    body.hidden {
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
</style>