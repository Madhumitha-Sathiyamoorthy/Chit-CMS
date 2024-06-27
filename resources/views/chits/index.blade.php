@extends('layouts.master')
@section('title', 'User Details')
@section('content')
<style>
    .chitsearch {
        padding: unset !important;
    }

    .chitsearch .mdi-magnify {
        /* right:unset !important; */
        /* left:27% !important;    */
        color: black !important;
        font-size: 18px !important;
    }

    .chitsearch .form-control {
        border: 1px solid black !important;
        color: black !important;
        /* width: 30% !important; */
    }

    .chitsearch ::placeholder {
        /* Edge 12-18 */
        color: black !important;
    }

    .chit-search {
        display: flex;
        gap: 5%;
        padding: 10px;
    }

    .autocomplete {
        position: relative;
        display: inline-block;
    }

    .ulSearch {
        background-color: #fff;
        padding-left: 10px;
    }

    .ulSearch li {
        list-style: none;
        padding: 6px;
        border-bottom: 1px solid #e3e3e3;
        margin-right: 6px;
    }

    .ulSearch li a:hover {
        color: #1b82ec !important;
    }

    .ulSearch li a {
        color: #343434eb !important;
    }

    .autocomplete-items {
        position: absolute;
        /* border: 1px solid #d4d4d4; */
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    /* .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    } */

    /*when hovering an item:*/
    /* .autocomplete-items div:hover {
        background-color: #e9e9e9;
    } */

    /*when navigating through the items using the arrow keys:*/
    /* .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    } */
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="{{asset('assets/js/libs/ion-rangeslider/css/ion.rangeSlider.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title">
                        <h4 class="mb-0 font-size-18">Basic Tables</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard"></a></li>
                            <li class="breadcrumb-item active">Tables</a></li>
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
            <!-- @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif -->
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Chit Details</h4>
                            <p class="card-title-desc">
                                These are the details of Chits.
                            </p>
                            <div class="chit-search">
                                <div>
                                    <form class="app-search d-none d-lg-block chitsearch">
                                        <div class="position-relative">
                                            <input type="text" class="form-control border-0" id="search" placeholder="Search...">
                                            <span class="mdi mdi-magnify"></span>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <div class="dropdown mt-4 mt-sm-0">
                                        <a href="javascript:" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dropdown link <i class="mdi mdi-chevron-down"></i>
                                        </a>
                                        <div class="dropdown-menu" id="plans">
                                            @foreach($chitOptions as $chitOption)
                                            <a class="dropdown-item" value={{$chitOption['id']}} href="javascript:">{{$chitOption['chitName']}}</a>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                                <div style="width: 40%;">
                                    <h5 class="font-size-14">Min-Max</h5>
                                    <input type="text" class="js-range-slider" name="my_range">
                                </div>
                                <div>
                                    <button class="btn" onclick="downloadCall()"><i class="fa fa-download"></i> Download</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>KYC Number</th>
                                            <th>Salary</th>
                                            <th>Chits</th>
                                            @if(auth()->user()->role == 1)
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <input type="hidden" id="minSalary" value='{{$salary['min']}}'>
                                    <input type="hidden" id="maxSalary" value='{{$salary['max']}}'>
                                    <tbody id="chitBody">
                                        @foreach($chitsDetails as $key=>$data)
                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->mobile}}</td>
                                            <td>{{$data->kycNumber}}</td>
                                            <td id="salary">{{$data->salary}}</td>
                                            <td>{{$data->plans}}</td>
                                            @if(auth()->user()->role == 1)
                                            <td><a href="/editChitCustomer/{{$data->_id}}" class="btn btn-outline-secondary btn-sm edit"><i class="fas fa-pencil-alt"></i></a></td>
                                            <td><a href="/deleteChitCustomer/{{$data->_id}}" class="btn btn-outline-secondary btn-sm delete"><i class="fas fa-trash-alt"></i></a></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Col -->

            </div>
            <!-- End Row -->

        </div>
        <!-- End Page-content -->

    </div>
    <!-- Container-Fluid -->
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<!-- @section('script') 
    <script src="{{asset('assets/js/libs/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('assets/js/range-sliders.init.js')}}"></script>
    @endsection -->
<!-- Range slider init js-->
<script>
    let sliderValue = [];
    let minSalary = Number(document.getElementById('minSalary').value);
    let maxSalary = Number(document.getElementById('maxSalary').value);
    for (let i = minSalary; i <= maxSalary; i += 5000) {
        sliderValue.push(i);
    }
    if (sliderValue[sliderValue.length - 1] != maxSalary) sliderValue.push(maxSalary);
    console.log(sliderValue,minSalary,maxSalary)
    let rangeData = {};
    let searchData = {};
    let dropdownData = {};
    $(".js-range-slider").ionRangeSlider({
        type: "single",
        grid: true,
        values: sliderValue,
        onChange: function(data) {
            rangeData = {   
                fromAmount: minSalary,
                toAmount: data.from_value
            };
            ajaxCallFilter(searchData, dropdownData, rangeData);
        },
    });

    let editview = <?php echo auth()->user()->role ?>;
    $('#search').on('keyup', function(e) {
        let value = $(this).val();
        searchData = {
            search: value
        }
        ajaxCallFilter(searchData, dropdownData, rangeData);
    });

    let ajaxCallFilter = function(search, dropdown, range) {
        $.ajax({
            url: '/filterChitPlan',
            type: 'POST',
            data: {
                searchDat: search,
                dropdownDat: dropdown,
                rangeDat: range,
                "_token": "{{ csrf_token() }}"
            },
            dataType: 'JSON',
            success: function(response) {
                filterChits(response);
            },
            error: function(response) {}
        });
    }
    $('.dropdown-item').on('click', function(e) {
        dropdownData = {
            selectedChit: $(this).text(),
            chitId: this.getAttribute('value')
        };
        $('.dropdown-toggle').html($(this).text());
        ajaxCallFilter(searchData, dropdownData, rangeData);
    })

    const downloadCall = function() {
        $.ajax({
            url: '/download',
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
            },
            error: function(response) {}
        });
    }

    function filterChits(response) {

        if (response.status === 200) {
            let htmlView = ''
            let editHtml = ''
            $("#chitBody").empty();
            if (response.searchResult.length > 0) {
                for (let i = 0; i < response.searchResult.length; i++) {
                    if (editview === 1) {
                        editHtml =
                            `<td><a  href = "/editChitCustomer/${response.searchResult[i]['_id']}"class="btn btn-outline-secondary btn-sm edit"><i class="fas fa-pencil-alt"></i></a></td>
                            <td><a href = "/deleteChitCustomer/${response.searchResult[i]['_id']}"class="btn btn-outline-secondary btn-sm delete"><i class="fas fa-trash-alt"></i></a></td>`
                    }
                    htmlView +=
                        `<tr>
                                <td>${i+1}</td>
                                <td>${response.searchResult[i]['name']}</td>
                                <td>${response.searchResult[i]['email']}</td>
                                <td>${response.searchResult[i]['mobile']}</td>
                                <td>${response.searchResult[i]['kycNumber']}</td>
                                <td>${response.searchResult[i]['salary']}</td>
                                <td>${response.searchResult[i]['plans']}</td>
                                ${editHtml}
                            </tr>`;
                }
            } else {
                htmlView +=
                    `<tr>
                        <td colspan="4">No Results Found :(</td>
                    </tr>`;
            }
            $('#chitBody').html(htmlView);
        }
    }
    let searchEle = document.getElementById("searchList");
    a = document.createElement("DIV");
    a.setAttribute("id", searchEle.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    searchEle.addEventListener("input", function(e) {
        let val = this.value
        a.innerHTML = '';
        $.ajax({
            url: '/searchList',
            type: 'POST',
            data: {
                val,
                "_token": "{{ csrf_token() }}"
            },
            dataType: 'JSON',
            success: function(response) {
                if (response.message === 'success') {

                    searchEle.parentNode.appendChild(a);
                    let ul = document.createElement('ul');
                    ul.classList.add('ulSearch');
                    for (let i = 0; i < response.data.length; i++) {
                        var li = document.createElement("li")
                        var link = document.createElement("a")
                        link.href = 'http://lara-project.dv/viewChitCustomer/' + response.data[i]._id
                        link.target = "_blank"
                        let highlightName = response.data[i].name.replace(new RegExp(val, 'gi'), `<strong>$&</strong>`)
                        link.innerHTML = highlightName
                        li.appendChild(link);
                        ul.appendChild(li);
                    }
                    a.appendChild(ul);
                }

            },
            error: function(response) {}
        });
    })
</script>
@endsection