@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Booking List</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div id="right">
                    <div id="menu" class="mb-3">

                        <span id="menu-navi"
                            class="d-sm-flex flex-wrap text-center text-sm-start justify-content-sm-between">
                            <div class="d-flex align-items-center gap-2 flex-wrap mb-3">
                                <!-- <a class="btn btn-info waves-effect waves-light"
                                    href="{{ route('admin.company.create') }}"><i class="fa fa-plus editable" style="font-size:15px;">&nbsp;ADD</i></a> -->
                            </div>
                        </span>

                    </div>
                </div>

                {{-- FILTER FORM --}}
                <form action="{{ route('admin.booking.index') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="month" name="month" value="{{ request('month') }}" placeholder="Select month" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="date" value="{{ request('date') }}" placeholder="Select date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                            <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary">Clear</a>
                        </div>
                    </div>
                </form>

                {{-- BULK DELETE FORM --}}
                <form action="{{ route('admin.booking.bulkDelete') }}" method="POST" id="bulk-delete-form">
                    @csrf
                    {{-- Preserve filters in hidden inputs --}}
                    <input type="hidden" name="month" value="{{ request('month') }}">
                    <input type="hidden" name="date" value="{{ request('date') }}">

                    <div class="text-end mb-2">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete selected records?')">Delete Selected</button>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive w-100 mt-3">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Action</th>
                                <th>Client Name</th>
                                <th>Phone No</th>
                                <th>Email</th>
                                <th>Event Name</th>
                                <th>Event Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($booking as $book)
                            <tr>
                                <td>
                                    <input type="checkbox" name="ids[]" value="{{ $book->id }}" class="checkbox-item">
                                </td>
                                <td>
                                    <a href="{{ route('bookings.edit', $book->id) }}"
                                        class="btn btn-outline-primary waves-effect waves-light" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="{{ route('menu.preparation', $book->id) }}"
                                        class="btn btn-outline-primary waves-effect waves-light" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Menu Preparation"><i
                                            class="fa fa-bars"></i></a>
                                    <a href="{{ route('menu.pdf', $book->id) }}"
                                        class="btn btn-outline-primary waves-effect waves-light" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF"><i style="font-size:18px" class="fa">&#xf1c1;</i></a>
                                    <a href="{{ route('admin.booking.destroy', $book->id) }}"
                                        onclick="return confirm('Sure ! You want to delete ?');"
                                        class="btn btn-outline-danger waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                                <td>{{ $book->customer_name }}</td>
                                <td>{{ $book->phone_no }}</td>
                                <td>{{ $book->email }}</td>
                                <td>{{ $book->events->event_name ?? '-' }}</td>
                                <td>{{ $book->event_date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

@section('script')
<script>
    $(document).on('change', '.toggle-status-switch', function() {
        const toggleSwitch = $(this);
        const agentId = toggleSwitch.data('id');
        const isChecked = toggleSwitch.is(':checked');

        $.ajax({
            url: "{{ route('admin.company.active') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: agentId
            },
            success: function(response) {
                if (response.success) {
                    toggleSwitch.next('label').text(response.status);
                    alert('Status updated successfully');
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
                // Revert toggle state in case of an error
                toggleSwitch.prop('checked', !isChecked);
            }
        });
    });
</script>

<script>
    document.getElementById('select-all').addEventListener('change', function() {
        const isChecked = this.checked;
        document.querySelectorAll('.checkbox-item').forEach(cb => cb.checked = isChecked);
    });
</script>
@endsection