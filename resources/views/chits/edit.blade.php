@extends('layouts.master')
@section('title', 'User Details')
@section('content')
<link href="{{asset('assets/js/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
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

                            <form class="custom-validation" method="post" novalidate action="{{url('/saveAnsOrder/' . $data['customerDetails']->_id)}}">
                                @csrf
                                @if($errors->any())
                                {!! implode('', $errors->all('<div style="color:red;">:message</div>')) !!}
                                @endif
                                <div class="mb-3 row">
                                    <label for="" class="col-md-2 col-form-label form-label ">Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="" name="name" placeholder="Name" required value="{{$data['customerDetails']->name}}">
                                    </div>

                                </div>

                                <div class="mb-3 row">
                                    <label for="email" class="col-md-2 col-form-label">Email</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="email" id="email" placeholder="Email" name="email" required value="{{$data['customerDetails']->email}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="mobile" class="col-md-2 col-form-label">Mobile</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="tel" id="mobile" name="mobile" placeholder="Mobile" data-parsley-type="digits" maxlength="10" required value="{{$data['customerDetails']->mobile}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="kycNumber" class="col-md-2 col-form-label">KYC Number</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="tel" data-parsley-type="digits" maxlength="12" minlength="12" id="kycNumber" name="kycNumber" placeholder="KYC Number" value="{{$data['customerDetails']->kycNumber}}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="salary" class="col-md-2 col-form-label">Salary</label>
                                    <div class="col-md-10" id="salaryDiv">
                                        <input class="form-control" type="tel" id="salary" name="salary" placeholder="Salary" value="{{$data['customerDetails']->salary}}" required>
                                        <div style="color: red; display:none" id="salErr">Salary must be greater than or equal to your previous Salary</div>
                                    </div>
                                </div>
                                <?php
                                $style = "";
                                $required = "required";
                                if ($data['customerDetails']->salary < 30000) {
                                    $style = "display:none";
                                    $required = "";
                                }
                                ?>
                                <div class="mb-3 row" id="planDiv" style="{{ $style }}">
                                    <label class="col-md-2 col-form-label">Chit Plan</label>
                                    <div class="col-md-10" style="display:flex;flex-direction:column-reverse">
                                        <select class="form-select select2" id="chitPlan" name="chitPlan[]" multiple data-placeholder="Select Plan" {{ $required }}>
                                            @php
                                            $selectedPlans = $data['customerDetails']->chits ? $data['customerDetails']->chits : [];
                                            @endphp
                                            @foreach($data['allChits'] as $chits) {
                                            <option value="{{$chits->_id}}" {{in_array($chits->_id, $selectedPlans) ? 'selected' : '' }}>{{$chits->chitName}}</option>
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
                                    <input type="hidden" name="image" id="image" value="{{$data['customerDetails']->chitImage}}">
                                </div>
                                <!-- <img class="" src="{{ Storage::url('image/c13d9467-e6e8-4e0a-ad4c-d92249e851db_IMG-20230425-WA0010.jpg') }}" alt=""> -->
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
                                    <input type="hidden" name="gallery" id="gallery" value="{{$data['customerDetails']->galleryImages}}">
                                    <input type="hidden" value="{{asset('storage/gallery')}}" name="existingGallery" id="existingGallery">
                                </div>
                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1" id="submit">
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
<script>
    Dropzone.autoDiscover = false;
    let imagePath = document.getElementById('image')
    // imagePath.value = response.path;
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
        },
        removedfile: function(file) {
            imagePath.value = '';
            file.previewElement.remove();
        },
        init: function() {
            let existingImageName = "<?php echo $data['customerDetails']->chitImage; ?>"
            if (existingImageName) {
                let existingImagePath = "<?php echo asset('storage/image/' . $data['customerDetails']->chitImage); ?>"
                myDropzone = this
                var file = {
                    name: existingImageName,
                    size: 12345,
                    status: Dropzone.ADDED,
                    accepted: true
                };
                myDropzone.emit("addedfile", file);
                myDropzone.emit("thumbnail", file, existingImagePath);
                myDropzone.emit("complete", file);
                myDropzone.files.push(file);
            }
            this.on("addedfile", function() {
                if (this.files[1] != null) {
                    this.removeFile(this.files[0]);
                }
            });
            this.on("sending", function(file, xhr, formData) {
                formData.append("uniqueId", file.upload.uuid);
            });
        },
        success: function(file, response) {
            console.log("uploaded");
            imagePath.value = response.path;
        }

    });
    let galleryImage = document.getElementById("gallery");
    let imgPush = galleryImage.value.split(",");
    let images = [];
    if (imgPush != 0) {
        for (let i = 0; i < imgPush.length; i++) {
            images.push(imgPush[i]);
        }
    }
    console.log(images);
    $("#galleryImage").dropzone({
        url: "{{ url('imageUpload') }}",
        addRemoveLinks: true,
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        maxFilesize: 2, // MB
        // maxFiles: 4,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        params: {
            'type': 'gallery'
        },
        removedfile: function(file) {
            let name = file.name
            if (typeof file.upload !== 'undefined') {
                let changeVal = galleryImage.value.split(',')
                const index = changeVal.indexOf(file.upload.uuid + '_' + name);
                changeVal.splice(index, 1)
                galleryImage.value = changeVal.join(",")
                let imgArrInd = images.indexOf(file.upload.uuid + '_' + name)
                images.splice(imgArrInd, 1)
            } else {
                let removeAlready = galleryImage.value.split(',');
                let getInd = removeAlready.indexOf(name);
                removeAlready.splice(getInd, 1)
                galleryImage.value = removeAlready.join(",")
                let imgArrInd = images.indexOf(name)
                images.splice(imgArrInd, 1)
            }
            file.previewElement.remove();
        },
        init: function() {
            let existingGallery = "<?php echo $data['customerDetails']->galleryImages; ?>";
            if (existingGallery) {
                galleryImage.value = existingGallery;
                existingGallery = existingGallery.split(',');
                for (let i = 0; i < existingGallery.length; i++) {
                    let existingGalleryPath = $('#existingGallery').val() + '/' + existingGallery[i];
                    myDropzone = this
                    var file = {
                        name: existingGallery[i],
                        size: 12345,
                        status: Dropzone.ADDED,
                        accepted: true
                    };
                    myDropzone.emit("addedfile", file);
                    myDropzone.emit("thumbnail", file, existingGalleryPath);
                    myDropzone.emit("complete", file);
                    myDropzone.files.push(file);
                }

            }
            this.on("sending", function(file, xhr, formData) {
                formData.append("uniqueId", file.upload.uuid);
            })
        },
        success: function(file, response) {
            images.push(response.path);
            let allImg = images.join(',');
            console.log("images-->", images);
            galleryImage.value = allImg;
        }
    });
    let salary = document.getElementById('salary');
    let initialSalary = salary.value;
    let salErr = document.getElementById('salErr');
    let check = 0;
    if (document.getElementById('chitPlan').value != "") {
        check = 1;
    }
    salary.addEventListener('change', (e) => {
        if (parseInt(e.target.value) < parseInt(initialSalary)) {
            salErr.style.display = ''
            submit.setAttribute("disabled", "")
            togglePlanVisibility(false);
        } else if (parseInt(e.target.value) >= 30000) {
            salErr.style.display = 'none'
            submit.removeAttribute("disabled")
            togglePlanVisibility(true);
            let reqSelect = document.getElementById("chitPlan");
            reqSelect.setAttribute("required", "")
        } else if (parseInt(e.target.value) == parseInt(initialSalary)) {
            salErr.style.display = 'none'
            togglePlanVisibility(false);
            submit.removeAttribute("disabled")
            let reqSelect = document.getElementById("chitPlan");
            reqSelect.removeAttribute("required")
        }

    });

    function togglePlanVisibility(isVisible) {

        if (check == 0) {
            $('#chitPlan').val(null).trigger('change');
            document.getElementById('planDiv').style.display = isVisible ? '' : 'none';
        }
    }

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