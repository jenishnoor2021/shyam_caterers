@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Menu Item Category Import</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('admin.category.import-store') }}" name="categoryImport" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div data-repeater-list="group-a">
                        <div data-repeater-item class="row">
                            <div class="mb-3 col-lg-3">
                                <label for="file">File</label>
                                <input type="file" name="file" class="form-control" id="file" accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                @if ($errors->has('file'))
                                <div class="error text-danger">{{ $errors->first('file') }}</div>
                                @endif
                            </div>

                            <div class="col-lg-1 align-self-center">
                                <div class="d-flex gap-2">
                                    <input type="submit" class="btn btn-success mt-3 mt-lg-0" id="submitBtn" value="Submit" />
                                    <span id="loadingText" style="display:none; margin-left:10px;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
                                    <a class="btn btn-light mt-3 mt-lg-0" href="{{ URL::to('/admin/category') }}">Back</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@section('script')
<script>
    $(function() {

        $("form[name='categoryImport']").validate({
            rules: {
                file: {
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