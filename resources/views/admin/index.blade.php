@extends('layouts.admin')

@section('content')
@section('style')
<style>
    .form-check-input {
        width: 2em;
        height: 1em;
        background-color: #e4e4e4;
        border-radius: 1em;
        position: relative;
        appearance: none;
        outline: none;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .form-check-input:checked {
        background-color: #4caf50;
    }

    .form-check-input::before {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 0.8em;
        height: 0.8em;
        background-color: white;
        border-radius: 50%;
        transition: transform 0.3s ease-in-out;
    }

    .form-check-input:checked::before {
        transform: translateX(1em);
    }
</style>
@endsection

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="row">

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Events</p>
                                <h4 class="mb-0">{{ $countEvents }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Gallery</p>
                                <h4 class="mb-0">{{ $countGallery }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Functions</p>
                                <h4 class="mb-0">{{ $countFunctions }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Event Type</p>
                                <h4 class="mb-0">{{ $countEventType }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Menu Category</p>
                                <h4 class="mb-0">{{ $countCategory }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Menu Item</p>
                                <h4 class="mb-0">{{ $countMenuItem }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Cuisine Category</p>
                                <h4 class="mb-0">{{ $countCuiCate }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Cuisine Items</p>
                                <h4 class="mb-0">{{ $countCuiItem }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Inquiry</p>
                                <h4 class="mb-0">{{ $countContacts }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center ">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-archive-in font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Current Month Events</h4>
                @if (count($currentMonthEvents) > 0)
                <div class="table-responsive">
                    <table id="" class="table table-bordered dt-responsive nowrap w-100 mt-3">
                        <thead class="table-light">
                            <tr>
                                <!-- <th>Action</th> -->
                                <th>Client Name</th>
                                <th>Phone No</th>
                                <th>Email</th>
                                <th>Event Name</th>
                                <th>Event Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currentMonthEvents as $book)
                            <tr>
                                <!-- <td>
                                </td> -->
                                <td>{{ $book->customer_name }}</td>
                                <td>{{ $book->phone_no }}</td>
                                <td>{{ $book->email }}</td>
                                <td>{{ $book->events->event_name ?? '-' }}</td>
                                <td>{{ $book->event_date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).on('change', '.toggle-status-switch', function() {
        const toggleSwitch = $(this);
        const agentId = toggleSwitch.data('id');
        const type = toggleSwitch.data('type');
        const isChecked = toggleSwitch.is(':checked');

        let $url = "";
        if (type === 'contact') {
            $url = "{{ route('admin.contact.active') }}";
        }

        $.ajax({
            url: $url,
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
@endsection