<div class="upper-section">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Footer Col-->
            <div class="footer-col info-col col-lg-6 col-md-12 col-sm-12">

                <div class="logo">
                    <a href="{{URL::to('/')}}" title="SHYAM CATERERS"><img src="{{ asset('front_assets/images/logo.png') }}" alt="" title="SHYAM CATERERS" loading="lazy"></a>
                </div>
                <div class="inner wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">

                    <div class="content">

                        <div class="info">
                            <h3 style="margin-bottom: 10px;">Shyam Caterers & Event Managment</h3>
                            <!-- <ul>
                                <li>Open : 09:00 am - 01:00 pm</li>
                            </ul> -->
                        </div>
                        <div class="separator"><span></span><span></span><span></span></div>
                        <div class="info">
                            <h3 style="margin-bottom: 10px;">SURAT BRANCH OFFICE </h3>
                            <ul>
                                <li>{{ $surat_address }}</li>
                                <li><a href="mailto:{{ $surat_email }}">{{ $surat_email }}</a></li>
                                <li><a href="tel:+91 {{ $surat_contact }}">Booking Request :+91 {{ $surat_contact }}</a></li>
                            </ul>
                        </div>
                        <div class="separator"><span></span><span></span><span></span></div>
                        <div class="info">
                            <h3 style="margin-bottom: 10px;">AMRELI BRANCH OFFICE</h3>
                            <ul>
                                <li> {{ $amreli_address }}</li>
                                <li><a href="mailto:{{ $amreli_email }}">{{ $amreli_email }}</a></li>
                                <li><a href="tel:+91 {{ $amreli_contact }}">Booking Request :+91 {{ $amreli_contact }}</a></li>
                            </ul>
                        </div>
                        <div class="separator"><span></span><span></span><span></span></div>

                    </div>
                </div>
            </div>
            <!--Footer Col-->
            <div class="footer-col links-col col-lg-3 col-md-6 col-sm-12">
                <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <ul class="links">
                        <li class="{{ Request::is('/') ? 'current' : '' }}"><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="{{ Request::is('about') ? 'current' : '' }}"><a href="{{ URL::to('/about') }}">About Us</a></li>
                        <li class="{{ Request::is('gallerys') ? 'current' : '' }}"><a href="{{ URL::to('/gallerys') }}">Gallery</a></li>
                        <li class="{{ Request::is('contact') ? 'current' : '' }}"><a href="{{ URL::to('/contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
            <!--Footer Col-->
            <div class="footer-col links-col last col-lg-3 col-md-6 col-sm-12">
                <div class="inner wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <ul class="links">
                        <li><a href="{{$facebook}}" target="_blank">facebook</a></li>
                        <li><a href="{{$instagram}}" target="_blank">instagram</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="auto-container">
        <div class="copyright">&copy; <?= date('Y'); ?> Shyam Caterers. All Rights Reserved</div>
    </div>
</div>