@extends('layouts.master')
@section('title','Dashboard')
<style>
    /* @media only screen and (min-width: 1200px) {
        .page-content {
            padding: unset !important;
        }
    } */
</style>
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
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
                        <div class="state-graph">
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
        <!-- end page title -->

        <!-- Start page content-wrapper -->
        <div class="page-content-wrapper">
            <div class="container-fluid">

                <!-- start page title -->

                <!-- end page title -->

                <!-- Start Page-content-Wrapper -->
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
                                <!-- End Cardbody-->
                            </div>
                            <!-- End Card-->
                        </div>
                        <!-- end Col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid -->
</div>
@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/getChartData',
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                if (response.code == 200) {
                    $('#remCustomers').text(response.data.remaining);
                    $('#aucBidders').text(response.data.auctionSpin);
                    $('#totalCustomers').text(response.data.totalCustomers);
                    // console.log(response.data.chitNames)
                    const ctx = document.getElementById('myChart');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(response.data.chitNames),
                            datasets: [{
                                label: 'Customers Per Chit',
                                data: Object.values(response.data.chitNames),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return value.toFixed(0);
                                        }
                                    }
                                },
                            },
                        }
                    });
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    })
</script>
@endsection
@endsection