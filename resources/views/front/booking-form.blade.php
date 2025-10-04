@extends('layouts.front')

@section('page_style')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
  .function-card {
    position: relative;
  }

  .function-card .card {
    background: transparent;
    border: 2px solid rgb(228, 197, 144);
  }

  .function-card .card-body {
    padding: 1rem;
  }

  .function-card .form-label {
    margin-bottom: 0.25rem;
  }

  .action-mobile .btn {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
  }

  @media (max-width: 767.98px) {
    .function-card+.function-card {
      margin-top: 1rem;
    }

    .function-card .card-body {
      padding: 0.75rem;
    }
  }
</style>
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
          <div class="table-responsive d-none d-md-block">
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

          <!-- Mobile Card View -->
          <div class="d-block d-md-none" id="functionCardContainer">
            <div class="function-card mb-3" data-index="0">
              <div class="card border">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 mb-3">
                      <label class="form-label fw-bold">Function Type <span class="text-danger">*</span></label>
                      <select name="functions[0][fun_id]" class="form-select function-select" required>
                        <option value="">-- Select Function --</option>
                        @foreach ($functions as $function)
                        <option value="{{ $function->id }}" data-time="{{ $function->time }}">{{ $function->function_type }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label fw-bold">Person <span class="text-danger">*</span></label>
                      <input type="number" name="functions[0][person]" class="form-control" placeholder="Enter person" required>
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label fw-bold">Date &amp; Time <span class="text-danger">*</span></label>
                      <input type="text" name="functions[0][datetime]" class="form-control datetimepicker" placeholder="Enter date time" required>
                    </div>
                    <div class="col-12">
                      <div class="action-mobile text-end"></div>
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
    let lastDateTime = '';
    let isValid = true;

    // Check if we're on mobile or desktop
    const isMobile = window.innerWidth < 768;

    if (isMobile) {
      // Validate mobile cards
      const mobileCards = document.querySelectorAll(".function-card");
      const lastCard = mobileCards[mobileCards.length - 1];
      const selects = lastCard.querySelectorAll("select[required]");
      const inputs = lastCard.querySelectorAll("input[required]");

      [...selects, ...inputs].forEach(input => {
        if (!input.value.trim()) {
          isValid = false;
        }
      });

      if (lastCard.querySelector("input[name*='[datetime]']")) {
        lastDateTime = lastCard.querySelector("input[name*='[datetime]']").value;
      }
    } else {
      // Validate desktop table
      const desktopRows = document.querySelectorAll("#functionRows tr");
      const lastRow = desktopRows[desktopRows.length - 1];
      const selects = lastRow.querySelectorAll("select[required]");
      const inputs = lastRow.querySelectorAll("input[required]");

      [...selects, ...inputs].forEach(input => {
        if (!input.value.trim()) {
          isValid = false;
        }
      });

      if (lastRow.querySelector("input[name*='[datetime]']")) {
        lastDateTime = lastRow.querySelector("input[name*='[datetime]']").value;
      }
    }

    if (!isValid) {
      Swal.fire({
        icon: 'error',
        title: 'All fields are required',
        text: 'Please fill in all fields before adding a new function.',
      });
      return;
    }

    // Create function select options HTML
    let functionSelectHTML = '<select name="functions[' + index + '][fun_id]" class="form-select function-select" required>';
    functionSelectHTML += '<option value="">-- Select Function --</option>';
    functionOptions.forEach(func => {
      functionSelectHTML += `<option value="${func.id}" data-time="${func.time}">${func.function_type}</option>`;
    });
    functionSelectHTML += '</select>';

    // Add to desktop table (always create both, but only one will be visible)
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${functionSelectHTML}</td>
      <td><input type="number" name="functions[${index}][person]" class="form-control" placeholder="Enter person" required></td>
      <td><input type="text" name="functions[${index}][datetime]" class="form-control datetimepicker" placeholder="Enter date time" value="${lastDateTime}" required></td>
      <td class="action"></td>
    `;
    document.getElementById('functionRows').appendChild(row);

    // Add to mobile cards
    const cardContainer = document.getElementById('functionCardContainer');
    const newCard = document.createElement('div');
    newCard.className = 'function-card mb-3';
    newCard.setAttribute('data-index', index);

    newCard.innerHTML = `
      <div class="card border">
        <div class="card-body">
          <div class="row">
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Function Type <span class="text-danger">*</span></label>
              ${functionSelectHTML}
            </div>
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Person <span class="text-danger">*</span></label>
              <input type="number" name="functions[${index}][person]" class="form-control" placeholder="Enter person" required>
            </div>
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Date &amp; Time <span class="text-danger">*</span></label>
              <input type="text" name="functions[${index}][datetime]" class="form-control datetimepicker" placeholder="Enter date time" value="${lastDateTime}" required>
            </div>
            <div class="col-12">
              <div class="action-mobile text-end"></div>
            </div>
          </div>
        </div>
      </div>
    `;
    cardContainer.appendChild(newCard);

    index++;

    // Initialize date pickers for new elements
    setTimeout(() => {
      initializeDateTimePickers();
      toggleRemoveButtons();
    }, 100);
  }

  function removeFunction(button, isMobile = false) {
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
        let elementIndex;

        if (isMobile) {
          const card = button.closest('.function-card');
          const allCards = document.querySelectorAll('.function-card');
          elementIndex = Array.from(allCards).indexOf(card);
          card.remove();

          // Remove corresponding desktop row
          const desktopRows = document.querySelectorAll("#functionRows tr");
          if (desktopRows[elementIndex]) {
            desktopRows[elementIndex].remove();
          }
        } else {
          const row = button.closest('tr');
          const allRows = document.querySelectorAll("#functionRows tr");
          elementIndex = Array.from(allRows).indexOf(row);
          row.remove();

          // Remove corresponding mobile card
          const mobileCards = document.querySelectorAll(".function-card");
          if (mobileCards[elementIndex]) {
            mobileCards[elementIndex].remove();
          }
        }

        toggleRemoveButtons();
        Swal.fire('Removed!', 'The function has been removed.', 'success');
      }
    });
  }

  // Separate functions for desktop and mobile remove buttons
  function removeFunctionRow(button) {
    removeFunction(button, false);
  }

  function removeFunctionCard(button) {
    removeFunction(button, true);
  }

  function toggleRemoveButtons() {
    const rows = document.querySelectorAll("#functionRows tr");
    const cards = document.querySelectorAll(".function-card");

    // Toggle desktop table buttons
    rows.forEach((row, i) => {
      const actionCell = row.querySelector('.action');
      if (rows.length === 1) {
        actionCell.innerHTML = '';
      } else {
        actionCell.innerHTML = `<button type="button" class="btn btn-sm btn-danger" onclick="removeFunctionRow(this)"><i class="fa fa-trash"></i></button>`;
      }
    });

    // Toggle mobile card buttons
    cards.forEach((card, i) => {
      const actionCell = card.querySelector('.action-mobile');
      if (cards.length === 1) {
        actionCell.innerHTML = '';
      } else {
        actionCell.innerHTML = `<button type="button" class="btn btn-sm btn-danger" onclick="removeFunctionCard(this)"><i class="fa fa-trash"></i> Remove</button>`;
      }
    });
  }

  // Add event listeners to sync values when inputs change
  document.addEventListener('input', function(e) {
    if (e.target.matches('#functionRows input, #functionRows select, .function-card input, .function-card select')) {
      // Find the corresponding element in the other layout
      const isInMobile = e.target.closest('.function-card') !== null;
      const isInDesktop = e.target.closest('#functionRows tr') !== null;

      if (isInMobile) {
        // Sync to desktop
        const card = e.target.closest('.function-card');
        const cardIndex = Array.from(document.querySelectorAll('.function-card')).indexOf(card);
        const desktopRows = document.querySelectorAll('#functionRows tr');

        if (desktopRows[cardIndex]) {
          const fieldName = e.target.name;
          const correspondingField = desktopRows[cardIndex].querySelector(`[name="${fieldName}"]`);
          if (correspondingField) {
            correspondingField.value = e.target.value;
          }
        }
      } else if (isInDesktop) {
        // Sync to mobile
        const row = e.target.closest('tr');
        const rowIndex = Array.from(document.querySelectorAll('#functionRows tr')).indexOf(row);
        const mobileCards = document.querySelectorAll('.function-card');

        if (mobileCards[rowIndex]) {
          const fieldName = e.target.name;
          const correspondingField = mobileCards[rowIndex].querySelector(`[name="${fieldName}"]`);
          if (correspondingField) {
            correspondingField.value = e.target.value;
          }
        }
      }
    }
  });

  window.onload = function() {
    toggleRemoveButtons();
    initializeDateTimePickers();
  };
</script>

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  function initializeDateTimePickers() {
    // Destroy existing instances first to avoid conflicts
    document.querySelectorAll(".datetimepicker").forEach(input => {
      if (input._flatpickr) {
        input._flatpickr.destroy();
      }
    });

    // Initialize all date time picker inputs
    flatpickr(".datetimepicker", {
      enableTime: true,
      dateFormat: "Y-m-d H:i",
      altInput: true,
      altFormat: "Y-m-d H:i",
      allowInput: true,
      disableMobile: true,
      onChange: function(selectedDates, dateStr, instance) {
        // Sync the value to the corresponding input in the other layout
        const input = instance.input;
        const fieldName = input.name;

        // Find corresponding field in other layout
        if (input.closest('.function-card')) {
          // This is mobile, sync to desktop
          const card = input.closest('.function-card');
          const cardIndex = Array.from(document.querySelectorAll('.function-card')).indexOf(card);
          const desktopRows = document.querySelectorAll('#functionRows tr');

          if (desktopRows[cardIndex]) {
            const correspondingField = desktopRows[cardIndex].querySelector(`[name="${fieldName}"]`);
            if (correspondingField && correspondingField._flatpickr) {
              correspondingField._flatpickr.setDate(dateStr, true);
            }
          }
        } else if (input.closest('#functionRows')) {
          // This is desktop, sync to mobile
          const row = input.closest('tr');
          const rowIndex = Array.from(document.querySelectorAll('#functionRows tr')).indexOf(row);
          const mobileCards = document.querySelectorAll('.function-card');

          if (mobileCards[rowIndex]) {
            const correspondingField = mobileCards[rowIndex].querySelector(`[name="${fieldName}"]`);
            if (correspondingField && correspondingField._flatpickr) {
              correspondingField._flatpickr.setDate(dateStr, true);
            }
          }
        }
      }
    });
  }

  // Initial run for already-rendered input
  // initializeDateTimePickers();

  // Dropdown change
//   document.addEventListener("change", function(e) {
//     if (e.target.classList.contains("function-select")) {
//       const selected = e.target.options[e.target.selectedIndex];
//       const defaultTime = selected.getAttribute("data-time");

//       if (defaultTime && e.target.value) {
//         const fieldName = e.target.name;
//         let currentCard = null;
//         let currentRow = null;

//         // Determine if this change is from mobile or desktop
//         if (e.target.closest('.function-card')) {
//           currentCard = e.target.closest('.function-card');
//         } else if (e.target.closest('#functionRows')) {
//           currentRow = e.target.closest('tr');
//         }

//         // Function to set date with time
//         const setDateWithTime = (datetimeInput) => {
//           if (datetimeInput && datetimeInput._flatpickr) {
//             let currentDate = datetimeInput._flatpickr.selectedDates[0] || new Date();
//             let yyyy = currentDate.getFullYear();
//             let mm = String(currentDate.getMonth() + 1).padStart(2, "0");
//             let dd = String(currentDate.getDate()).padStart(2, "0");
//             let dateTimeString = `${yyyy}-${mm}-${dd} ${defaultTime}`;

//             datetimeInput._flatpickr.setDate(dateTimeString, true, "Y-m-d h:i K");
//           }
//         };

//         if (currentCard) {
//           // Update mobile card datetime
//           const mobileDateInput = currentCard.querySelector(".datetimepicker");
//           setDateWithTime(mobileDateInput);

//           // Find and update corresponding desktop row
//           const cardIndex = Array.from(document.querySelectorAll('.function-card')).indexOf(currentCard);
//           const desktopRows = document.querySelectorAll('#functionRows tr');

//           if (desktopRows[cardIndex]) {
//             // Sync the dropdown selection
//             const desktopSelect = desktopRows[cardIndex].querySelector(`[name="${fieldName}"]`);
//             if (desktopSelect) {
//               desktopSelect.value = e.target.value;
//             }

//             // Update desktop datetime
//             const desktopDateInput = desktopRows[cardIndex].querySelector(".datetimepicker");
//             setDateWithTime(desktopDateInput);
//           }

//         } else if (currentRow) {
//           // Update desktop row datetime
//           const desktopDateInput = currentRow.querySelector(".datetimepicker");
//           setDateWithTime(desktopDateInput);

//           // Find and update corresponding mobile card
//           const rowIndex = Array.from(document.querySelectorAll('#functionRows tr')).indexOf(currentRow);
//           const mobileCards = document.querySelectorAll('.function-card');

//           if (mobileCards[rowIndex]) {
//             // Sync the dropdown selection
//             const mobileSelect = mobileCards[rowIndex].querySelector(`[name="${fieldName}"]`);
//             if (mobileSelect) {
//               mobileSelect.value = e.target.value;
//             }

//             // Update mobile datetime
//             const mobileDateInput = mobileCards[rowIndex].querySelector(".datetimepicker");
//             setDateWithTime(mobileDateInput);
//           }
//         }
//       }
//     }
//   });


document.addEventListener("change", function(e) {
    if (e.target.classList.contains("function-select")) {
        const selected = e.target.options[e.target.selectedIndex];
        const defaultTime = selected.getAttribute("data-time");

        if (defaultTime && e.target.value) {
            const fieldName = e.target.name;

            // Find the datetime input in the same row/card
            let datetimeInput = null;
            let functionWrapper = null;

            if (e.target.closest('.function-card')) {
                // Mobile card - find the parent column of function dropdown
                functionWrapper = e.target.closest('.col-12.mb-3');
                datetimeInput = e.target.closest('.function-card').querySelector(".datetimepicker");
            } else if (e.target.closest('tr')) {
                // Desktop row - find the td containing function dropdown
                functionWrapper = e.target.closest('td');
                datetimeInput = e.target.closest('tr').querySelector(".datetimepicker");
            }

            // SHOW FEEDBACK FIRST (before setting time)
            if (datetimeInput && functionWrapper) {
                // Disable dropdown immediately
                e.target.disabled = true;
                e.target.style.opacity = '0.6';

                // Create loading indicator BELOW function dropdown
                const loadingSpinner = document.createElement('div');
                loadingSpinner.className = 'datetime-loading-indicator';
                loadingSpinner.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Setting time...';
                loadingSpinner.style.cssText =
                    'color: #856404; font-size: 12px; margin-top: 5px; font-weight: 500;';

                // Add loading indicator below the function dropdown
                functionWrapper.appendChild(loadingSpinner);

                // Disable datetime input
                datetimeInput.disabled = true;
                datetimeInput.style.opacity = '0.6';

                // Store reference to the dropdown for later re-enabling
                const dropdown = e.target;

                // Function to restore UI - guaranteed to run
                const restoreUI = () => {
                    datetimeInput.style.opacity = '';
                    datetimeInput.disabled = false;
                    dropdown.disabled = false;
                    dropdown.style.opacity = '1';

                    // Remove loading indicator
                    if (loadingSpinner && loadingSpinner.parentNode) {
                        loadingSpinner.remove();
                    }
                };

                // Use setTimeout to allow UI to update before heavy operation
                setTimeout(() => {
                    try {
                        // NOW set the time (this is the slow part)
                        if (datetimeInput._flatpickr) {
                            let currentDate = datetimeInput._flatpickr.selectedDates[0] ||
                            new Date();
                            let yyyy = currentDate.getFullYear();
                            let mm = String(currentDate.getMonth() + 1).padStart(2, "0");
                            let dd = String(currentDate.getDate()).padStart(2, "0");
                            let dateTimeString = `${yyyy}-${mm}-${dd} ${defaultTime}`;

                            datetimeInput._flatpickr.setDate(dateTimeString, true, "Y-m-d H:i");
                        }

                        // Sync to the other layout (mobile/desktop)
                        let currentCard = dropdown.closest('.function-card');
                        let currentRow = dropdown.closest('tr');

                        if (currentCard) {
                            const cardIndex = Array.from(document.querySelectorAll(
                                '.function-card')).indexOf(currentCard);
                            const desktopRows = document.querySelectorAll('#functionRows tr');

                            if (desktopRows[cardIndex]) {
                                const desktopSelect = desktopRows[cardIndex].querySelector(
                                    `[name="${fieldName}"]`);
                                if (desktopSelect) desktopSelect.value = dropdown.value;

                                const desktopDateInput = desktopRows[cardIndex].querySelector(
                                    ".datetimepicker");
                                if (desktopDateInput && desktopDateInput._flatpickr) {
                                    let currentDate = desktopDateInput._flatpickr.selectedDates[
                                        0] || new Date();
                                    let yyyy = currentDate.getFullYear();
                                    let mm = String(currentDate.getMonth() + 1).padStart(2, "0");
                                    let dd = String(currentDate.getDate()).padStart(2, "0");
                                    let dateTimeString = `${yyyy}-${mm}-${dd} ${defaultTime}`;
                                    desktopDateInput._flatpickr.setDate(dateTimeString, true,
                                        "Y-m-d H:i");
                                }
                            }
                        } else if (currentRow) {
                            const rowIndex = Array.from(document.querySelectorAll(
                                '#functionRows tr')).indexOf(currentRow);
                            const mobileCards = document.querySelectorAll('.function-card');

                            if (mobileCards[rowIndex]) {
                                const mobileSelect = mobileCards[rowIndex].querySelector(
                                    `[name="${fieldName}"]`);
                                if (mobileSelect) mobileSelect.value = dropdown.value;

                                const mobileDateInput = mobileCards[rowIndex].querySelector(
                                    ".datetimepicker");
                                if (mobileDateInput && mobileDateInput._flatpickr) {
                                    let currentDate = mobileDateInput._flatpickr.selectedDates[0] ||
                                        new Date();
                                    let yyyy = currentDate.getFullYear();
                                    let mm = String(currentDate.getMonth() + 1).padStart(2, "0");
                                    let dd = String(currentDate.getDate()).padStart(2, "0");
                                    let dateTimeString = `${yyyy}-${mm}-${dd} ${defaultTime}`;
                                    mobileDateInput._flatpickr.setDate(dateTimeString, true,
                                        "Y-m-d H:i");
                                }
                            }
                        }
                    } catch (error) {
                        console.error('Error setting datetime:', error);
                    } finally {
                        // ALWAYS restore UI, even if there's an error
                        restoreUI();
                    }

                }, 50); // Small delay to let UI update before processing
            }
        }
    }
});

</script>
@endsection