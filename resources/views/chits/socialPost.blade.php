@extends('layouts.master')
@section('title', 'Social Post')
<link href="{{asset('assets/js/libs/bootstrap-editable/css/bootstrap-editable.css')}}" rel="stylesheet" type="text/css" />
<style>
    .mfp-popup-form {
        max-width: 500px !important;
    }

    #previewDiv {
        display: flex;
        flex-direction: row;
        margin-bottom: 13px;
        gap: 10px;
        padding: 10px;
    }

    .preview-img {
        height: 100p;
        height: 100px;
        padding: 8px;
    }

    .detailed-div {
        display: flex;
        flex-direction: column;
    }

    .detailed-child {
        font-size: small;
    }

    .pdiv {
        background-color: gainsboro;
    }

    .center {
        position: fixed;
        top: 30%;
        bottom: 0;
        left: 5%;
        right: 0;
        margin: auto;
    }

    /* @keyframes spin {
        100% {
            transform: rotate(360deg);
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
                        <h4 class="mb-0 font-size-18">Buttons</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Agroxa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UI Elements</a></li>
                            <li class="breadcrumb-item active">Buttons</li>
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
        <!-- Start Page Content Wrapper -->
        <div class="page-content-wrapper mt-0 text-center">
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="my-4 text-center">
                    <h4 class="card-title">Social Media</h4>
                    <div class="button-items">
                        <button type="button" class=" popup-form btn btn-success btn-lg waves-effect waves-light " data-bs-toggle="modal" data-bs-target="#staticBackdrop">Share Social Post</button>
                    </div>
                </div>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Post a social media link here:
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{url('/saveSocialPost')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12" id="linkDiv">
                                            <div class="form-group mb-3">
                                                <input type="text" name="url" id="linkField" required class="form-control" placeholder="Paste a link..">
                                                <input type="hidden" name="title" id="title" class="form-control">
                                                <input type="hidden" name="description" id="description" class="form-control">
                                                <input type="hidden" name="img" id="img" class="form-control">
                                            </div>
                                            <div id="previewDiv">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-info">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{asset('assets/images/loader.gif')}}" class="center" id="loader">
        <!-- <a href="#" id="inline-username" data-type="text" data-pk="1" data-title="Enter username">superuser</a> -->
        <div id="ajaxResp">
        </div>
    </div>
    <!-- <div class="col-6">
        <div>
            <h5 class="font-size-14">Fits (Horz/Vert)</h5>
            <a class="image-popup-vertical-fit" href="{{asset('assets/images/loader.gif')}}">
                <img class="img-fluid" alt="" src="{{asset('assets/images/loader.gif')}}" width="145">
            </a>
        </div>
    </div> -->

</div>
@section('script')
Plugins js
<script src="{{asset('assets/js/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/js/libs/bootstrap-editable/js/index.js')}}"></script>
<script src="{{asset('assets/js/form-xeditable.init.js')}}"></script>
<!-- <script src="{{asset('assets/js/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/lightbox.init.js')}}"></script> -->

<!-- <script src="{{asset('assets/js/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/lightbox.init.js')}}"></script> -->
<script>
    document.querySelector('#linkField').addEventListener('change', (e) => {
        let link = e.target.value;
        let titleValue = document.getElementById('title');
        let descValue = document.getElementById('description');
        let imgValue = document.getElementById('img');

        if (link) {
            $.ajax({
                url: '/linkPreview',
                type: 'POST',
                data: {
                    link,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'JSON',
                success: function(response) {
                    let previewDiv = document.getElementById('previewDiv');
                    console.log(response);
                    if (previewDiv) {
                        previewDiv.innerHTML = ""
                    }
                    let img = document.createElement("img");
                    img.classList.add("preview-img");
                    img.src = (response.img != "0") ? response.img : 'assets/images/small/img-3.jpg';
                    previewDiv.appendChild(img);
                    let title = document.createElement("h1");
                    title.classList.add("detailed-child");
                    title.textContent = (response.title != "0") ? response.title : link;
                    let description = document.createElement("p");
                    description.classList.add("detailed-child");
                    description.textContent = (response.description != "0") ? response.description : 'No description available.';
                    let detailedDiv = document.createElement("div");
                    detailedDiv.classList.add("detailed-div");
                    detailedDiv.appendChild(title);
                    detailedDiv.appendChild(description);
                    previewDiv.appendChild(detailedDiv);
                    previewDiv.classList.add("pdiv");

                    //storing hidden values = textContent;
                    descValue.value = description.textContent;
                    titleValue.value = title.textContent;
                    imgValue.value = img.src;
                },
                error: function(response) {
                    previewDiv.innerHTML = "";
                }
            });
        } else {
            previewDiv.innerHTML = "";
            previewDiv.classList.remove("pdiv");
        }

    });

    $('#loader').show();
    $(document).ready(function() {
        $.ajax({
            url: '/getSocialPosts',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                setTimeout(function() {
                    $('head').append("<link href='{{asset('assets/js/libs/magnific-popup/magnific-popup.css')}}' rel='stylesheet' type='text/css' />");
                    $('#loader').hide();
                    $('#ajaxResp').html(response.tableview);
                }, 1000);

                // Method for creating table using dom element

                // let tableBody = document.getElementById('socialMediaBody')
                // for (let i in response.data.data) {
                //     let tr = document.createElement('tr');
                //     let td1 = document.createElement('td');
                //     let no = document.createTextNode(Number(i) + 1)
                //     td1.appendChild(no);
                //     let td2 = document.createElement('td');
                //     let siteUrl = document.createTextNode(response.data.data [i].siteUrl)
                //     td2.appendChild(siteUrl);
                //     let td3 = document.createElement('td');
                //     let title = document.createTextNode(response.data.data[i].title)
                //     td3.appendChild(title);
                //     let td4 = document.createElement('td');
                //     let description = document.createTextNode(response.data.data[i].description)
                //     td4.appendChild(description);
                //     let td5 = document.createElement('td');
                //     let image = document.createTextNode(response.data.data[i].imageUrl)
                //     td5.appendChild(image);
                //     let td6 = document.createElement('td');
                //     let edit = document.createTextNode(response.data.data[i].editUrl)
                //     td6.appendChild(edit);
                //     tr.appendChild(td1);
                //     tr.appendChild(td2);
                //     tr.appendChild(td3);
                //     tr.appendChild(td4);
                //     tr.appendChild(td5);
                //     tableBody.appendChild(tr);
                // }
                // console.table(response.data.data[0].siteUrl);
                // alert('success')
                // }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    $(document).on('click', '.pagination a', function(event) {
        $('#ajaxResp').hide();
        $('#loader').show();
        event.preventDefault();
        var page = $(this).attr('href').split("?page=")[1];
        $.ajax({
            url: "/getSocialPosts?page=" + page,
            success: function(data) {
                setTimeout(function() {
                    $('#loader').hide();
                    $('#ajaxResp').html(data.tableview);
                    $('#ajaxResp').show();
                }, 1000);
            }
        });
    });


    // document.getElementById("66435548ca794256a604e432").addEventListener("input", function(event) {
    //     console.log(event)
    // }, false)
</script>
@endsection
@endsection