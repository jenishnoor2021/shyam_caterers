<!DOCTYPE html>
<html lang="en">

<head>
    @include('front_includes.head')

    @yield('page_style')

    <style>
        #instagram_icon {
            bottom: 150px;
            cursor: pointer;
            overflow: hidden;
            position: fixed;
            right: 20px;
            left: auto;
            text-align: center;
            z-index: 1000;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
        }

        #instagram_icon img {
            height: 50px;
            width: 50px;
        }
    </style>
</head>

<body class="loading">

    <div class="page-wrapper">

        <!-- Page Loader -->
        <div class="loader-mask">
            <!--<div class="loader">-->
            <!--    <div class="round_loader_block">-->
            <!--        <span class="round_loader"></span>-->

            <!--        <img src="{{ asset('front_assets/images/logo.png') }}" alt="Loader_Logo" class="loader_logo" loading="lazy">-->
            <!--    </div>-->

            <!--    <span class="text_loader" style="font-size: 25px !important;">SHYAM CATERERS</span>-->
            <!--</div>-->
            <video width="100%" height="100%" autoplay muted loop playsinline style="background:#000;">
                <source src="{{ asset('front_assets/images/logo.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <!-- Preloader -->
        <!-- <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close">x</div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="S" class="letters-loading">
                                S
                            </span>
                            <span data-text-preloader="H" class="letters-loading">
                                H
                            </span>
                            <span data-text-preloader="Y" class="letters-loading">
                                Y
                            </span>
                            <span data-text-preloader="A" class="letters-loading">
                                A
                            </span>
                            <span data-text-preloader="M" class="letters-loading">
                                M
                            </span>
                            <span>
                            </span>
                            <span data-text-preloader="C" class="letters-loading">
                                C
                            </span>
                            <span data-text-preloader="A" class="letters-loading">
                                A
                            </span> <span data-text-preloader="T" class="letters-loading">
                                T
                            </span> <span data-text-preloader="E" class="letters-loading">
                                E
                            </span> <span data-text-preloader="R" class="letters-loading">
                                R
                            </span>
                             <span data-text-preloader="E" class="letters-loading">
                                E
                            </span>  <span data-text-preloader="R" class="letters-loading">
                                R
                            </span>
                              <span data-text-preloader="S" class="letters-loading">
                                S
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Preloader End -->

        <!-- ======= Header ======= -->
        <header class="main-header header-down">
            @include('front_includes.header')
        </header>

        <!--Menu Backdrop-->
        <div class="menu-backdrop"></div>

        <!-- Hidden Navigation Bar -->
        <section class="hidden-bar">
            @include('front_includes.sidebar')
        </section>
        <!-- / Hidden Bar -->

        <!--Info Back Drop-->
        <div class="info-back-drop"></div>

        <!-- Hidden Bar -->
        <section class="info-bar">
            @include('front_includes.info')
        </section>
        <!--End Hidden Bar -->

        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <main>
            @yield('content')
        </main>
        <!-- end main content-->

        <footer class="main-footer">
            @include('front_includes.footer')
        </footer>

    </div>

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-up"></span></div>

    <a href="https://wa.me/+91{{ $surat_contact }}" target="_blank" id="whatsapp_icon">
        <span class="text-white" style="font-size:12px;">Need Help? Chat with us</span>
        <img src="{{asset('front_assets/images/whatsapp.png')}}" alt="whatsapp-img">
    </a>

    <a href="{{$instagram}}" target="_blank" id="instagram_icon">
        <span class="text-white" style="font-size:12px;">More details Follow us...</span>
        <img src="{{asset('front_assets/images/Instagram.png')}}" alt="whatsapp-img">
    </a>

    <!-- Google tag (gtag.js) -->
    <!-- <script async="" src="gtag/js?id=G-7GVC8RLE1L"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-7GVC8RLE1L');
    </script> -->

    <script src="{{ asset('front_assets/js/jquery.js') }}"></script>
    <script src="{{ asset('front_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('front_assets/js/swiper.js') }}"></script>
    <script src="{{ asset('front_assets/js/owl.js') }}"></script>
    <script src="{{ asset('front_assets/js/appear.js') }}"></script>
    <script src="{{ asset('front_assets/js/wow.js') }}"></script>
    <script src="{{ asset('front_assets/js/parallax.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/custom-script.js') }}"></script>

    <script>
        // window.addEventListener('load', function() {
        //     const loader = document.querySelector('.loader-mask');
        //     loader.classList.add('fade-out');

        //     document.body.classList.add('hidden');

        //     setTimeout(() => {
        //         loader.style.display = 'none';
        //         document.body.classList.remove('hidden');
        //     }, 1000); // after transition
        // });

        window.addEventListener("load", () => {
            document.body.classList.remove("loading");
            document.querySelector(".loader-mask").style.display = "none";
        });
    </script>
    @yield('page_script')
</body>

</html>