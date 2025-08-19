@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Events</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">


                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div id="right">
                    <div id="menu" class="mb-3">

                        <span id="menu-navi"
                            class="d-sm-flex flex-wrap text-center text-sm-start justify-content-sm-between">
                            <div class="d-flex align-items-center gap-2 flex-wrap mb-3">
                                <a class="btn btn-info waves-effect waves-light"
                                    href="{{ route('admin.events.create') }}"><i class="fa fa-plus editable" style="font-size:15px;">&nbsp;ADD</i></a>
                            </div>
                        </span>

                    </div>
                </div>

                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 mt-3">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Type</th>
                            <th>Background Image</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Show/Hide</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                            <td>
                                <a href="{{ route('admin.events.edit', $event->id) }}"
                                    class="btn btn-outline-primary waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('admin.events.destroy', $event->id) }}"
                                    onclick="return confirm('Sure ! You want to delete ?');"
                                    class="btn btn-outline-danger waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                            <td>{{ $event->event_type }}</td>
                            <td>
                                <img src="{{ $event->poster }}" alt="poster" width="50px" hight="50px" loading="lazy">
                            </td>
                            <td>
                                <img src="{{ $event->file }}" alt="img" width="50px" hight="50px" loading="lazy">
                            </td>
                            <td>
                                <div class="html-read-more-content">{{ $event->detail }}</div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-status-switch" type="checkbox"
                                        id="toggleSwitch{{ $event->id }}" data-id="{{ $event->id }}"
                                        {{ $event->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="toggleSwitch{{ $event->id }}">
                                        {{ $event->is_active ? 'Show' : 'Hide' }}
                                    </label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

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
            url: "{{ route('admin.events.active') }}",
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