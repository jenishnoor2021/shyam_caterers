@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Meal Type</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    Add Meal
                </h4>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::open([
                'method' => 'POST',
                'action' => 'AdminMealTypeController@store',
                'files' => true,
                'class' => 'form-horizontal',
                'name' => 'addMealForm',
                ]) !!}
                @csrf

                <div class="row">
                    <div class="mb-3">
                        <label for="meal_type">Meal Type<span class="text-danger">*</span></label>
                        <input type="text" name="meal_type" class="form-control text-uppercase" id="meal_type"
                            placeholder="Enter function name" value="{{ old('meal_type') }}" required>
                        @if ($errors->has('meal_type'))
                        <div class="error text-danger">{{ $errors->first('meal_type') }}</div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-1 align-self-center">
                    <div class="d-flex gap-2">
                        <input type="submit" class="btn btn-primary w-md" id="submitBtn" value="Submit" />
                        <span id="loadingText" style="display:none; margin-left:10px;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Meal Type List</h4>

                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 mt-3">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Show/Hide</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($meals as $meal)
                        <tr>
                            <td>
                                <a href="{{ route('admin.meal.edit', $meal->id) }}"
                                    class="btn btn-outline-primary waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('admin.meal.destroy', $meal->id) }}"
                                    onclick="return confirm('Sure ! You want to delete ?');"
                                    class="btn btn-outline-danger waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                            <td>{{ $meal->meal_type }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-status-switch" type="checkbox"
                                        id="toggleSwitch{{ $meal->id }}" data-id="{{ $meal->id }}"
                                        {{ $meal->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="toggleSwitch{{ $meal->id }}">
                                        {{ $meal->is_active ? 'Show' : 'Hide' }}
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
    $(function() {
        $("form[name='addMealForm']").validate({
            rules: {
                meal_type: {
                    required: true,
                },
            },
            submitHandler: function(form) {
                $("#submitBtn").prop('disabled', true);
                $("#loadingText").show();

                form.submit();
            }
        });
    });
</script>

<script>
    $(document).on('change', '.toggle-status-switch', function() {
        const toggleSwitch = $(this);
        const agentId = toggleSwitch.data('id');
        const isChecked = toggleSwitch.is(':checked');

        $.ajax({
            url: "{{ route('admin.meal.active') }}",
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