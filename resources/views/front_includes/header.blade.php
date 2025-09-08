<!-- Header Upper -->
<div class="header-upper">
    <div class="auto-container">
        <!-- Main Box -->
        <div class="main-box clearfix">

            <!--Logo-->
            <div class="logo-box">
                <div class="logo"><a href="{{ URL::to('/') }}" title="SHYAM CATERERS"><img loading="lazy" src="{{ asset('front_assets/images/logo.png') }}" alt="" title="SHYAM CATERERS"></a>
                </div>
            </div>

            <div class="nav-box clearfix">
                <!--Nav Outer-->
                <div class="nav-outer clearfix">
                    <nav class="main-menu">
                        <ul class="navigation clearfix">
                            <li class="{{ Request::is('/') ? 'current' : '' }}"><a href="{{ URL::to('/') }}">Home</a>
                            </li>
                            <li class="{{ Request::is('about') ? 'current' : '' }}"><a href="{{ URL::to('/about') }}">About Us</a></li>

                            <li class="dropdown {{ Request::is('event*') ? 'current' : '' }}"><a>Events</a>
                                <ul>
                                    @foreach ($eventNames as $event)
                                    <li class="{{ Request::is('event/' . $event->id) ? 'current' : '' }}"><a href="{{ route('site.event', $event->id) }}">{{ $event->event_type }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown {{ Request::is('cuisine*') ? 'current' : '' }}"><a>cuisine</a>
                                <ul>
                                    @foreach ($cusineCategoryNames as $cuisine)
                                    <li class="{{ Request::is('cuisine/' . $cuisine->id) ? 'current' : '' }}"><a href="{{ route('site.cuisine', $cuisine->id) }}">{{ $cuisine->category_name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="{{ Request::is('gallerys') ? 'current' : '' }}"><a href="{{ URL::to('/gallerys') }}">Gallery</a></li>
                            <li class="{{ Request::is('packages') ? 'current' : '' }}"><a href="{{ URL::to('/packages') }}">Packages</a></li>
                            <li class="{{ Request::is('contact') ? 'current' : '' }}"><a href="{{ URL::to('/contact') }}">Contact</a></li>

                        </ul>
                    </nav>
                    <!-- Main Menu End-->
                </div>
                <!--Nav Outer End-->

                <div class="links-box clearfix">

                    <div class="link info-toggler">
                        <button class="info-btn">
                            <span class="hamburger">
                                <span class="top-bun"></span>
                                <span class="meat"></span>
                                <span class="bottom-bun"></span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Hidden Nav Toggler -->
                <div class="nav-toggler">
                    <button class="hidden-bar-opener">
                        <span class="hamburger">
                            <span class="top-bun"></span>
                            <span class="meat"></span>
                            <span class="bottom-bun"></span>
                        </span>
                    </button>
                </div>

            </div>

            <a href="{{ URL::to('/booking') }}" class="theme-btn btn-style-one clearfix">
                <span class="btn-wrap">
                    <span class="text-one">Book Now</span>
                    <span class="text-two">Book Now</span>
                </span>
            </a>
        </div>
    </div>
</div>