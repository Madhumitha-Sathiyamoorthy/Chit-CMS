@extends('layouts.master')
@section('title', 'Email Compose')
@section('content')
</script>
<style>
    .disabled {
        background: #e6e6e6 !important;
        pointer-events: none;
    }

    #tagCc {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #tagCc li {
        display: inline-block;
        background-color: #f2f2f2;
        color: #333;
        border-radius: 20px;
        padding: 5px 10px;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .delete-button {
        background-color: transparent;
        border: none;
        color: #999;
        cursor: pointer;
        margin-left: 5px;
    }

    .subSubjectCol {
        color: #999999;
    }

    .subSubjectPos {
        position: relative;
        border: 1px solid #ccc;
        width: 100%;
        min-height: 53px;
    }

    .subSubjectCol:before {
        content: attr(data-text);
        position: absolute;
        top: 30%;
        left: 10px;
        transform: translateY(-50%);
    }

    #subAttach {
        height: 50px;
    }

    .display {
        display: none;
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
                <div class="col-6">
                    <div class=" mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="To" id="mainTo">
                                    </div>
                                    <div class="mb-3">
                                        <ul id="tagCc"></ul>
                                        <input type="text" class="form-control" placeholder="CC" id="mainCc">
                                    </div>
                                    <div class="mb-3">
                                        <textarea type="text" class="form-control" placeholder="< Subject in HTML >" id="subjectCc"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label"> Add attachment:</label>
                                        <input class="form-control" type="file" id="formFile">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class=" mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control disabled" placeholder="To" id="subTo">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control disabled" placeholder="CC" id="subCc">
                                    </div>
                                    <div class="mb-3">
                                        <!-- <textarea type="text" class="form-control disabled" placeholder="Subject" id="subSubjectCc"></textarea> -->
                                        <div id='subSubjectCc' data-text="Subject" class="form-control disabled subSubjectCol subSubjectPos">
                                        </div>
                                    </div>

                                    <div class="mb-3 display" id="attachment">
                                        <label for="formFile" class="form-label"><i class="fa fa-paperclip" aria-hidden="true"></i> Attachments:</label>
                                        <div class="col-xl-2 col-6">
                                            <div class="card">
                                                <img class="card-img-top img-fluid" src="assets/images/small/img-3.jpg" id="subAttach" alt="Card image cap">
                                                <div class="py-2 text-center">
                                                    <a href="" class="fw-medium text-primary" id="downloadAttachment" download="email_attachment">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="btn-toolbar mb-0">
                                        <div class="">
                                            <button id="sendEmail" class="btn btn-primary waves-effect waves-light"> <span>Send Mail</span> <i class="fab fa-telegram-plane ms-2"></i> </button>
                                        </div>
                                    </div>
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
<script>
    const mainTo = document.getElementById('mainTo');
    const subTo = document.getElementById('subTo');
    const mainCc = document.getElementById('mainCc');
    const subCc = document.getElementById('subCc');
    const tagCc = document.getElementById('tagCc');
    const subjectCc = document.getElementById('subjectCc');
    const mainAttach = document.getElementById('formFile');
    const subAttach = document.getElementById('subAttach');
    const downloadAttachment = document.getElementById('downloadAttachment');
    const sendEmail = document.getElementById('sendEmail');

    const copyInput = function(e) {
        subTo.value = `To: ${e.target.value}`;
    }

    mainTo.addEventListener('input', copyInput)

    mainCc.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            const tag = document.createElement('li');
            const tagContent = mainCc.value;
            if (tagContent !== '') {
                tag.innerText = tagContent;
                tag.innerHTML += '<button class="delete-button">X</button>';
                tagCc.appendChild(tag);
                mainCc.value = '';
                setSubCc()
            }
        }
    });

    tagCc.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-button')) {
            e.target.parentNode.remove();
            setSubCc()
        }
    })

    function setSubCc() {
        let liElements = tagCc.getElementsByTagName('li')
        let values = [];
        for (let i = 0; i < liElements.length; i++) {
            let value = liElements[i].textContent;
            values.push(value.slice(0, -1))
        }
        subCc.value = values.length > 0 ? 'CC: ' + values.join(',') : '';
    }

    subjectCc.addEventListener('input', function(e) {
        subSubjectCc.innerHTML = subjectCc.value;
        subSubjectCc.classList.remove('subSubjectCol');
        (subjectCc.value == '' || subSubjectCc.innerHTML == '') && subSubjectCc.classList.add('subSubjectCol');
    });

    mainAttach.addEventListener('change', function(e) {
        //desturing file property into variable
        const [file] = mainAttach.files
        if (file) {
            subAttach.src = URL.createObjectURL(file);
            downloadAttachment.href = URL.createObjectURL(file);
            document.querySelector('#attachment').classList.remove('display');
        }
    });

    sendEmail.addEventListener('click', function() {
        alert('Email sent!')
    })
</script>
@endsection
@endsection