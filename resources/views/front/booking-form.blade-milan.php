@extends('layouts.front')

@section('page_style')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')

<!-- Inner Banner Section -->
<section class="inner-banner">
  <div class="image-layer" style="background-image: url({{asset('front_assets/images/resource/aboutbg.jpg')}})"></div>
  <div class="auto-container">
    <div class="inner">


      <h1><span>Booking</span></h1>
    </div>
  </div>
</section>
<!--End Banner Section -->

<section class="booking-form team-section form">
  <div class="left-bot-bg"><img src="{{ asset('front_assets/images/background/bg-1.png') }}" alt="" title=""></div>
  <div class="right-top-bg"><img src="{{ asset('front_assets/images/background/bg-6.png') }}" alt="" title=""></div>
  <div class="auto-container">
    <div class="card shadow">
      <div class="card-body">
        <div class="sec-head">
          <h3 class="mb-4">Customer &amp; Event Info</h3>
          <div class="pattern-image1">
            <img src="{{ asset('front_assets/images/icons/separator.svg') }}" alt="" title="" loading="lazy">
          </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{ route('booking.submit') }}" id="newBookingForm" method="POST">
          @csrf
          <div class="row mb-3">
            <div class="col-md-6 label-block">
              <label class="form-label">Customer Name <span class="text-danger">*</span></label>
              <input type="text" name="customer_name" class="form-control" placeholder="Enter name" required
                @if($errors->has('customer_name'))
              <div class="error text-danger">{{ $errors->first('customer_name') }}</div>
              @endif>
            </div>

            <div class="col-md-6 label-block">
              <label class="form-label">Contact Number <span class="text-danger">*</span></label>
              <input type="number" name="phone_no" id="phone_no" class="form-control" placeholder="Enter mobile number" oninput="this.value = this.value.slice(0, 10);" required>
              @if($errors->has('phone_no'))
              <div class="error text-danger">{{ $errors->first('phone_no') }}</div>
              @endif
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6 label-block">
              <label class="form-label">Email<span class="text-danger">*</span></label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
              @if($errors->has('email'))
              <div class="error text-danger">{{ $errors->first('email') }}</div>
              @endif
            </div>

            <div class="col-md-6 label-block">
              <label class="form-label">Event Type <span class="text-danger">*</span></label>
              <select name="event_type" class="form-select" required>
                <option value="">-- Select Event --</option>
                @foreach ($eventtypes as $event)
                <option value="{{ $event->id }}">{{ $event->event_name }}</option>
                @endforeach
              </select>
              @if($errors->has('event_type'))
              <div class="error text-danger">{{ $errors->first('event_type') }}</div>
              @endif
            </div>

            <!-- <div class="col-md-6 label-block">
              <label class="form-label">Event Date <span class="text-danger">*</span></label>
              <input type="text" name="event_date" id="event_date" class="form-control datetimepicker input" placeholder="Enter event Date" required>
              @if($errors->has('event_date'))
              <div class="error text-danger">{{ $errors->first('event_date') }}</div>
              @endif
            </div> -->
          </div>

          <div class="row mb-3">
            <div class="col-md-6 label-block">
              <label class="form-label">Address <span class="text-danger">*</span></label>
              <textarea name="address" row="3" class="form-control" placeholder="Enter address" required></textarea>
              @if($errors->has('address'))
              <div class="error text-danger">{{ $errors->first('address') }}</div>
              @endif
            </div>

            <div class="col-md-6 label-block">
              <label class="form-label">Venue <span class="text-danger">*</span></label>
              <textarea name="venue" row="3" class="form-control" placeholder="Enter event venue" required></textarea>
              @if($errors->has('venue'))
              <div class="error text-danger">{{ $errors->first('venue') }}</div>
              @endif
            </div>
          </div>

          <hr class="my-4">

          <div class="sec-head">
            <h3 class="mb-4">Functions</h3>
            <div class="pattern-image1">
              <img src="{{asset('front_assets/images/icons/separator.svg')}}" alt="" title="" loading="lazy">
            </div>
          </div>
          <div class="table-responsive mobile-hidden">
            <table class="table table-bordered align-middle" id="functionTable">
              <thead class="table-light">
                <tr>
                  <th>Function Type <span class="text-danger">*</span></th>
                  <th>Person <span class="text-danger">*</span></th>
                  <th>Date &amp; Time <span class="text-danger">*</span></th>
                  <!-- <th>Rate</th> -->
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="functionRows">
                <tr>
                  <td>
                    <select name="functions[0][fun_id]" class="form-select function-select" required>
                      <option value="">-- Select Function --</option>
                      @foreach ($functions as $function)
                      <option value="{{ $function->id }}" data-time="{{ $function->time }}">{{ $function->function_type }}</option>
                      @endforeach
                    </select>
                  </td>
                  <td><input type="number" name="functions[0][person]" class="form-control" placeholder="Enter person" required></td>
                  <td><input type="text" name="functions[0][datetime]" class="form-control datetimepicker" placeholder="Enter date time" required></td>
                  <!-- <td><input type="number" name="functions[0][rate]" class="form-control" placeholder="Enter rate"></td> -->
                  <td class="action"></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="accordion desktop-hidden" id="functionAccordion">
            <!-- First Item (Open by Default) -->
            <div class="accordion-item">
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#functionAccordion">
                <div class="accordion-body">
                  <div class="row g-3">
                    <div class="col-md-4" style="margin-bottom:12px;">
                      <label class="form-label">Function Type <span class="text-danger">*</span></label>
                      <select name="functions[0][fun_id]" class="form-select function-select" required>
                        <option value="">-- Select Function --</option>
                        <option value="2" data-time="8:00 PM">DINNER</option>
                        <option value="1" data-time="11:00 AM">LUNCH</option>
                        <option value="3" data-time="8:00 AM">WELCOME DRINK</option>
                      </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom:12px;">
                      <label class="form-label">Person <span class="text-danger">*</span></label>
                      <input type="number" name="functions[0][person]" class="form-control" placeholder="Enter person" required>
                    </div>
                    <div class="col-md-4" style="margin-bottom:12px;">
                      <label class="form-label">Date & Time <span class="text-danger">*</span></label>
                      <input type="text" name="functions[0][datetime]" class="form-control datetimepicker" placeholder="Enter date time" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-5">
            <button type="button" class="theme-btn btn-style-one clearfix" onclick="addFunctionRow()">
              <span class="btn-wrap">
                <span class="text-one">+ Add Function</span>
                <span class="text-two">+ Add Function</span>
              </span>
            </button>
          </div>

          <div id="form-spinner" style="display: none;" class="text-center mt-3">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden"></span>
            </div>
          </div>

          <button type="submit" id="submitBtn" class="theme-btn btn-style-one clearfix">
            <span class="btn-wrap">
              <span class="text-one">Submit</span>
              <span class="text-two">Submit</span>
            </span>
          </button>
        </form>
      </div>
    </div>
  </div>
</section>
<style>
  .accordion-collapse {
    margin-bottom: 30px;
  }

  @media(min-width: 768px) {
    .accordion.desktop-hidden {
      display: none !important;
    }

    .table-responsive.mobile-hidden {
      display: block !important;
    }
  }

  @media(max-width: 767px) {
    .table-responsive.mobile-hidden {
      display: none !important;
    }

    .accordion.desktop-hidden {
      display: block !important;
    }
  }
</style>
@endsection

@section('page_script')
<script>
  document.getElementById('newBookingForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('form-spinner');

    // Disable button & show spinner
    submitBtn.disabled = true;
    spinner.style.display = 'block';
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  let index = 1;
  const functionOptions = @json($functions);

  function addFunctionRow() {
    const rows = document.querySelectorAll("#functionRows tr");
    const lastRow = rows[rows.length - 1];

    // Validate required fields in the last row
    const selects = lastRow.querySelectorAll("select[required]");
    const inputs = lastRow.querySelectorAll("input[required]");
    let isValid = true;

    [...selects, ...inputs].forEach(input => {
      if (!input.value.trim()) {
        isValid = false;
      }
    });

    if (!isValid) {
      Swal.fire({
        icon: 'error',
        title: 'All fields are required',
        text: 'Please fill in all fields before adding a new function.',
      });
      return;
    }

    // Get datetime value from last row to copy into new row
    const lastDateTime = lastRow.querySelector("input[name*='[datetime]']").value;

    const row = document.createElement('tr');

    let functionSelect = '<select name="functions[' + index + '][fun_id]" class="form-select function-select" required>';
    functionSelect += '<option value="">-- Select Function --</option>';
    functionOptions.forEach(func => {
      functionSelect += `<option value="${func.id}" data-time="${func.time}">${func.function_type}</option>`;
    });
    functionSelect += '</select>';

    row.innerHTML = `
            <td>${functionSelect}</td>
            <td><input type="number" name="functions[${index}][person]" class="form-control" placeholder="Enter person" required></td>
            <td><input type="text" name="functions[${index}][datetime]" class="form-control datetimepicker" placeholder="Enter date time" value="${lastDateTime}" required></td>
            <td class="action">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeFunctionRow(this)"><i class="fa fa-trash"></i></button>
            </td>
        `;
    document.getElementById('functionRows').appendChild(row);
    index++;
    toggleRemoveButtons();
    initializeDateTimePickers();
  }

  function removeFunctionRow(button) {
    Swal.fire({
      title: 'Are you sure?',
      text: "Do you want to remove this function?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, remove it!',
      cancelButtonText: 'Cancel',
      reverseButtons: true,
      backdrop: true,
      allowOutsideClick: false
    }).then((result) => {
      if (result.isConfirmed) {
        button.closest('tr').remove();
        toggleRemoveButtons();
        Swal.fire(
          'Removed!',
          'The function has been removed.',
          'success'
        )
      }
    });
  }

  function toggleRemoveButtons() {
    const rows = document.querySelectorAll("#functionRows tr");
    rows.forEach((row, i) => {
      const actionCell = row.querySelector('.action');
      if (rows.length === 1) {
        actionCell.innerHTML = '';
      } else {
        actionCell.innerHTML = `<button type="button" class="btn btn-sm btn-danger" onclick="removeFunctionRow(this)"><i class="fa fa-trash"></i></button>`;
      }
    });
  }

  window.onload = toggleRemoveButtons;
</script>

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  function initializeDateTimePickers() {
    flatpickr(".datetimepicker", {
      enableTime: true,
      dateFormat: "Y-m-d H:i",
      altInput: true,
      // altFormat: "F j, Y h:i K",
      altFormat: "Y-m-d H:i",
      allowInput: true
    });
  }

  // Initial run for already-rendered input
  initializeDateTimePickers();

  // Dropdown change
  document.addEventListener("change", function(e) {
    if (e.target.classList.contains("function-select")) {
      const selected = e.target.options[e.target.selectedIndex];
      const defaultTime = selected.getAttribute("data-time"); // e.g. "8:00 PM"

      if (defaultTime) {
        const row = e.target.closest("tr");
        const datetimeInput = row.querySelector(".datetimepicker");

        if (datetimeInput._flatpickr) {
          let currentDate = datetimeInput._flatpickr.selectedDates[0] || new Date();

          // Build string in the same format as flatpickr altFormat
          let yyyy = currentDate.getFullYear();
          let mm = String(currentDate.getMonth() + 1).padStart(2, "0");
          let dd = String(currentDate.getDate()).padStart(2, "0");

          let dateTimeString = `${yyyy}-${mm}-${dd} ${defaultTime}`; // "2025-09-13 8:00 PM"

          // Explicitly parse using same format with AM/PM
          datetimeInput._flatpickr.setDate(dateTimeString, true, "Y-m-d h:i K");
        }
      }
    }
  });
</script>
@endsection