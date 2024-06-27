@extends('layouts.master')
@section('title', 'User Details')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title">
                        <h4 class="mb-0 font-size-18">Cards</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Agroxa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UI Elements</a></li>
                            <li class="breadcrumb-item active">Cards</li>
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
                <div>
                    @if($errors->any())
                        {!! implode('', $errors->all('<div style="color:red;">:message</div>')) !!}
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-2 mt-5">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h6 class="text-white">Create Chit Blog Post</h6>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="{{url('storeChitBlog')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label><strong>Description :</strong></label>
                                                <textarea id="elm1" name="area"></textarea>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    @section('script')
    <!--tinymce js-->
    <script src="{{asset('assets/js/libs/tinymce/tinymce.min.js')}}"></script>

    <!-- init js -->
    <script src="{{asset('assets/js/form-editor.init.js')}}"></script>
    @endsection
    @endsection