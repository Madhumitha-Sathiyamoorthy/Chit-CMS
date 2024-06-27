@extends('layouts.master')
@section('title', 'View Customer')
@section('content')
</script>
<style>
    /* Import Google font - Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    .item .details {
        display: flex;
        align-items: center;
    }

    .item.dragging {
        opacity: 2;
    }

    .item.dragging :where(.details, i) {
        opacity: 0;
    }
    #successMessage {
        display: flex;
    }
</style>
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
            <!-- @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif -->
            <span id="successMessage" class=""></span>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Examples</h4>
                            <label class="form-label"> What is a Chit or a Chit Fund?</label>

                            <div class="">
                                <ul class="list-unstyled sortable-list">
                                    @foreach($answers as $answer)
                                    <li draggable="true" class="item">
                                        <div class="alert alert-info details" role="alert">
                                            {{$answer}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <input type="hidden" name="" id="ansId" value="{{$id}}">
                            <div class="text-center">
                                <button type="submit" class="btn btn-info waves-effect waves-light" id="saveOrderBtn">Save Order</button>
                            </div>
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
    <!-- Container-Fluid -->
</div>
@section('script')
<script>
    $(document).ready(function() {
        const sortableList = document.querySelector(".sortable-list");
        const items = sortableList.querySelectorAll(".item");
        $('#saveOrderBtn').click(function() {
            let lists = document.querySelectorAll('.sortable-list .item .details');
            let reOrder = [...lists].map(function({innerHTML}) {
                return innerHTML
            })
            $.ajax({
                url: '/saveAnsOrder',
                type: 'POST',
                data: {
                    reOrder: reOrder,
                    ansId: $('#ansId').val(),
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response.code === 200) {
                        $('html, body').animate({
                            scrollTop: 0
                        }, 'fast');
                        $('#successMessage').text(response.message).addClass('alert').addClass('alert-success').fadeIn();
                        setTimeout(function() {
                            $('#successMessage').fadeOut();
                        }, 2000);
                    }
                },
                error: function(response) {}
            });
        });

        items.forEach(item => {
            item.addEventListener("dragstart", () => {
                setTimeout(() => item.classList.add("dragging"), 0);
            });
            item.addEventListener("dragend", () => item.classList.remove("dragging"));
        });

        const initSortableList = (e) => {
            e.preventDefault();
            const draggingItem = document.querySelector(".dragging");
            let siblings = [...sortableList.querySelectorAll(".item:not(.dragging)")];
            let nextSibling = siblings.find(sibling => {
                return e.clientY <= sibling.offsetTop + sibling.offsetHeight / 2;
            });
            sortableList.insertBefore(draggingItem, nextSibling);
        }
        sortableList.addEventListener("dragover", initSortableList);
        sortableList.addEventListener("dragenter", e => e.preventDefault());

    });
</script>
@endsection
@endsection