@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Edit Profile</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit</h4>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::model($profile, [
                'method' => 'PATCH',
                'action' => ['AdminProfileController@update', $profile->id],
                'files' => true,
                'class' => 'form-horizontal',
                'name' => 'editprofileform',
                ]) !!}
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Enter Name" value="{{ $profile->name }}" required>
                            @if ($errors->has('name'))
                            <div class="error text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="slug">Slug<span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="Enter slug" value="{{ $profile->slug }}" required readonly>
                            @if($errors->has('slug'))
                            <div class="error text-danger">{{ $errors->first('slug') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="contact">Contact<span class="text-danger">*</span></label>
                            <input type="number" name="contact" class="form-control" id="contact" placeholder="Enter contact No" value="{{ $profile->contact }}" required pattern="[0-9]{10}" maxlength="10">
                            @if($errors->has('contact'))
                            <div class="error text-danger">{{ $errors->first('contact') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image">Profile Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control" accept="image/*" id="image">
                            <img src="{{ $profile->image }}" alt="Your image" width="50px" hight="50px" loading="lazy">
                            @if($errors->has('image'))
                            <div class="error text-danger">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="file">Image<span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control" accept="image/*" id="file">
                            <img src="{{ $profile->file }}" alt="Your Logo" width="50px" hight="50px" loading="lazy">
                            @if($errors->has('file'))
                            <div class="error text-danger">{{ $errors->first('file') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="whatsapp_no">Whatsapp No<span class="text-danger">*</span></label>
                            <input type="number" name="whatsapp_no" class="form-control" id="whatsapp_no" placeholder="Enter whatsapp No" value="{{ $profile->whatsapp_no }}" required pattern="[0-9]{10}" maxlength="10">
                            @if($errors->has('whatsapp_no'))
                            <div class="error text-danger">{{ $errors->first('whatsapp_no') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                    <textarea type="text" name="address" class="form-control" id="address" placeholder="Enter Address">{{ $profile->address }}</textarea>
                    @if ($errors->has('address'))
                    <div class="error text-danger">{{ $errors->first('address') }}</div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="facebook">Facebook Link<span class="text-danger">*</span></label>
                            <input type="text" name="facebook" class="form-control" id="facebook" placeholder="Enter facebook link" value="{{ $profile->facebook }}" required>
                            @if($errors->has('facebook'))
                            <div class="error text-danger">{{ $errors->first('facebook') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="instagram">Instagram Link<span class="text-danger">*</span></label>
                            <input type="text" name="instagram" class="form-control" id="instagram" placeholder="Enter instagram link" value="{{ $profile->instagram }}" required>
                            @if($errors->has('instagram'))
                            <div class="error text-danger">{{ $errors->first('instagram') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="twitter">Twitter Link<span class="text-danger">*</span></label>
                            <input type="text" name="twitter" class="form-control" id="twitter" placeholder="Enter twitter link" value="{{ $profile->twitter }}" required>
                            @if($errors->has('twitter'))
                            <div class="error text-danger">{{ $errors->first('twitter') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="linkdin">Linkdin Link<span class="text-danger">*</span></label>
                            <input type="text" name="linkdin" class="form-control" id="linkdin" placeholder="Enter linkdin link" value="{{ $profile->linkdin }}" required>
                            @if($errors->has('linkdin'))
                            <div class="error text-danger">{{ $errors->first('linkdin') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="youtube">Youtube<span class="text-danger">*</span></label>
                            <input type="text" name="youtube" class="form-control" id="youtube" placeholder="Enter youtube link" value="{{ $profile->youtube }}" required>
                            @if($errors->has('youtube'))
                            <div class="error text-danger">{{ $errors->first('youtube') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="map">Map<span class="text-danger">*</span></label>
                            <input type="text" name="map" class="form-control" id="map" placeholder="Enter map" value="{{ $profile->map }}" required>
                            @if($errors->has('map'))
                            <div class="error text-danger">{{ $errors->first('map') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="website">Website<span class="text-danger">*</span></label>
                            <input type="text" name="website" class="form-control" id="website" placeholder="Enter website link" value="{{ $profile->website }}" required>
                            @if($errors->has('website'))
                            <div class="error text-danger">{{ $errors->first('website') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ $profile->email }}" required>
                            @if($errors->has('email'))
                            <div class="error text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-1 align-self-center">
                    <div class="d-flex gap-2">
                        <input type="submit" class="btn btn-primary w-md" id="submitBtn" value="Submit" />
                        <span id="loadingText" style="display:none; margin-left:10px;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
                        <a class="btn btn-light mt-3 mt-lg-0" href="{{ URL::to('/admin/profile') }}">Back</a>
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

        $("form[name='editprofileform']").validate({
            rules: {
                name: {
                    required: true,
                },
                map: {
                    required: true,
                },
                youtube: {
                    required: true,
                },
                email: {
                    required: true,
                },
                contact: {
                    required: true,
                },
                address: {
                    required: true,
                },
                // image: {
                //     required: true,
                // },
                // file: {
                //     required: true,
                // },
                website: {
                    required: true,
                },
                facebook: {
                    required: true,
                },
                instagram: {
                    required: true,
                },
                twitter: {
                    required: true,
                },
                linkdin: {
                    required: true,
                },
                slug: {
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
    document.getElementById("slug").addEventListener("input", function() {
        let value = this.value;
        value = value.toLowerCase()
            .replace(/\s+/g, '-') // replace spaces with -
            .replace(/[^a-z0-9\-]/g, '');
        this.value = value;
    });
</script>
<script>
    document.querySelectorAll("#contact, #whatsapp_no").forEach(function(input) {
        input.addEventListener("input", function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
        });
    });
</script>
@endsection