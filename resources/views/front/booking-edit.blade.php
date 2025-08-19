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
      <h1><span>Edit Booking</span></h1>
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
          <h3 class="mb-4">Edit Customer &amp; Event Info</h3>
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

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session()->get('success') }}
        </div>
        @endif

        <form action="{{ route('bookings.update', $booking->id) }}" id="editBookingForm" method="POST">
          @csrf
          @method('PUT')

          <div class="row mb-3">
            <div class="col-md-4 label-block">
              <label class="form-label">Customer Name <span class="text-danger">*</span></label>
              <input type="text" name="customer_name" class="form-control" placeholder="Enter name" value="{{ $booking->customer_name }}" required
                @if($errors->has('customer_name'))
              <div class="error text-danger">{{ $errors->first('customer_name') }}</div>
              @endif>
            </div>

            <div class="col-md-4 label-block">
              <label class="form-label">Contact Number <span class="text-danger">*</span></label>
              <input type="number" name="phone_no" id="phone_no" class="form-control" placeholder="Enter mobile number" value="{{ $booking->phone_no }}" oninput="this.value = this.value.slice(0, 10);" required>
              @if($errors->has('phone_no'))
              <div class="error text-danger">{{ $errors->first('phone_no') }}</div>
              @endif
            </div>

            <div class="col-md-4 label-block">
              <label class="form-label">Email<span class="text-danger">*</span></label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ $booking->email }}" required>
              @if($errors->has('email'))
              <div class="error text-danger">{{ $errors->first('email') }}</div>
              @endif
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6 label-block">
              <label class="form-label">Event Type <span class="text-danger">*</span></label>
              <select name="event_type" class="form-select" required>
                <option value="">-- Select Event --</option>
                @foreach ($eventtypes as $event)
                <option value="{{ $event->id }}" {{ $event->id == $booking->event_type ? 'selected' : '' }}>{{ $event->event_name }}</option>
                @endforeach
              </select>
              @if($errors->has('event_type'))
              <div class="error text-danger">{{ $errors->first('event_type') }}</div>
              @endif
            </div>

            <div class="col-md-6 label-block">
              <label class="form-label">Event Date <span class="text-danger">*</span></label>
              <input type="text" name="event_date" id="event_date" class="form-control datetimepicker input" placeholder="Enter event Date" value="{{ $booking->event_date }}" required>
              @if($errors->has('event_date'))
              <div class="error text-danger">{{ $errors->first('event_date') }}</div>
              @endif
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6 label-block">
              <label class="form-label">Address <span class="text-danger">*</span></label>
              <textarea name="address" row="3" class="form-control" placeholder="Enter address" required>{{ $booking->address }}</textarea>
              @if($errors->has('address'))
              <div class="error text-danger">{{ $errors->first('address') }}</div>
              @endif
            </div>

            <div class="col-md-6 label-block">
              <label class="form-label">Venue <span class="text-danger">*</span></label>
              <textarea name="venue" row="3" class="form-control" placeholder="Enter event venue" required>{{ $booking->venue }}</textarea>
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
          <div class="table-responsive">
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
                @foreach($functions as $index => $function)
                <tr>
                  <td>
                    <select name="functions[{{ $index }}][fun_id]" class="form-select" required>
                      <option value="">-- Select Function --</option>
                      @foreach ($functionOptions as $option)
                      <option value="{{ $option->id }}" {{ $function['fun_id'] == $option->id ? 'selected' : '' }}>
                        {{ $option->function_type }}
                      </option>
                      @endforeach
                    </select>
                  </td>
                  <td><input type="number" name="functions[{{ $index }}][person]" class="form-control" value="{{ $function['person'] }}" placeholder="Enter person" required></td>
                  <td><input type="text" name="functions[{{ $index }}][datetime]" class="form-control datetimepicker" placeholder="Enter date time" value="{{ \Carbon\Carbon::parse($function['datetime'])->format('Y-m-d H:i') }}" required></td>
                  <!-- <td><input type="number" name="functions[0][rate]" class="form-control" placeholder="Enter rate"></td> -->
                  <td class="action">
                    @if(count($functions) > 1)
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeFunctionRow(this)"><i class="fa fa-trash"></i></button>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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

          <button type="submit" id="submitBtn" class="theme-btn btn-style-one clearfix mt-2">
            <span class="btn-wrap">
              <span class="text-one">Update & Menu Preparation</span>
              <span class="text-two">Update & Menu Preparation</span>
            </span>
          </button>

          <!-- <a href="/menu-preparation/{{$booking->id}}" class="theme-btn btn-style-one clearfix mt-2">
            <span class="btn-wrap">
              <span class="text-one">Menu Preparation</span>
              <span class="text-two">Menu Preparation</span>
            </span>
          </a> -->

        </form>
      </div>
    </div>
  </div>
</section>

@endsection

@section('page_script')
<script>
  document.getElementById('editBookingForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('form-spinner');

    // Disable button & show spinner
    submitBtn.disabled = true;
    spinner.style.display = 'block';
  });
</script>

<script>
  const functionOptions = @json($functionOptions);
  let index = <?= count($functions) ?>;

  function addFunctionRow() {
    const row = document.createElement('tr');

    let functionSelect = `<select name="functions[${index}][fun_id]" class="form-select" required>`;
    functionSelect += '<option value="">-- Select Function --</option>';
    functionOptions.forEach(func => {
      functionSelect += `<option value="${func.id}">${func.function_type}</option>`;
    });
    functionSelect += '</select>';

    row.innerHTML = `
            <td>${functionSelect}</td>
            <td><input type="number" name="functions[${index}][person]" class="form-control" placeholder="Enter person" required></td>
            <td><input type="text" name="functions[${index}][datetime]" class="form-control datetimepicker" placeholder="Enter date time" required></td>
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
    const confirmDelete = confirm("Are you sure you want to remove this function?");
    if (confirmDelete) {
      button.closest('tr').remove();
      toggleRemoveButtons();
    }
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
      altFormat: "F j, Y h:i K",
      allowInput: true
    });
  }

  // Initial run for already-rendered input
  initializeDateTimePickers();
</script>
@endsection