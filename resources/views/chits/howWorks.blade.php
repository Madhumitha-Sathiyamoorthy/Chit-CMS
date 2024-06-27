@extends('layouts.master')
@section('title', 'View Customer')
@section('content')
<link rel="stylesheet" href="{{asset('assets/js/libs/sweetalert2/sweetalert2.min.css')}}">
</script>
<style>
    textarea.form-control {
        margin-bottom: 5% ! important;
    }

    .close {
        cursor: pointer;
        position: absolute;
        /* left: 47%; */
        right: 0%;
        transform: translate(0%, -50%);
        border-radius: 50px;
    }
</style>

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
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Answer the Queries</h2>
                            <p class="card-title-desc">Any questions about our chits? Check out the section for comprehensive answers and support. We post multiple answers for common questions to give you a broader perspective</p>

                            <form class="custom-validation" method="post" novalidate action="{{url('/storeChitAns')}}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label"> What is a Chit or a Chit Fund?</label>
                                    <div class="chitAns">
                                        <textarea required class="form-control textAreas" id="ans-1" rows="3" name="textArea[]"></textarea>
                                        <!-- <hr> -->
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-outline-info waves-effect waves-light me-1">
                                            Post Answers
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- End Row -->
                        </div>
                        <!-- End Page-content -->

                    </div>
                    <!-- container-fluid -->
                </div>
            </div>
            @section('script')
            <script src="{{asset('assets/js/libs/sweetalert2/sweetalert2.min.js')}}"></script>
            <script src="{{asset('assets/js/sweet-alerts.init.js')}}"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let count = 1;
                    const chitAnsArea = document.querySelector('.chitAns');
                    chitAnsArea.addEventListener('keydown', function(e) {
                        let gettextArea = document.querySelectorAll('.textAreas');
                        let emptyCnt = 0;
                        let emptyIndex = []
                        for (let i = 0; i < gettextArea.length; i++) {
                            if (!gettextArea[i].value) {
                                emptyCnt++
                            }
                        }
                        if (e.key === "Enter") {
                            e.preventDefault();
                            if (gettextArea[gettextArea.length - 1].value && emptyCnt < 1) {
                                let inputField = document.createElement('textarea');
                                let spanField = document.createElement('button');
                                spanField.classList.add('btn', 'btn-danger', 'waves-effect', 'waves-light', 'close')
                                spanField.textContent = 'X';
                                inputField.setAttribute('rows', 3);
                                inputField.classList.add('form-control');
                                inputField.classList.add('textAreas');
                                inputField.setAttribute('required', '');
                                inputField.setAttribute('name', 'textArea[]');
                                chitAnsArea.appendChild(spanField);
                                chitAnsArea.appendChild(inputField);
                                spanField.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    inputField.remove();
                                    spanField.remove();
                                });
                                inputField.focus();
                                count++
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Empty Value",
                                    confirmButtonText: "Done",
                                });
                            }
                        }
                    })
                });
            </script>
            @endsection
            @endsection