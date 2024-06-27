<div class="table-responsive" id="socialData">
    <table class="table mb-0" id="list">
        <span style="display: none;color:red;" id="errorMsg">Do not provide Empty value</span>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Site Url</th>
                <th id="title">Title</th>
                <th id="titleedit" style="display:none"></th>
                <th id="desc">Description</th>
                <th id="descedit" style="display:none"></th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody id="socialMediaBody">
            @foreach($socialData as $key=>$data)
            <tr>
                <!-- <button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button> -->
                <!-- <button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect waves-light"><i class="mdi mdi-close"></i></button>      -->
                <td scope="row">{{ $key+1 }}</td>
                <td> {{ $data->siteUrl }}</td>
                <!-- <td contenteditable id="title_{{ $data->_id }}" oninput="editValue(this)"> {{ $data->title }}</td> -->
                <td id="title_{{ $data->_id }}" onclick="editValue(this)"> {{ $data->title }}
                </td>
                <td id="titlebtn_{{ $data->_id  }}" style="display:none" required>
                    <button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light editTick" onclick="editTick(this)" id="editTick_{{ $data->_id  }}" data-id="{{ $data->_id }}"><i class="mdi mdi-check"></i></button>
                    <button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect waves-light"><i class="mdi mdi-close"></i></button>
                </td>
                <td id="description_{{ $data->_id }}" onclick="editValue(this)"> {{ $data->description }}
                </td>
                <td id="descbtn_{{ $data->_id  }}" style="display:none">
                    <button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light editTick" onclick="editTick(this)" id="editTick_{{ $data->_id  }}" data-id="{{ $data->_id }}"><i class="mdi mdi-check"></i></button>
                    <button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect waves-light"><i class="mdi mdi-close"></i></button>
                </td>
                <!-- <td contenteditable id="description_{{ $data->_id }}" oninput="editValue(this)"> {{ $data->description }}</td> -->
                <td>
                    <div>

                    </div>
                    <a class="image-popup-vertical-fit" href="{{ $data->imageUrl }}" title="{{ $data->title }}">
                        <img class="img-fluid" alt="" src="{{ $data->imageUrl }}" width="145">
                    </a>
                    <!-- <p class="mt-2 mb-0 text-muted">No gaps, zoom animation, close icon in
                        top-right corner.</p> -->
                    <!-- <img src="{{ $data->imageUrl }}" style="width: 100px;height: auto;"> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- <div class="col-6">
        <div>
            <h5 class="font-size-14">Fits (Horz/Vert)</h5>
            <a class="image-popup-vertical-fit" href="{{ $data->imageUrl }}" title="Caption. Can be aligned it to any side and contain any HTML.">
                <img class="img-fluid" alt="" src="{{ $data->imageUrl }}" width="145">
            </a>
        </div>
    </div> -->
    {!! $socialData->links() !!}
</div>
<script src="{{asset('assets/js/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/lightbox.init.js')}}"></script>
<script>
    // $("img.mfp-img").css({
    //     "max-width": "50% !important"
    // });
    function editValue(event) {
        // event.preventDefault();
        let column = event.id;
        let splitValue = column.split('_')
        let colVal = event.innerHTML
        if (splitValue[0] == "title") {
            $("#titleedit").show();
            $("#titlebtn_" + splitValue[1]).show();
            $("#" + column).attr('contenteditable', 'true');
        } else {
            $("#descedit").show();
            $("#descbtn_" + splitValue[1]).show();
            $("#" + column).attr('contenteditable', 'true');
        }
        $("#list tbody tr td:not(#" + column + ")").click(function() {
            if (splitValue[0] == "title") {
                $("#titleedit").hide();
                $("#titlebtn_" + splitValue[1]).hide();
                $("#" + column).removeAttr('contenteditable');
                $("#title_" + splitValue[1]).removeAttr('required');
                $("#title_" + splitValue[1]).removeAttr('style');
                if ($("#" + column).text() == "")
                    $("#title_" + splitValue[1]).text(colVal);
                else if ($("#" + column).text() == colVal)
                    $("#title_" + splitValue[1]).text(colVal);
            } else {
                $("#descedit").hide();
                $("#descbtn_" + splitValue[1]).hide();
                $("#" + column).removeAttr('contenteditable');
                $("#desc_" + splitValue[1]).removeAttr('required');
                $("#desc_" + splitValue[1]).removeAttr('style');
                if ($("#" + column).text() == "")
                    $("#desc_" + splitValue[1]).text(colVal);
                else if ($("#" + column).text() == colVal)
                    $("#desc_" + splitValue[1]).text(colVal);
            }
            //some code here
        });
        // if (colVal != '') {
        //     document.getElementById('errorMsg').style.display = 'none';        
        // } else {
        //     document.getElementById('errorMsg').style.display = 'block';
        // }
    }

    function editTick(e) {
        // e.preventDefault();
        let idVal = $(e).attr("data-id");
        let currVal = $("#title_" + idVal).text()
        if (!currVal) {
            $("#title_" + idVal).attr('required', 'true');
            $("#title_" + idVal).css('border', '2px solid #ff1a1a');
            return false;
        }
        updateValue("#title_" + idVal, idVal, currVal);
    }

    function updateValue(col, id, val) {
        $.ajax({
            url: '/editSocialPosts',
            type: 'POST',
            data: {
                "column": col,
                "id": id,
                "value": val,
                "_token": "{{ csrf_token() }}"
            },
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
            },
            error: function(response) {}
        })
    }
</script>