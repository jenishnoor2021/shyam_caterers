<div class="inner-box">
  <div class="cross-icon"><span class="far fa-close"></span></div>
  <!-- <div class="logo-box">
    <a href="{{URL::to('/')}}" title="SHYAM CATERERS"><img
        src="{{ asset('front_assets/images/logo.png') }}"
        alt=""
        title="SHYAM CATERERS" loading="lazy" /></a>
  </div> -->
  <div class="image-box">
    <img src="{{ asset('front_assets/images/logo.png') }}" alt="" title="" loading="lazy" />
  </div>

  <h2>Visit Us</h2>
  <ul class="info">
    <!-- <li>
      Corporate Catering Service in All over Gujrat | Veg.
      Caterers | Wedding Caterers - SHYAM CATERERS <br />
      | Veg. Caterers | Wedding Caterers - SHYAM CATERERS
    </li> -->
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
    <!-- <div class="separator"><span></span></div> -->
    <!-- <li>Open: 9.30 am - 2.30pm</li> -->
    <!-- <div class="separator"><span></span></div> -->

  </ul>
  <!-- <div class="separator"><span></span></div> -->
</div>