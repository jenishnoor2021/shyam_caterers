@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">New Menu Item</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
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
                'action' => 'AdminMenuItemController@store',
                'files' => true,
                'class' => 'form-horizontal',
                'name' => 'additemform',
                ]) !!}
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="categories_id">Menu Category<span class="text-danger">*</span></label>
                            <select name="categories_id" id="category" class="form-control" style="width:100%" required>
                                <option value="">Select category</option>
                                @foreach($category as $cate)
                                <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('categories_id'))
                            <div class="error text-danger">{{ $errors->first('categories_id') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="item_name">Item Name<span class="text-danger">*</span></label>
                            <input type="text" name="item_name" class="form-control text-uppercase" id="item_name" placeholder="Enter name" value="{{ old('item_name') }}" required>
                            @if ($errors->has('item_name'))
                            <div class="error text-danger">{{ $errors->first('item_name') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="priority">Priority<span class="text-danger">*</span></label>
                            <input type="number" name="priority" class="form-control" id="priority" placeholder="Enter priority" value="{{ old('priority') }}" required>
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
                        <a class="btn btn-light mt-3 mt-lg-0" href="{{ URL::to('/admin/menu-item') }}">Back</a>
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

        $("form[name='additemform']").validate({
            rules: {
                categories_id: {
                    required: true,
                },
                item_name: {
                    required: true,
                },
                file: {
                    required: true,
                },
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