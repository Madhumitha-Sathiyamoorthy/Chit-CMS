@extends('layouts.master')
@section('title', 'User Details')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .congratulation-wrapper {
        max-width: 550px;
        margin-inline: auto;
        -webkit-box-shadow: 0 0 20px #f3f3f3;
        box-shadow: 0 0 20px #f3f3f3;
        padding: 30px 20px;
        background-color: #fff;
        border-radius: 10px;
    }

    a.disabled {
    pointer-events: none;
        color: #ccc;
    }

    .congratulation-contents.center-text .congratulation-contents-icon {
        margin-inline: auto;
    }
    .congratulation-contents-icon {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        height: 100px;
        width: 100px;
        background-color: #65c18c;
        color: #fff;
        font-size: 50px;
        border-radius: 50%;
        margin-bottom: 30px;
    }
    .congratulation-contents-title {
        font-size: 32px;
        line-height: 36px;
        margin: -6px 0 0;
    }
    .congratulation-contents-para {
        font-size: 16px;
        line-height: 24px;
        margin-top: 15px;
    }
    .btn-wrapper {
        display: block;
    }
    .cmn-btn.btn-bg-1 {
        background: #6176f6;
        color: #fff;
        border: 2px solid transparent;
        border-radius:3px;
        text-decoration: none;
        padding:5px;
    }
</style>
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
            </div>
        </div>
        <!-- end page title -->

        <!-- Start page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="row">
            <section class="bg-light pt-5 pb-5 shadow-sm">
                <div class="container">
                    <div class="row">
                    <!--ADD CLASSES HERE d-flex align-items-stretch-->
                    @foreach($getChits as $key=>$chit)
                    <div class="col-lg-4 mb-3 d-flex align-items-stretch">
                        <div class="card">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{$chit['chitName']}}</h5>
                            <p class="card-text mb-4">{{$chit['description']}}</p>
                            @if($chit['user'])
                                <h6>Users:</h6>
                                <ul class="list-group list-group-flush">
                                    <?php
                                        $customers = explode(',', $chit['user']);
                                    ?>
                                    @foreach($customers as $customer)
                                    <li class="list-group-item">{{$customer}}</li>
                                    @endforeach
                                </ul>
                                <input type="hidden" name="customerId" id = "customerId" value="{{$chit['userid']}}" />
                                <!-- <input type="hidden" name="chitId" id = "chitId" value="{{$chit['_id']}}" /> -->
                                <!-- <a href="#" class="btn btn-warning mt-auto align-self-start" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">view details</a> -->
                                <a href="#" class="btn btn-warning mt-auto align-self-start" id="chitDetails" data-userId="{{$chit['userid']}}" data-usersName="{{$chit['user']}}" data-chitId="{{$chit['_id']}}">view details</a>
                            @else
                                <h6 style="text-align:center; margin: auto;">No Users!</h6>
                            @endif
                        </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
                </section>
                    <!-- End Card -->
                <!-- End col -->
            </div>
            <!-- End row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- Spin Modal -->
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id = "spinModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-censmallModaltered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">Auction Winner !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="congratulation-area text-center mt-5">
                    <div class="container">
                        <div class="congratulation-wrapper">
                            <div class="congratulation-contents center-text">
                                <div class="congratulation-contents-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                
                                <h4 class="congratulation-contents-title" id="congratsMsg"></h4>
                                <p class="congratulation-contents-para"> You won the Auction &#129395;</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- show details modal -->
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="showDetailsModal"aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Spin Chit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Users:</h6>
                    <ul class="list-group list-group-flush" id="userList">
                        <!-- Dynamic user list will come here: -->
                    </ul>
                    <a role="button" class="btn btn-secondary" id="spin">
                        <span >Spin</span>
                        <i class="fa">&#xf021;</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="{{asset('assets/js/libs/masonry-layout/masonry.pkgd.min.js')}}"></script>
<script>
    let getUserId;
    let getChitId;
    let disabled = [];
    $(document).on('click', '#chitDetails', (e)=>{
        let getUsers = e.target.getAttribute('data-usersName');
        getuserId = e.target.getAttribute('data-userId').split(',');
        getuserId.splice(getuserId.length-1,  1)
        getChitId = e.target.getAttribute('data-chitId');
        let list = document.getElementById('userList');
        list.innerHTML = '';
        let customerName = getUsers.split(",")
        customerName.splice(customerName.length-1,  1)
        // while (list.hasChildNodes()) {
        //     list.removeChild(list.firstChild);
        // }
        for(let i=0;i<customerName.length;i++) {
            let item = document.createElement('li');
            item.innerHTML = customerName[i];
            item.classList.add("list-group-item");
            list.appendChild(item);
        }
        $('#showDetailsModal').modal('show');
        let spinId =document.getElementById('spin');
        if(disabled.indexOf(getChitId) != -1 ){
            spinId.classList.add("disabled");
        }else{
            spinId.classList.remove("disabled");
        }
    });
    
    $("#spin").click(function(){
        let data = {userId : getuserId,chitId : getChitId};
        $.ajax({    
            url: '/spinChit',
            type: 'POST',
            data: {data,"_token": "{{ csrf_token() }}" },
            dataType: 'JSON',
            success:function(response)
            {
                if(response.status == 200){
                    $('#showDetailsModal').modal('hide');
                    $("#congratsMsg").html(response.message);
                    $('#spinModal').modal('show');
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
        disabled.push(getChitId);
    });
</script>
@endsection
@endsection

