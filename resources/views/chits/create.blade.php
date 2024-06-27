@extends('layouts.master')
@section('title', 'User Details')
<link href="{{asset('assets/js/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> -->
@section('content')
<link href="{{asset('assets/js/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title">
                        <h4 class="mb-0 font-size-18">Form Validation</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Agroxa</a></li>
                            <li class="breadcrumb-item active">Forms</a></li>
                        </ol>
                    </div>

                    <div class="state-information d-none d-sm-block">
                        <div class="state-graph">
                            <div id="header-chart-1" data-colors='["--bs-primary"]'></div>
                            <div class="info">Balance $ 2,317</div>
                        </div>
                        <div class="state-graph">
                            <div id="header-chart-2" data-colors='["--bs-warning"]'></div>
                            <div class="info">Item Sold 1230</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Start Page-content-Wrapper -->
        <div class="page-content-wrapper">
            <!-- end row -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Validation type</h4>
                            <p class="card-title-desc">Parsley is a javascript form validation library. It helps
                                you provide your users with feedback on their form submission before sending it
                                to your server.</p>

                            <form class="custom-validation" method="post" novalidate action="{{url('/storeChitCustomer')}}">
                                @csrf
                                @if($errors->any())
                                {!! implode('', $errors->all('<div style="color:red;">:message</div>')) !!}
                                @endif
                                <div class="mb-3 row">
                                    <label for="" class="col-md-2 col-form-label form-label ">Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="" name="name" placeholder="Name" required value="{{old('name')}}">
                                    </div>

                                </div>

                                <div class="mb-3 row">
                                    <label for="email" class="col-md-2 col-form-label">Email</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="email" id="email" placeholder="Email" name="email" required value="{{old('email')}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="mobile" class="col-md-2 col-form-label">Mobile</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="tel" id="mobile" name="mobile" placeholder="Mobile" data-parsley-type="digits" maxlength="10" required value="{{old('mobile')}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="kycNumber" class="col-md-2 col-form-label">KYC Number</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="tel" data-parsley-type="digits" maxlength="12" minlength="12" id="kycNumber" name="kycNumber" placeholder="KYC Number" value="{{old('kycNumber')}}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="salary" class="col-md-2 col-form-label">Salary</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="tel" id="salary" name="salary" placeholder="Salary" value="{{old('salary')}}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row" id="planDiv" style="display: none">
                                    <label class="col-md-2 col-form-label">Chit Plan</label>
                                    <div class="col-md-10" style="display:flex;flex-direction:column-reverse">
                                        <select class=" form-control select2" id="chitPlan" name="chitPlan[]" multiple data-placeholder="Select Plan">
                                            @foreach($chitsPlans as $chitPlan) {

                                            <option value="{{$chitPlan['_id']}}">{{$chitPlan['chitName']}}</option>
                                            }
                                            @endforeach
                                        </select>
                                        <div style="color: #a46902;font-weight: 500; display:none" id="planErr">Sorry :( This Plan has Enough members. Please Select other plans.</div>
                                    </div>
                                </div>
                                <div class="mb-3 row ">
                                    <label class="col-md-2 col-form-label">Chit Image</label>
                                    <div class="col-md-10 dropzone" id="myDropzone">
                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-muted mdi mdi-upload-network-outline"></i>
                                            </div>

                                            <h4>Upload an Chit Image</h4>
                                        </div>
                                    </div>
                                    <input type="hidden" name="image" id="image">
                                </div>

                                <div class="mb-3 row ">
                                    <label class="col-md-2 col-form-label">Gallery Images</label>
                                    <div class="col-md-10 dropzone" id="galleryImage">
                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-muted mdi mdi-upload-network-outline"></i>
                                            </div>

                                            <h4>Upload an Gallery Images</h4>
                                        </div>
                                    </div>
                                    <input type="hidden" name="gallery" id="gallery">
                                </div>
                        </div>
                        <div class="mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    Cancel
                                </button>
                            </div>
                        </div>

                        </form>
                        <!-- End Form -->
                    </div>
                    <!-- End Cardbody -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->

    </div>
    <!-- End Page-content -->

</div>
<!-- container-fluid -->
</div>
@section('script')
<script src="{{asset('assets/js/libs/parsleyjs/parsley.min.js')}}"></script>
<script src="{{asset('assets/js/form-validation.init.js')}}"></script>
<script src="{{asset('assets/js/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('assets/js/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('assets/js/form-advanced.init.js')}}"></script>
<script src="{{asset('assets/js/libs/dropzone/min/dropzone.min.js')}}"></script>
<!-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> -->
<script>
    Dropzone.autoDiscover = false;
    let imagePath = document.getElementById('image')
    $("#myDropzone").dropzone({
        url: "{{ url('imageUpload') }}",
        paramName: "file",
        addRemoveLinks: true,
        dictRemoveFile: 'Remove',
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        maxFiles: 1,
        maxFilesize: 2, // MB
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        params: {
            'type': 'image'
            // 'uniqueId': file.upload.uuid
        },
        removedfile: function(file) {
            let name = file.name
            $.ajax({
                type: 'POST',
                url: "{{ url('imageRemove') }}",
                data: {
                    name: imagePath.value,
                    type: 'image',
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.message === "success") {
                        imagePath.value = '';
                        file.previewElement.remove();
                    } else {
                        console.log(response)
                    }
                },
            });
        },
        init: function() {
            this.on("addedfile", function() {
                if (this.files[1] != null) {
                    this.removeFile(this.files[0]);
                }
            });
            this.on("sending", function(file, xhr, formData) {
                formData.append("uniqueId", file.upload.uuid);
                console.log(formData);
            });
        },
        success: function(file, response) {
            console.log("uploaded", file.upload.uuid);
            imagePath.value = response.path;
        }

    });

    let galleryImage = document.getElementById("gallery");
    let images = [];
    $("#galleryImage").dropzone({
        url: "{{ url('imageUpload') }}",
        addRemoveLinks: true,
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        maxFilesize: 2, // MB
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        params: {
            'type': 'gallery'
        },
        removedfile: function(file) {
            let name = file.name
            let getUid = file.upload.uuid;
            let splitImg = galleryImage.value.split(",");
            let getName = ''
            for (let i in splitImg) {
                let splitUnderScore = splitImg[i].split("_")
                let matchFound = false
                if (splitUnderScore[0] == getUid) {
                    getName = splitImg[i];
                    matchFound = true
                }
                if (matchFound) {
                    let imageArrInd = images.indexOf(splitImg[i]);
                    images.splice(imageArrInd, 1)
                    console.log(images)
                    galleryImage.value = images.toString()
                    matchFound = false
                }
            }
            $.ajax({
                type: 'POST',
                url: "{{ url('imageRemove') }}",
                data: {
                    name: getName,
                    type: 'gallery',
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.message === "success") {
                        file.previewElement.remove();
                    } else {
                        console.log(response)
                    }
                },
            });
        },
        init: function() {
            this.on("sending", function(file, xhr, formData) {
                formData.append("uniqueId", file.upload.uuid);
            })
        },
        success: function(file, response) {
            images.push(response.path);
            let allImg = images.toString();
            galleryImage.value = allImg;
            console.log("success",images)
        }
    });

    let salary = document.getElementById('salary');
    salary.addEventListener('change', (e) => {
        if (e.target.value < 30000) {
            document.getElementById('planDiv').style.display = 'none';
            let reqSelect = document.getElementById("chitPlan");
            reqSelect.removeAttribute("required", "")
            $('#chitPlan').val(null).trigger('change');
        } else {
            document.getElementById('planDiv').style.display = '';
            let reqSelect = document.getElementById("chitPlan");
            reqSelect.setAttribute("required", "")
        }
    });

    $('#chitPlan').on('select2:select', function(e) {
        let selectedId = e.params.data.id;
        $.ajax({
            url: '/checkMember',
            type: 'POST',
            data: {
                selectedId: selectedId,
                "_token": "{{ csrf_token() }}"
            },
            dataType: 'JSON',
            success: function(response) {
                if (response.message === 'eligible') {
                    document.getElementById('planErr').style.display = 'none';
                } else {
                    document.getElementById('planErr').style.display = '';
                    setTimeout(function() {
                        $('#chitPlan').find("option[value='" + selectedId + "']").prop('selected', false);
                        $('#chitPlan').find("option[value='" + selectedId + "']").attr('disabled', "");
                        $('#chitPlan').trigger('change');
                        document.getElementById('planErr').style.display = 'none';
                    }, 3000);
                }
            },
            error: function(response) {}
        });
    });
</script>
@endsection
@endsection