<!-- Hidden Bar Wrapper -->
<div class="inner-box">
  <div class="cross-icon hidden-bar-closer"><span class="far fa-close"></span></div>
  <div class="logo-box"><a href="{{URL::to('/')}}" title="SHYAM CATERERS"><img src="{{ asset('front_assets/images/logo.png') }}" alt="" title="SHYAM CATERERS" loading="lazy"></a></div>

  <!-- .Side-menu -->
  <div class="side-menu">
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
      <li class="dropdown {{ Request::is('cuisine*') ? 'current' : '' }}"><a>cusions</a>
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
  </div><!-- /.Side-menu -->

  <h2>Visit Us</h2>
  <ul class="info">
    <div class="separator"><span></span></div>
    <li style="margin-bottom: 10px;"><u>SURAT BRANCH OFFICE</u></li>
    <li>{{ $surat_address }}</li>
    <li><a href="mailto:{{ $surat_email }}">{{ $surat_email }}</a></li>
    <li><a href="tel:+91 {{ $surat_contact }}">+91 {{ $surat_contact }}</a></li>
    <div class="separator"><span></span></div>

    <li style="margin-bottom: 10px;"><u>AMRELI BRANCH OFFICE</u></li>
    <li>{{ $amreli_address }}</li>
    <li><a href="mailto:{{ $amreli_email }}">{{ $amreli_email }}</a></li>
    <li><a href="tel:+91 {{ $amreli_contact }}">+91 {{ $amreli_contact }}</a></li>
  </ul>
</div>
<!-- / Hidden Bar Wrapper -->