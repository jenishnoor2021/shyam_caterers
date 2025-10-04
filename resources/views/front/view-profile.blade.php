<? //= dd($user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Page CSS -->

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="aS82iNenGlfHJhjcFanJwu8stEUcjrfyoZytKhyD">
    <link rel="apple-touch-icon" sizes="180x180"
      href="{{ asset('assets/profile/images/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
      href="{{ asset('assets/profile/images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
      href="{{ asset('assets/profile/images/favicons/favicon-16x16.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Akshay Kumar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="{{ asset('assets/profile/css/profile.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/profile/css/profile_modal.css') }}" rel="stylesheet" type="text/css">
    <meta property="og:image" content="{{$user->image}}" />
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://mygrid.club/js/lottie-player.js"></script>
    {{-- <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
      rel="stylesheet" />
    <script src="https://cdnjs.com/libraries/bodymovin" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Slick Css -->
    <link href="{{ asset('assets/profile/libs/slick/slick.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/profile/libs/slick/slick-theme.css') }}" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="{{ asset('assets/profile/libs/slick/slick.min.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-205937290-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());
      gtag("config", "UA-205937290-1");
    </script>

    <!-- Global site tag (gtag.js) - Google Ads -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10800048870"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());
      gtag("config", "AW-10800048870");
    </script>

    <!-- DO NOT MODIFY -->
    <!-- Quora Pixel Code (JS Helper) -->
    <script>
      !(function(q, e, v, n, t, s) {
        if (q.qp) return;
        n = q.qp = function() {
          n.qp ? n.qp.apply(n, arguments) : n.queue.push(arguments);
        };
        n.queue = [];
        t = document.createElement(e);
        t.async = !0;
        t.src = v;
        s = document.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s);
      })(window, "script", "https://a.quora.com/qevents.js");
      qp("init", "d51f0996f45f4fd69370c76f36fe8f58");
      qp("track", "ViewContent");
    </script>
    <noscript><img height="1" width="1" style="display: none"
        src="https://q.quora.com/_/ad/d51f0996f45f4fd69370c76f36fe8f58/pixel?tag=ViewContent&noscript=1" loading="lazy" /></noscript>
    <!-- End of Quora Pixel Code -->
    <script>
      qp("track", "Generic");
    </script>

    <!-- Hotjar Tracking Code for https://mygrid.club -->
    <script>
      (function(h, o, t, j, a, r) {
        h.hj =
          h.hj ||
          function() {
            (h.hj.q = h.hj.q || []).push(arguments);
          };
        h._hjSettings = {
          hjid: 3065129,
          hjsv: 6
        };
        a = o.getElementsByTagName("head")[0];
        r = o.createElement("script");
        r.async = 1;
        r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
        a.appendChild(r);
      })(window, document, "https://static.hotjar.com/c/hotjar-", ".js?sv=");
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
      .a2a_default_style:not(.a2a_flex_style) a {
        float: left;
        line-height: 16px;
        padding: 0 2px;
        width: 100%;
      }

      .share-wrapper {
        float: right;
      }

      .share {
        cursor: pointer;
      }

      .share.active {
        background-color: #000;
      }

      .share.active+.social li {
        transform: scale(1);
      }

      .share.active+.social li:hover {
        transform: scale(1.1);
      }

      ul.social {
        opacity: 0;
        visibility: hidden;
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 10px !important;
      }

      ul.social.active {
        opacity: 1;
        visibility: visible;
        transform: translate(0);
      }

      ul.social li {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: #FFF;
        background-color: #FFF;
        text-align: center;
        cursor: pointer;
        box-shadow: 0.5px 0.87px 4px 0 rgba(0, 0, 0, 0.3);
        transition: all 0.4s;
        display: flex;
        align-items: center;
      }

      ul.social li .facebook {
        color: #3A589E;
      }

      ul.social li .twitter {
        color: #5FA9DD;
      }

      ul.social li .linkedin {
        color: #0D77B7;
      }

      ul.social li .google {
        color: #DF4B38;
      }

      ul.social li .pinterest {
        color: #CD2129;
      }

      ul.social li .youtube {
        color: #CF2227;
      }

      ul.social li .instagram {
        color: #305C85;
      }

      .a2a_svg {
        height: 100% !important;
        width: 100% !important;
        border-radius: 60px !important;
      }

      .bottom-sticky-button {
        position: fixed;
        left: 0;
        right: 0;
        margin: auto;
        bottom: 30px;
        text-align: center;
      }

      .save-contact-btn {
        border-radius: 5px;
        color: #FFF;
        background-color: #60a5fa !important;
        font-size: 16px;
        font-weight: 500;
        padding: 12px 16px;
      }

      .text-gray-400,
      .tw {
        word-wrap: break-word;
      }

      #copiedMessage {
        padding: 4px 6px 4px;
        border-radius: 5px;
        color: white;
        height: 24px;
        line-height: 0.4;
        letter-spacing: 0.8px;
        font-size: 13px;
        background: #5784f5;
      }

      .copy-tooltip span {
        position: absolute;
        right: calc(100% + 7px);
      }

      .whatsapp-share a {
        border-radius: 100%;
        background: rgb(18, 175, 10);
        height: 36px;
        display: flex;
        margin: auto;
        max-width: 36px !important;
      }

      .bottom-sticky-button {
        position: fixed;
        left: 0;
        right: 0;
        margin: auto;
        bottom: 132px;
        text-align: center;
      }

      .save-contact-btn {
        border-radius: 5px;
        color: #FFF;
        background-color: #60a5fa !important;
        font-size: 16px;
        font-weight: 500;
        padding: 12px 16px;
      }

      .card-model-cross-btn {
        float: right;
        position: absolute;
        right: 30px;
        font-size: xx-large;
        top: 15px;
        z-index: 1;
      }

      .phone-section .phone-code {
        width: 40%;
        float: left;
        font-size: 15px;
      }

      .phone-section .phone-number {
        width: 58%;
        float: left;
        margin-left: 3px
      }

      .slick-dots li button:before {
        line-height: 9px;
        opacity: 1;
        color: white;
      }

      .slick-dots li.slick-active button:before {
        content: '';
        width: 20px;
        height: 7px;
        opacity: .75;
        color: #128ff6;
        background-color: #128ff6;
        border-radius: 50px;
      }

      .slick-dots {
        bottom: -35px;
      }

      .text-2xl {
        display: flex;
        justify-content: center !important;
        align-items: center !important;
        gap: 5px;
      }

      .text-2xl label {
        height: 26px;
      }

      .vertical-line {
        width: 1px;
        background-color: white;
        /* Line color */
        display: inline-block;
        width: 3px;
        margin-left: 10px;
        margin-right: 10px;
      }

      .page-google-google-img {
        height: 40px !important;
      }

      .user-review-date {
        line-height: 1 !important;
        color: #666666 !important;
      }

      .user-name {
        line-height: 1 !important;
      }

      .text-review {
        font-size: 14px;
        font-weight: 400;
        color: white;
        margin-top: 10px;
      }

      .user-inffo {
        display: flex;
        gap: 10px;
      }

      .g-rating {
        --stars: 1 !important;
        --starsize: 23px !important;
        width: calc(var(--starsize) * var(--value));
      }

      .rating-text {
        margin-top: 0.5rem;
        /* Space between the rating and the text */
        font-size: 1rem;
        /* Adjust font size as needed */
      }

      .footer-section {
        position: sticky;
        bottom: 0;
        z-index: 1;
        background: #121016;
      }

      .footer-section img {
        width: 30px;
        margin: auto;
        padding-bottom: 2px;
      }

      .footer-tab:not(.active) {
        opacity: 0.3;
      }

      .footer-tab.active {
        border-top: 4px solid #ddd;
      }

      .footer-tab {
        cursor: pointer;
        border-top: 4px solid transparent;
      }

      .google-review-section {
        /* position: absolute;
                  top: 0; */
        background: #121016;
        z-index: 1;
      }

      .round-profile-img {
        width: 48px;
        height: 48px;
        padding: 5px;
      }

      .bg-gray {
        background: #1a191c;
      }

      .conection-div {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .conection-div a img {
        margin-left: -5px;
        height: 15px !important;
        width: 15px;
      }

      .conection-main-div {
        gap: 10px;

      }

      .google-logo {
        width: 24px;
        height: 24px;
      }

      .google-logo img {
        width: 100%;
      }

      img.google-img {
        width: 30px !important;
      }

      /* page google revies  */
      .text-review-user {
        font-size: 14px !important;
        font-weight: 400;
        line-height: 1.1 !important;
      }

      .conection-div {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .conection-div a img {
        margin-left: -5px;
        height: 15px !important;
        width: 15px;
      }

      .conection-main-div {
        gap: 10px;

      }

      .google-logo {
        width: 24px;
        height: 24px;
      }

      .google-logo img {
        width: 100%;
      }

      .conection-div {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .conection-div a img {
        margin-left: -5px;
        height: 15px !important;
        width: 15px;
      }

      .conection-main-div {
        gap: 10px;

      }

      .google-logo {
        width: 24px;
        height: 24px;
      }

      .google-logo img {
        width: 100%;
      }

      .google-img {
        width: 23px !important;
      }

      .swiper-slide {
        width: auto !important;
      }

      .line-divider {
        height: 30px;
        width: 2px;
        background-color: white !important;
      }

      .star-img {
        width: 18px;
        height: 18px;
      }

      .font-size-rating {
        font-size: 20px;
        font-weight: 700;
        align-items: center;
        gap: 5px;
      }

      .main-div {
        font-size: 12px;
        font-weight: 400;
      }

      .slider-app {
        justify-content: safe center;
      }

      .slider-app::-webkit-scrollbar {
        display: none;
      }

      .slider-main-div {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        padding: 10px 25px;
        background-color: #1e1b21;
        border: 0.5px solid #3b3b3b;
        border-radius: 8px;
        min-height: 50px;
        flex-shrink: 0;
        cursor: grab;
        user-select: none;
      }

      .prime-img {
        width: 30px;
        height: 30px;
        border-radius: 100%;
      }

      .number-of-conction {
        font-size: 20px;
        font-weight: 700;
      }

      .img-conction {
        justify-content: center;
        align-items: center;
      }

      .img-placeholder {
        width: 20px;
        height: 20px;
        margin-left: -2px;
      }

      .text-conction {
        font-size: 14px;
        font-weight: 400;
      }

      .text-praime {
        font-size: 18px;
      }

      .card-heading {
        color: #FFC700;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.1;
      }

      .img-gold {
        width: auto;
        height: 44px;
        margin-top: -9px;
      }

      .gst-img-div {
        justify-content: center;
        align-items: center;
        gap: 5px;
        margin-top: 2px;
      }

      .check-img {
        width: 12px;
        height: 12px;
      }

      .gst-main-div-1 {
        flex-direction: column;
        gap: 2px !important;
      }

      .slider-app {
        /* max-width: 350px !important; */
        padding-top: 50px;
        z-index: 0;
      }

      .user-video {
        width: 100%;
        height: 450px;
      }

      .slider-app .swiper-slide {
        cursor: pointer;
        height: auto;
      }

      /* ======== */
      .text-gridclub {
        font-size: 20px !important;
      }

      .btn-review {
        background-color: #128ff6;
        color: white;
        border: none;
        outline: none;
        border-radius: 10px;
        padding: 5px 10px;
        margin-bottom: 20px;
      }

      .btn-review svg {
        height: 20px;
        width: 20px;
        fill: white;
      }

      .div-google-review-google-page {
        background-color: #2F2F2F;
        padding: 5px 15px !important;
      }

      .google-logo-google-page {
        height: 30px !important;
        width: auto !important;
      }

      .sub-div-google-review-google-page {
        gap: 0 !important;
      }

      .google-page-review-rattting {
        font-size: 20px !important;
        line-height: 1.1;
      }

      .google-page-review-text {
        font-size: 10px !important;
        line-height: 1.1;
      }

      .btn-review-div {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .btn-review {
        display: flex;
        gap: 5px;
        justify-content: center;
        align-items: center;
        padding: 6px 16px;
        margin-bottom: 20px;
        font-size: 20px;
      }

      .btn-review svg {
        width: 16px;

      }

      .input-tag-div input {
        background-color: #2F2F2F;
        padding: 10px 20px;
        font-size: 14px;
        line-height: 1.1;
        border-radius: 5px;
        margin-top: 10px;
        width: 100%;
      }

      .input-tag-div input:focus {
        border: none;
        outline: none;
      }

      .address-text {
        background-color: #2F2F2F;
        padding: 10px 20px;
        font-size: 14px;
        line-height: 1.4;
        border-radius: 5px;
        margin-top: 10px;
        width: 100%;
      }

      .text-p-10 {
        color: white;
        font-size: 14px;
        line-height: 1.1;
        width: fit-content;
        font-weight: 500;

      }

      .feed-top-btn-div {
        display: flex;
        justify-content: end;
        align-items: center;
        gap: 5px;
        margin-bottom: 10px;
      }

      .check-img {
        width: 20px;
        height: 20px;
      }

      .btn-menu-business-info-page {
        background-color: white;
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 10px;
      }

      .btn-menu-business-info-page span svg {
        fill: black;
      }

      .page-name-google-page {
        font-size: 20px !important;
        line-height: 1.2 !important;
      }

      .footer-google-img {
        filter: grayscale(1);
      }

      .google-tab.active .footer-google-img {
        filter: grayscale(0);
      }

      .footer-tabs-div {
        justify-content: space-between !important;
      }

      /* --- feed page ----- */

      .user-profile-img {
        width: 50px;
        height: 50px;
        border-radius: 100%;
        position: relative;
        flex: 0 0 50px;
      }

      .user-profile-img img {
        width: 100%;
        height: 100%;
        border-radius: 100%;
      }

      .icon {
        width: 20px;
        height: 20px;
        position: absolute;
        bottom: 0;
        right: 0;
      }

      .icon img {
        width: 100%;
        height: 100%;
      }

      .name-text-feed-tabs {
        color: white;
        font-size: 20px;
        line-height: 1.1;
      }

      .user-details {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        align-items: center;
      }

      .user-info-text-feed-tabs {
        color: #4F4F4F;
        font-size: 12px;
        line-height: 1.4;
        text-wrap: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }

      .user-text-address {
        color: #4F4F4F;
        font-size: 12px;
        line-height: 1.4;
      }

      .user-name-inffo-div {
        flex-grow: 1;
        min-width: 1px;
      }

      .user-review-text-div {
        font-size: 12px;
        line-height: 1.4;
        color: white;
        margin-top: 10px;
        margin-bottom: 10px;
      }

      .post-img {
        width: 100%;
      }

      .post-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
      }

      .post-slider .swiper-slide {
        width: 100% !important;
      }

      .user-post {
        margin-bottom: 35px;
      }

      .post-end {
        margin-top: 25px;
      }

      .post-end hr {
        border-top: 1px solid #4F4F4F;
      }

      .read-more-btn {
        color: #128ff6;
        margin-left: 5px;
        cursor: pointer;
      }

      .post-date {
        color: #4F4F4F;
        font-size: 12px;
        line-height: 1.4;
      }

      /* .footer-tabs-div {
                padding: 0 20px;
            } */

      .footer-tabs-div span {
        font-size: 14px;
      }

      /* post coment like container css */
      .coment-svg svg {
        stroke: white;

      }

      .post-coment-like-main-div {
        padding: 10px;
      }

      .like-div svg {
        fill: white;
        width: 24px;
        height: 24px;
      }

      .post-coment-like-main-div {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .share-icon svg path {
        stroke: white;
      }

      .google-rivew-section-text {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .post-slider .swiper-pagination-bullet-active {
        /* background-color: black; */
      }

      .iframe-container {
        width: 100%;
        height: 250px;
        overflow: hidden;
        border: 1px solid white;
        border-radius: 15px;

      }

      .preview-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        object-position: center;
        border-radius: 15px 15px 0 0;

      }

      .link-post-div {
        border: 1px solid white;
        border-radius: 15px;
        margin: 0 20px;
      }

      .post-preview-title {
        font-size: 18px;
        line-height: 1.1;
        color: white;
        padding: 5px 5px 0 10px;
      }

      .post-preview-desciption {
        font-size: 14px;
        line-height: 1.1;
        color: #4F4F4F;
        padding: 5px 5px 10px 10px;
      }

      .img-preview-div {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .plya-icon {
        position: absolute;
        width: 50px;
        height: 50px;
        /* border: 1px solid #1a191c; */
        border-radius: 100%;
        background-color: #0000007a;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .plya-icon svg {
        fill: white;
        width: 25px;
        height: 25px;
      }

      .headline {
        text-align: center;
      }

      .address {
        text-align: center;
      }

      /* video section */
      .video-main-div {
        max-width: 100%;
        height: 100%;
        position: relative;
      }

      .video-main-div video {
        width: 100%;
        -webkit-mask: linear-gradient(white 50%, transparent);
        object-fit: cover;
        object-position: top center;
      }

      .video-container {
        height: 100%;
      }

      .mute-btn-profile {
        background-color: white;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 100%;
        position: absolute;
        z-index: 100;
        top: 21px;
        right: 25px;
      }

      .mute-btn-feed {
        background-color: white;
        width: 30px;
        height: 30px;
        bottom: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 100%;
        position: absolute;
        top: auto;
        right: 30px;
        cursor: pointer;
      }

      .d-none {
        display: none;
      }
    </style>

  </head>
  <style>
    .description-text {
      padding: 10px;
    }
  </style>
</head>

<body class="bg-[#121016]">
  <div class="flex justify-center min-h-screen">
    <div class="w-[100%] lg:w-[30%] md:w-[90%] flex flex-col">
      <div class="relative" id="profile-tab">
        <div class="h-full w-full m-auto pb-2">
          <!-- profile-tabs -->
          <div class="flex flex-col justify-center items-center">
            <div class="gradient-bg w-full relative">
              <div class="absolute top-0 left-0 z-50 flex"
                style="width: 100%; justify-content: end; padding: 10px 20px;">
                <div>
                  <div class="panel-group">
                    <div class="panel panel-default new-share-btn ">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a id="shareButton" class="share">
                            <i class="fas fa-share-alt"></i>
                          </a>
                        </h4>
                      </div>
                      <div id="shareButtonDiv" style="display: none;">
                        <div class="addthis_inline_share_toolbox_huav">
                          <div class="a2a_kit a2a_kit_size_32 a2a_default_style ">
                            <div class="share-wrapper">
                              <ul class="social">
                                <li style="background-color: #5784f5; border-radius: 999px; padding: 8px;"
                                  class="copy-tooltip">
                                  <button
                                    onclick="copyToClipboard('{{URL::to($user->slug)}}')"
                                    class="fa fa-clone text-white"
                                    style="margin-left: 5px;">
                                  </button>
                                  <span class="ml-4 text-white bg-white"
                                    id="copiedMessage" style="display: none;">
                                    &nbsp; Copied!</span>
                                </li>
                                <li class="whatsapp-share">
                                  <a href="#"
                                    onclick="shareWhatsApp('{{$user->name}}')">
                                    <img src="{{ asset('assets/profile/images/whatsapp-icon.svg') }}"
                                      alt="WhatsApp Icon" loading="lazy">
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <img class="w-full bg-center bg-cover"
                src="{{$user->image}}" alt="img" loading="lazy" />
            </div>
            <div class="flex flex-col justify-center items-center -mt-20 w-full">
              <div class="flex justify-center items-center relative">
                <div class="w-44 h-44"></div>

                <img src="{{ asset('assets/profile/images/cNbcljynRhaSkIwy1758218678.jpg') }}"
                  class="w-[80%] rounded-[50%] absolute " loading="lazy" />
              </div>

              <div class="w-full">
                <div class="flex flex-col justify-center items-center">
                  <h3 class="text-white text-2xl lg:text-3xl md:text-3xl font-bold mt-4"
                    style="text-align: center;">
                    {{$user->name}}
                  </h3>

                  <p class="text-white text-x mt-1">
                    Shyam Caterers And Event Management
                  </p>

                  <p class="text-gray-400 text-xs mt-1 headline">
                    👑 The King Of Catering Services 👑
                  </p>
                  <p class="text-gray-400 text-xs mt-1 address">
                    {{$user->address}}
                  </p>
                </div>
                <div class="slider-app flex gap-[10px] overflow-auto w-100">

                </div>
              </div>

              <div class="mt-10">
                <div class="flex flex-wrap justify-center gap-4">
                  <a href="tel:{{ $user->contact }}"
                    class="basis-[calc(25%-16px)] w-full aspect-square flex items-center justify-center p-2 rounded-2xl bg-[#0086BF]"
                    target="_blank">
                    <lottie-player src="{{ asset('assets/profile/lottie/phone.json') }}"
                      background="transparent" speed="1" class="w-4/5 h-4/5" loop
                      autoplay></lottie-player>
                  </a>
                  <a href="{{$user->website}}"
                    class="basis-[calc(25%-16px)] w-full aspect-square flex items-center justify-center p-2 rounded-2xl bg-[#001FBF]"
                    target="_blank">
                    <lottie-player src="{{ asset('assets/profile/lottie/website.json') }}"
                      background="transparent" speed="1" class="w-4/5 h-4/5" loop
                      autoplay></lottie-player>
                  </a>
                  <a href="https://wa.me/{{$user->whatsapp_no}}?text=Hello%20I%20am%20interested"
                    class="basis-[calc(25%-16px)] w-full aspect-square flex items-center justify-center p-2 rounded-2xl bg-[#00A110]"
                    target="_blank">
                    <lottie-player src="{{ asset('assets/profile/lottie/whatsapp.json') }}"
                      background="transparent" speed="1" class="w-4/5 h-4/5" loop
                      autoplay></lottie-player>
                  </a>
                  <a href="{{$user->instagram}}"
                    class="basis-[calc(25%-16px)] w-full aspect-square flex items-center justify-center p-2 rounded-2xl bg-[#D72525]"
                    target="_blank">
                    <lottie-player src="{{ asset('assets/profile/lottie/instagram.json') }}"
                      background="transparent" speed="1" class="w-4/5 h-4/5" loop
                      autoplay></lottie-player>
                  </a>
                  <a href="{{$user->facebook}}"
                    class="basis-[calc(25%-16px)] w-full aspect-square flex items-center justify-center p-2 rounded-2xl bg-[#006D9B]"
                    target="_blank">
                    <lottie-player src="{{ asset('assets/profile/lottie/facebook.json') }}"
                      background="transparent" speed="1" class="w-4/5 h-4/5" loop
                      autoplay></lottie-player>
                  </a>
                  <a href="{{$user->map}}"
                    class="basis-[calc(25%-16px)] w-full aspect-square flex items-center justify-center p-2 rounded-2xl bg-[#ED0B0B]"
                    target="_blank">
                    <lottie-player src="{{ asset('assets/profile/lottie/location.json') }}"
                      background="transparent" speed="1" class="w-4/5 h-4/5" loop
                      autoplay></lottie-player>
                  </a>
                  <a href="{{$user->youtube}}"
                    class="basis-[calc(25%-16px)] w-full aspect-square flex items-center justify-center p-2 rounded-2xl bg-[#BF0000]"
                    target="_blank">
                    <lottie-player src="{{ asset('assets/profile/lottie/youtube.json') }}"
                      background="transparent" speed="1" class="w-4/5 h-4/5" loop
                      autoplay></lottie-player>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-10">
            <img class="rounded-lg w-full"
              src="{{$user->file}}" alt="images" loading="lazy" />
          </div>

          <div class="text-gray-400 mt-10 text-justify description-text">
            Shyam Caterers<br />
            The king Of Catering Services
          </div>

          <div class="mt-8 text-center">
            <a href="https://g.page/r/CUZpNauyDYj1EBM/review"
              class="py-4 inline-block w-full rounded-full border-2 border-blue-600 text-white bg-zinc-700"
              target="_blank">
              Google Reviews
            </a>
          </div>
          <div class="mt-10 bg-[#282531] p-4 rounded-lg">
            <p class="font-bold text-white text-sm mb-3">Have a question?</p>


            @if (session()->has('success'))
            <div class="mb-4 flex items-center justify-between rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-800">
              <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 
                    6.707 9.293a1 1 0 00-1.414 1.414l3 
                    3a1 1 0 001.414 0l7-7a1 1 
                    0 000-1.414z" clip-rule="evenodd" />
                </svg>
                <span>{{ session()->get('success') }}</span>
              </div>
              <button type="button" class="ml-2 text-green-600 hover:text-green-800" onclick="this.parentElement.remove()">
                ✕
              </button>
            </div>
            @endif

            @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-300 bg-red-100 px-4 py-3 text-red-800">
              <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form action="{{ URL::to('/contactstore') }}" method="POST" name="contactForm" id="contactForm">
              @csrf
              <div class="flex flex-col space-y-6 mt-4">
                <input type="text" name="website" style="display:none">
                <input id="name" name="name" type="text"
                  class="bg-[#121016] text-white border !border-[#121016] text-sm rounded-lg focus:ring-[#121016] focus:border-[#121016] block w-full p-2.5"
                  placeholder="Your Name*" required />
                <input id="contact" name="contact" type="number"
                  onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                  oninput="this.value = this.value.slice(0, 10);"
                  class="bg-[#121016] text-white border !border-[#121016] text-sm rounded-lg focus:ring-[#121016] focus:border-[#121016] block phone-number p-2.5"
                  placeholder="Mobile Number*" required />
                <input id="email" name="email" type="email"
                  class="bg-[#121016] text-white border !border-[#121016] text-sm rounded-lg focus:ring-[#121016] focus:border-[#121016] block w-full p-2.5"
                  placeholder="Your Email*" required />
                <select id="eventSelect"
                  class="bg-[#121016] text-white border !border-[#121016] text-sm rounded-lg focus:ring-[#121016] focus:border-[#121016] block phone-code p-2.5"
                  name="event" required>
                  <option value="">-- Select Event --</option>
                  @foreach($events as $event)
                  <option value="{{ $event->event_name }}">{{ $event->event_name }}</option>
                  @endforeach
                  <option value="other">Other</option>
                </select>
                <div class="d-none" id="otherEventRow">
                  <input id="otherEventInput" name="other_event" type="text"
                    class="bg-[#121016] text-white border !border-[#121016] text-sm rounded-lg focus:ring-[#121016] focus:border-[#121016] block w-full p-2.5"
                    placeholder="Your Event Name*" />
                </div>

                <textarea id="address" name="address" rows="3"
                  class="block p-2.5 w-full text-sm text-white bg-[#121016] rounded-lg border border-[#121016] focus:ring-[#121016] focus:border-[#121016]"
                  placeholder="Your address..."></textarea>

                <textarea id="venu" name="venu" rows="3"
                  class="block p-2.5 w-full text-sm text-white bg-[#121016] rounded-lg border border-[#121016] focus:ring-[#121016] focus:border-[#121016]"
                  placeholder="Your venue..."></textarea>


                <textarea id="message" name="message" rows="3"
                  class="block p-2.5 w-full text-sm text-white bg-[#121016] rounded-lg border border-[#121016] focus:ring-[#121016] focus:border-[#121016]"
                  placeholder="Your message..."></textarea>

                <div class="flex justify-end">
                  <div id="form-spinner" style="display: none;" class="flex items-center justify-center mt-3">
                    <div class="h-6 w-6 animate-spin rounded-full border-4 border-blue-400 border-t-transparent"></div>
                  </div>
                  <div
                    class="flex items-center py-2 font-bolder px-8 rounded-full text-white bg-blue-400 space-x-2" id="submitBtn">
                    <button type="submit" class="py-1 font-bolder px-8 rounded-full text-white bg-blue-400">
                      Send
                    </button>
                    <lottie-player src="{{ asset('assets/profile/lottie/send_3.json') }}"
                      background="transparent" speed="1" style="width: 20px; height: 20px"
                      loop autoplay></lottie-player>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- feed tabs  -->

      <!-- footer section (bnts)  -->
    </div>
  </div>

  <script>
    document.getElementById('eventSelect').addEventListener('change', function() {
      let otherRow = document.getElementById('otherEventRow');
      if (this.value === 'other') {
        otherRow.classList.remove('d-none');
        document.getElementById('otherEventInput').setAttribute('required', true);
      } else {
        otherRow.classList.add('d-none');
        document.getElementById('otherEventInput').removeAttribute('required');
      }
    });

    document.getElementById("contactForm").addEventListener("submit", function(e) {
      const submitBtn = document.getElementById("submitBtn");
      const spinner = document.getElementById("form-spinner");

      // Disable the button (visually + functionally)
      submitBtn.classList.add("opacity-50", "pointer-events-none");

      // Hide button, show spinner
      submitBtn.style.display = "none";
      spinner.style.display = "block";
    });

    var isAndroid = "";
    var isIOS = "";
    if (isIOS) {
      // window.localtion.href = 'http://onelink.to/xkrbj7';
    }

    $(document).ready(function() {

      console.log("doc ready log")

      $("#shareButton").click(function() {
        $("#shareButtonDiv").toggle();
        $(".social").toggleClass('active');
      });
    })

    function copyToClipboard(element) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val(element).select();
      document.execCommand("copy");
      $temp.remove();

      var copiedMessage = document.getElementById('copiedMessage');
      copiedMessage.style.display = 'inline-block';

      setTimeout(function() {
        copiedMessage.style.display = 'none';
      }, 2000);
    }

    function shareWhatsApp(userName) {
      var message = "Hello " + userName + ",\n\nThis is my business profile:\n" + window.location.href;
      var encodedMessage = encodeURIComponent(message);

      var whatsappUrl = "https://wa.me/?text=" + encodedMessage;
      window.open(whatsappUrl, "_blank");
    }
  </script>

  <!-- Page JS -->
</body>

</html>