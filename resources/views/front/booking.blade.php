@extends('layouts.front')

@section('page_style')
<style>
  .separator img {
    display: block;
    margin: 0 auto;
  }

  h3 {
    font-size: 32px;
    line-height: 1.3;
    margin-bottom: 10px;
  }

  .theme-btn {
    margin-top: 15px;
  }
</style>
@endsection

@section('content')
<!--Map Section-->
<section class="inner-banner">
  <div
    class="image-layer"
    style="background-image: url({{asset('front_assets/images/background/about-bg.jpg')}})"></div>
  <div class="auto-container">
    <div class="inner">
      <h1><span>Booking</span></h1>
    </div>
  </div>
</section>
<!--Contact Info Section-->

<section class="booking-form team-section form py-5">
  <div class="">
    <div class="row g-4 justify-content-center mb-2">
      <!-- New Booking -->
      <div class="col-11 col-md-6 col-lg-5 card-item">
        <div class="card h-100 border-light rounded-4 text-center p-4">
          <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
            <h3 class="mb-2">New Booking</h3>

            <div class="separator mb-3">
              <img src="{{ asset('front_assets/images/icons/separator.svg') }}" alt="separator" loading="lazy" style="height: 20px;">
            </div>

            <div id="form-spinner-new" style="display: none;" class="text-center mt-3">
              <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden"></span>
              </div>
            </div>

            <a href="{{ url('/booking-form') }}" class="theme-btn btn-style-one clearfix" id="newBookingClick">
              <span class="btn-wrap">
                <span class="text-one">New Booking</span>
                <span class="text-two">New Booking</span>
              </span>
            </a>
          </div>
        </div>
      </div>

      <!-- Edit Booking -->
      <div class="col-11 col-md-6 col-lg-5 card-item">
        <div class="card h-100 border-light rounded-4 text-center p-4">
          <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
            <h3 class="mb-2">Edit Booking</h3>
            <div class="separator mb-3">
              <img src="{{ asset('front_assets/images/icons/separator.svg') }}" alt="separator" loading="lazy" style="height: 20px;">
            </div>

            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="mdi mdi-check-all me-2"></i>
              {{ session()->get('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form action="{{ url('/contactsFind') }}" method="POST" name="editBookingFind" id="editBookingFind">
              @csrf
              <div class="mb-3 text-start">
                <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                <input type="number" name="contact" id="contact" class="form-control" placeholder="Enter mobile number" value="{{ old('contact') }}" oninput="this.value = this.value.slice(0, 10);" required>
              </div>

              <div id="form-spinner" style="display: none;" class="text-center mt-3">
                <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden"></span>
                </div>
              </div>

              <button type="submit" id="submitBtn" class="theme-btn btn-style-one clearfix mx-auto">
                <span class="btn-wrap">
                  <span class="text-one">Submit</span>
                  <span class="text-two">Submit</span>
                </span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('page_script')
<script>
  document.getElementById('editBookingFind').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('form-spinner');

    // Disable button & show spinner
    submitBtn.disabled = true;
    spinner.style.display = 'block';
  });
  document.getElementById('newBookingClick').addEventListener('click', function(e) {
    const submitBtn = document.getElementById('newBookingClick');
    const spinner = document.getElementById('form-spinner-new');

    // Disable button & show spinner
    submitBtn.disabled = true;
    spinner.style.display = 'block';
  });
</script>
@endsection