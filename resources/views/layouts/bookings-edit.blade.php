<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4">Edit Booking</h3>

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

                <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" class="form-control" value="{{ $booking->customer_name }}" placeholder="Enter name" required>
                            @if($errors->has('customer_name'))
                            <div class="error text-danger">{{ $errors->first('customer_name') }}</div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                            <input type="tel" name="phone_no" id="phone_no" class="form-control" placeholder="Enter mobile number" value="{{ $booking->phone_no }}" required>
                            @if($errors->has('phone_no'))
                            <div class="error text-danger">{{ $errors->first('phone_no') }}</div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ $booking->email }}" required>
                            @if($errors->has('email'))
                            <div class="error text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
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

                        <div class="col-md-6">
                            <label class="form-label">Event Date <span class="text-danger">*</span></label>
                            <input type="text" name="event_date" id="event_date" class="form-control datetimepicker" value="{{ $booking->event_date }}" placeholder="Enter event Date" required>
                            @if($errors->has('event_date'))
                            <div class="error text-danger">{{ $errors->first('event_date') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" row="3" class="form-control" placeholder="Enter address" required>{{ $booking->address }}</textarea>
                            @if($errors->has('address'))
                            <div class="error text-danger">{{ $errors->first('address') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Venue <span class="text-danger">*</span></label>
                            <textarea name="venue" row="3" class="form-control" placeholder="Enter event venue" required>{{ $booking->venue }}</textarea>
                            @if($errors->has('venue'))
                            <div class="error text-danger">{{ $errors->first('venue') }}</div>
                            @endif
                        </div>
                    </div>

                    <hr class="my-4">
                    <h4>Functions</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" id="functionTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Function Type <span class="text-danger">*</span></th>
                                    <th>Person <span class="text-danger">*</span></th>
                                    <th>Date & Time <span class="text-danger">*</span></th>
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
                                    <td><input type="text" name="functions[{{ $index }}][person]" class="form-control" placeholder="Enter person" value="{{ $function['person'] }}" required></td>
                                    <td><input type="text" name="functions[{{ $index }}][datetime]" class="form-control datetimepicker" placeholder="Enter Date time" value="{{ \Carbon\Carbon::parse($function['datetime'])->format('Y-m-d H:i') }}" required></td>
                                    <!-- <td><input type="number" name="functions[0][rate]" class="form-control" placeholder="Enter rate"></td> -->
                                    <td class="action">
                                        @if(count($functions) > 1)
                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeFunctionRow(this)">Remove</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-4">
                        <button type="button" class="btn btn-outline-primary" onclick="addFunctionRow()">+ Add Function</button>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="/menu-preparation/{{$booking->id}}" class="btn btn-secondary">Menu Preparation</a>
                </form>
            </div>
        </div>
    </div>



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
            <td><input type="text" name="functions[${index}][person]" class="form-control" placeholder="Enter person" required></td>
            <td><input type="text" name="functions[${index}][datetime]" class="form-control datetimepicker" placeholder="Enter event Date" required></td>
            <td class="action">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeFunctionRow(this)">Remove</button>
            </td>
        `;

            document.getElementById('functionRows').appendChild(row);
            index++;
            initializeDateTimePickers();
        }

        function removeFunctionRow(button) {
            const row = button.closest('tr');
            row.remove();
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        window.onload = initializeDateTimePickers;
    </script>

</body>

</html>