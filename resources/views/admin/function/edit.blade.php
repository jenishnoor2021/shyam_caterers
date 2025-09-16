@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Edit Function</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::model($function, [
                'method' => 'PATCH',
                'action' => ['AdminFunctionController@update', $function->id],
                'files' => true,
                'class' => 'form-horizontal',
                'name' => 'editFunctionForm',
                ]) !!}
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="function_type">Function Type<span class="text-danger">*</span></label>
                            <input type="text" name="function_type" class="form-control text-uppercase" id="function_type" value="{{$function->function_type}}"
                                placeholder="Enter function name" required>
                            @if ($errors->has('function_type'))
                            <div class="error text-danger">{{ $errors->first('function_type') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="time">Time<span class="text-danger">*</span></label>
                            <input type="time" name="time" class="form-control" id="time" value="{{ $function->time ? \Carbon\Carbon::createFromFormat('g:i A', $function->time)->format('H:i') : '' }}"
                                placeholder="Select time" required>
                            <small class="form-text text-muted">Select time in 12-hour format (e.g., 11:00 AM, 07:30 PM)</small>
                            @if ($errors->has('time'))
                            <div class="error text-danger">{{ $errors->first('time') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-1 align-self-center">
                    <div class="d-flex gap-2">
                        <input type="submit" class="btn btn-primary w-md" id="submitBtn" value="Submit" />
                        <span id="loadingText" style="display:none; margin-left:10px;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
                        <a class="btn btn-light mt-3 mt-lg-0" href="{{ URL::to('/admin/function') }}">Back</a>
                    </div>
                </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
@endsection

@section('script')
<script>
    $(function() {

        // Convert 24-hour format to 12-hour format for display
        function convertTo12Hour(time24) {
            if (!time24) return '';

            const [hours, minutes] = time24.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const hour12 = hour === 0 ? 12 : hour > 12 ? hour - 12 : hour;

            return `${hour12}:${minutes} ${ampm}`;
        }

        // Auto-open time picker when input is focused
        $('#time').on('focus click', function() {
            this.showPicker && this.showPicker();
        });

        // Handle time input change to show 12-hour format in a display field
        $('#time').on('change', function() {
            const time24 = $(this).val();
            const time12 = convertTo12Hour(time24);

            // Create or update display element
            let displayElement = $('#time-display');
            if (displayElement.length === 0) {
                displayElement = $('<div id="time-display" class="form-text text-success mt-1"></div>');
                $(this).after(displayElement);
            }

            if (time12) {
                displayElement.text(`Selected time: ${time12}`).show();
            } else {
                displayElement.hide();
            }
        });

        $("form[name='editFunctionForm']").validate({
            rules: {
                function_type: {
                    required: true,
                },
                time: {
                    required: true,
                },
            },
            messages: {
                time: {
                    required: "Please select a time for the function",
                }
            },
            submitHandler: function(form) {
                $("#submitBtn").prop('disabled', true);
                $("#loadingText").show();
                form.submit();
            }
        });
    });
</script>
@endsection