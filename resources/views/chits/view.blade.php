@extends('layouts.master')
@section('title', 'View Customer')
@section('content')
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
            <div class="col-lg-4">
                <div class="card bg-success text-white-50">
                    <div class="card-body">
                        <h5 class="mb-4 text-white"><i class="mdi mdi-check-all me-3"></i> {{$customer->name}}
                        </h5>
                        <!-- <ul class="list-group list-group-flush"> -->
                            <li class="card-title text-black list-group-item">{{$customer->email}}</li>
                            <hr>
                            <li class="card-title text-black list-group-item">{{$customer->mobile}}</li>
                        <!-- </ul> -->
                    </div>
                    <!-- End Cardbody -->
                </div>
                <!-- End Card -->
            </div>
            <!-- End Row -->

        </div>
        <!-- End Page-content -->

    </div>
    <!-- container-fluid -->
</div>
@section('script')
@endsection
@endsection