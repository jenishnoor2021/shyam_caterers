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

    <li style="margin-bottom: 10px;"><u>SURAT BRANCH OFFICE</u></li>

    <li>{{ $company_address }}
    </li>
    <div class="separator"><span></span></div>

    <li style="margin-bottom: 10px;"><u>AMRELI BRANCH OFFICE</u></li>
    <li> Opp. ST, Bus Stand, Station Road, Amreli - 365601(Gujarat)
    </li>
    <div class="separator"><span></span></div>
    <li>Open: 9.30 am - 2.30pm</li>
    <div class="separator"><span></span></div>
    <li>
      <a href="mailto:{{ $company_email }}">{{ $company_email }}</a>
    </li>
  </ul>
  <div class="separator"><span></span></div>
  <div class="booking-info">
    <div class="bk-title">Booking request</div>
    <div class="bk-no">
      <a href="tel:+91 {{ $company_contact }}">+91 {{ $company_contact }}</a>
    </div>
  </div>
</div>