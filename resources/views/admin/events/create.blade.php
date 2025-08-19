@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">ADD Event</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">ADD</h4>

                @if (session()->has('success'))
                <div class="alert text-white" style="background-color:#7EDD72">
                    {{ session()->get('success') }}
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

                {!! Form::open([
                'method' => 'POST',
                'action' => 'AdminEventsController@store',
                'files' => true,
                'class' => 'form-horizontal',
                'name' => 'addeventsform',
                ]) !!}
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="event_type">Event Type<span class="text-danger">*</span></label>
                            <input type="text" name="event_type" class="form-control text-uppercase" id="event_type" placeholder="Enter event type" value="{{ old('event_type') }}" required>
                            @if ($errors->has('event_type'))
                            <div class="error text-danger">{{ $errors->first('event_type') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="poster">Background Image<span class="text-danger">*</span></label>
                            <input type="file" name="poster" class="form-control" id="poster" accept="image/*" required>
                            @if($errors->has('poster'))
                            <div class="error text-danger">{{ $errors->first('poster') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="file">Image<span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control" id="file" accept="image/*" required>
                            @if($errors->has('file'))
                            <div class="error text-danger">{{ $errors->first('file') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="detail" class="form-label">Small Content<span class="text-danger">*</span></label>
                            <textarea type="text" name="detail" class="form-control" id="detail" placeholder="Enter content" required>{{ old('detail') }}</textarea>
                            @if ($errors->has('detail'))
                            <div class="error text-danger">{{ $errors->first('detail') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="is_active">Show<span class="text-danger">*</span></label>
                            <select name="is_active" id="is_active" class="form-control" style="width:100%" required>
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                            @if($errors->has('is_active'))
                            <div class="error text-danger">{{ $errors->first('is_active') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-1 align-self-center">
                    <div class="d-flex gap-2">
                        <input type="submit" class="btn btn-primary w-md" id="submitBtn" value="Submit" />
                        <span id="loadingText" style="display:none; margin-left:10px;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
                        <a class="btn btn-light mt-3 mt-lg-0" href="{{ URL::to('/admin/events') }}">Back</a>
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

        $("form[name='addeventsform']").validate({
            rules: {
                event_type: {
                    required: true,
                },
                file: {
                    required: true,
                },
                poster: {
                    required: true,
                },
                detail: {
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
@endsection