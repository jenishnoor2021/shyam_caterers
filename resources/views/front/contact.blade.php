@extends('layouts.front')

@section('page_style')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
<!--Map Section-->
<section class="inner-banner">
    <div class="image-layer" style="background-image: url({{asset('front_assets/images/resource/aboutbg.jpg')}})"></div>
    <div class="auto-container">
        <div class="inner">
            <h1><span>Contact US</span></h1>
        </div>
    </div>
</section>
<!--Contact Info Section-->

<section class="booking-form team-section form">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-1.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-6.png')}}" alt="" title="" loading="lazy"></div>
    <div class="auto-container">
        <div class="card shadow">
            <div class="card-body">
                <div class="sec-head">
                    <h3 class="mb-4">Get In Touch</h3>
                    <div class="pattern-image1">
                        <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                    </div>
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

                <form action="{{ URL::to('/contactstore') }}" method="POST" name="contactForm" id="contactForm">
                    @csrf
                    <input type="text" name="website" style="display:none">
                    <div class="row mb-3">
                        <div class="col-md-4 label-block">
                            <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{old('name')}}" required>
                        </div>

                        <div class="col-md-4 label-block">
                            <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                            <input type="number" name="contact" id="contact" class="form-control" oninput="this.value = this.value.slice(0, 10);" placeholder="Enter mobile number" value="{{old('contact')}}" required>
                        </div>

                        <div class="col-md-4 label-block">
                            <label class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{old('email')}}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 label-block">
                            <label class="form-label">Event Type <span class="text-danger">*</span></label>
                            <select name="event" class="form-select" id="eventSelect" required>
                                <option value="">-- Select Event --</option>
                                @foreach($events as $event)
                                <option value="{{ $event->event_name }}">{{ $event->event_name }}</option>
                                @endforeach
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-6 label-block">
                            <label class="form-label">Event Date <span class="text-danger">*</span></label>
                            <input name="event_date" id="event_date" class="form-control datetimepicker flatpickr-input" value="{{old('event_date')}}" placeholder="Enter event Date" required>
                        </div>
                    </div>

                    <!-- {{-- Hidden input for custom event --}} -->
                    <div class="row mb-3 d-none" id="otherEventRow">
                        <div class="col-md-12 label-block">
                            <label class="form-label">Enter Event <span class="text-danger">*</span></label>
                            <input type="text" name="other_event" id="otherEventInput" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 label-block">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" row="3" class="form-control" placeholder="Enter address" required>{{old('address')}}</textarea>
                        </div>

                        <div class="col-md-6 label-block">
                            <label class="form-label">Venue <span class="text-danger">*</span></label>
                            <textarea name="venu" row="3" class="form-control" placeholder="Enter event venue" required>{{old('venu')}}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12 label-block">
                            <label class="form-label">Message </label>
                            <textarea name="message" row="3" class="form-control" placeholder="Enter event venue">{{old('message')}}</textarea>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div id="form-spinner" style="display: none;" class="text-center mt-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden"></span>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" id="submitBtn" class="theme-btn btn-style-one clearfix">
                            <span class="btn-wrap">
                                <span class="text-one">Submit</span>
                                <span class="text-two">Submit</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="booking-form team-section form">
    <div class="left-bot-bg"><img src="{{asset('front_assets/images/background/bg-1.png')}}" alt="" title="" loading="lazy"></div>
    <div class="right-top-bg"><img src="{{asset('front_assets/images/background/bg-6.png')}}" alt="" title="" loading="lazy"></div>
    <div class="row" style="margin:0;">
        <div class="col-12 col-lg-6">
            <div class="sec-head">
                <h3 class="mb-4" style="text-align: center;">Surat Office</h3>
                <div class="pattern-image1">
                    <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                </div>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29754.470859750465!2d72.87722520860565!3d21.219597711512485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f62b66296f1%3A0xf5880db2ab356946!2sSHYAM%20CATERERS!5e0!3m2!1sen!2sin!4v1754203566785!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-12 col-lg-6">
            <div class="sec-head">
                <h3 class="mb-4" style="text-align: center;">Amreli Office</h3>
                <div class="pattern-image1">
                    <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
                </div>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3709.5473635150997!2d71.2204693752726!3d21.603584480193625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395880c409027433%3A0x202c9293c5d198ac!2sShyam%20Caterers!5e0!3m2!1sen!2sin!4v1754586608023!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

@endsection

@section('page_script')
<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const spinner = document.getElementById('form-spinner');

        // Disable button & show spinner
        submitBtn.disabled = true;
        spinner.style.display = 'block';
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    function initializeDateTimePickers() {
        flatpickr(".datetimepicker", {
            enableTime: false,
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y",
            allowInput: true
        });
    }

    // Initial run for already-rendered input
    initializeDateTimePickers();
</script>

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
</script>
@endsection