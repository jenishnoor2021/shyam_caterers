@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Edit Menu Item Category</h4>
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

                {!! Form::model($category, [
                'method' => 'PATCH',
                'action' => ['AdminCategoryController@update', $category->id],
                'files' => true,
                'class' => 'form-horizontal',
                'name' => 'editcategoryform',
                ]) !!}
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="category_name">Name<span class="text-danger">*</span></label>
                            <input type="text" name="category_name" class="form-control text-uppercase" id="category_name" placeholder="Enter name" value="{{ $category->category_name }}" required>
                            @if ($errors->has('category_name'))
                            <div class="error text-danger">{{ $errors->first('category_name') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="file">Image<span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control" id="file" accept="image/*">
                            <img src="{{$category->file}}" alt="{{$category->file}}" width="50px" hight="50px" loading="lazy">
                            @if($errors->has('file'))
                            <div class="error text-danger">{{ $errors->first('file') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="priority">Priority<span class="text-danger">*</span></label>
                            <input type="number" name="priority" class="form-control" id="priority" placeholder="Enter priority" value="{{ $category->priority }}" required>
                            @if($errors->has('priority'))
                            <div class="error text-danger">{{ $errors->first('priority') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="is_active">Show<span class="text-danger">*</span></label>
                            <select name="is_active" id="is_active" class="form-control" style="width:100%" required>
                                <option value="1" {{ $category->is_active == '1' ? 'selected' : '' }}>Show</option>
                                <option value="0" {{ $category->is_active == '0' ? 'selected' : '' }}>Hide</option>
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
                        <a class="btn btn-light w-md" href="{{ URL::to('/admin/category') }}">Back</a>
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

        $("form[name='editcategoryform']").validate({
            rules: {
                category_name: {
                    required: true,
                },
                // file: {
                //     required: true,
                // },
                priority: {
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