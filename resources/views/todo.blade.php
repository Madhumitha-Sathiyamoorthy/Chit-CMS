@extends('layouts.master')
@section('title','Learn Rodo')
<style>

</style>
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title">
                        <h4 class="mb-0 font-size-18">Dashboard</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Welcome to Dashboard {{Auth::user()->name}}</li>
                        </ol>
                    </div>
                    <div class="state-information d-none d-sm-block">
                        <div class="    state-graph">
                            <div id="header-chart-1" data-colors='["--bs-primary"]'></div>
                            <div class="info">Balance $ 2,317</div>
                        </div>
                        <div class="state-graph">
                            <div id="header-chart-2" data-colors='["--bs-danger"]'></div>
                            <div class="info">Item Sold 1230</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="page-content-wrapper">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Bar Chart</h4>
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <h5 class="mb-0 " id="totalCustomers">2541</h5>
                                            <p class="text-muted text-truncate">Total Cusotmers</p>
                                        </div>
                                        <div class="col-4">
                                            <h5 class="mb-0" id="aucBidders">84845</h5>
                                            <p class="text-muted text-truncate">Aunction Bidders</p>
                                        </div>
                                        <div class="col-4">
                                            <h5 class="mb-0" id="remCustomers">12001</h5>
                                            <p class="text-muted text-truncate">Remaining Customers</p>
                                        </div>
                                    </div>
                                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
</script>
@endsection
@endsection