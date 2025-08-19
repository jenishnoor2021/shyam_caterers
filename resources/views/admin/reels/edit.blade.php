@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Edit Reel</h4>
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

                {!! Form::model($reel, [
                'method' => 'PATCH',
                'action' => ['AdminReelController@update', $reel->id],
                'files' => true,
                'class' => 'form-horizontal',
                'name' => 'editReelForm',
                ]) !!}
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="poster">Video Poster<span class="text-danger">*</span></label>
                            <input type="file" name="poster" class="form-control" id="poster"
                                placeholder="Enter poster" value="" accept="image/*" required>
                            <img src="{{ asset($reel->poster) }}" alt="img" width="100">
                            @if ($errors->has('poster'))
                            <div class="error text-danger">{{ $errors->first('poster') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="file">Video<span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control" id="file"
                                placeholder="Enter video" value="" accept="video/*" required>
                            <video width="100" controls>
                                <source src="{{ asset($reel->file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            @if ($errors->has('file'))
                            <div class="error text-danger">{{ $errors->first('file') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3">
                        <label for="priority">Priority<span class="text-danger">*</span></label>
                        <input type="number" name="priority" class="form-control" id="priority" placeholder="Enter priority" value="{{$reel->priority}}" required>
                        @if ($errors->has('priority'))
                        <div class="error text-danger">{{ $errors->first('priority') }}</div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-1 align-self-center">
                    <div class="d-flex gap-2">
                        <input type="submit" class="btn btn-primary w-md" id="submitBtn" value="Submit" />
                        <span id="loadingText" style="display:none; margin-left:10px;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
                        <a class="btn btn-light mt-3 mt-lg-0" href="{{ URL::to('/admin/reel') }}">Back</a>
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
        $("form[name='editReelForm']").validate({
            rules: {
                file: {
                    required: true,
                },
                poster: {
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