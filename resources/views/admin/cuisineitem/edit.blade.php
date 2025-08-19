@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Edit Cuisine Item</h4>
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

                {!! Form::model($item, [
                'method' => 'PATCH',
                'action' => ['AdminCuisineItemsController@update', $item->id],
                'files' => true,
                'class' => 'form-horizontal',
                'name' => 'editcuisineitemform',
                ]) !!}
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="cuisine_category_id">Cuisine Categpory<span class="text-danger">*</span></label>
                            <select name="cuisine_category_id" id="cuisine_category_id" class="form-control" style="width:100%" required>
                                <option value="">Select category</option>
                                @foreach($category as $cate)
                                <option value="{{$cate->id}}" {{ $item->cuisine_category_id == $cate->id ? 'selected' : '' }}>{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cuisine_category_id'))
                            <div class="error text-danger">{{ $errors->first('cuisine_category_id') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="item_name">Item Name<span class="text-danger">*</span></label>
                            <input type="text" name="item_name" class="form-control text-uppercase" id="item_name" placeholder="Enter name" value="{{ $item->item_name }}" required>
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
                            <input type="file" name="file" class="form-control" id="file" accept="image/*">
                            <img src="{{$item->file}}" alt="{{$item->file}}" width="50px" hight="50px" loading="lazy">
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
                            <input type="number" name="priority" class="form-control" id="priority" placeholder="Enter priority" value="{{ $item->priority }}" required>
                            @if($errors->has('priority'))
                            <div class="error text-danger">{{ $errors->first('priority') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="is_active">Show<span class="text-danger">*</span></label>
                            <select name="is_active" id="is_active" class="form-control" style="width:100%" required>
                                <option value="1" {{ $item->is_active == '1' ? 'selected' : '' }}>Show</option>
                                <option value="0" {{ $item->is_active == '0' ? 'selected' : '' }}>Hide</option>
                            </select>
                            @if($errors->has('is_active'))
                            <div class="error text-danger">{{ $errors->first('is_active') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-1 align-self-center">
                    <div class="d-flex gap-2">
                        <input type="submit" class="btn btn-primary w-md" id="submitBtn" value="Update" />
                        <span id="loadingText" style="display:none; margin-left:10px;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
                        <a class="btn btn-light mt-3 mt-lg-0" href="{{ URL::to('/admin/cuisine_items') }}">Back</a>
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

        $("form[name='editcuisineitemform']").validate({
            rules: {
                categories_id: {
                    required: true,
                },
                item_name: {
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