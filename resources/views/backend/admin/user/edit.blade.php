<form id='edit' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
      novalidate>
    {{method_field('PATCH')}}
    <div class="form-row">
        <div id="status"></div>
        <input type="text" class="form-control" id="id" name="id" value="{{$user->id}}" hidden placeholder=""
                   required>
        <div class="form-group col-md-6 col-sm-12">
            <label for=""> NIP </label>
            <input type="number" class="form-control" id="NIP" name="NIP" value="{{$user->NIP}}" placeholder=""
                   required>
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for=""> Name </label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder=""
                   required>
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for=""> Jabatan </label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{$user->jabatan}}" placeholder=""
                   required>
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for=""> Email </label>
            <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="" required>
            <span id="error_email" class="has-error"></span>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for=""> Password </label>
            <input type="text" class="form-control" id="password" name="password" value="" placeholder=""
                   required>
            <span id="error_password" class="has-error"></span>
        </div>
        <div class="form-group col-md-6">
            <label for=""> Status </label><br/>
            <input type="radio" name="status" class="flat-green"
                   value="1" {{ ( $user->status == 1 ) ? 'checked' : '' }} /> Active
            <input type="radio" name="status" class="flat-green"
                   value="0" {{ ( $user->status == 0 ) ? 'checked' : '' }}/> In Active
        </div>
        <div class="form-group col-md-6">
        <label for=""> Department </label><br/>
        <select class="form-control" name="department_name" id="department_name">
            <option value="">--Select Department--</option>
            @if(!empty($department_user))
            @foreach($department_name as $divisi => $key)
            <option value="{{ $key->id }}" {{ $key->id == $department_user->divisi_id ? 'selected' : '' }}>{{ $key->name_division }}</option>
            @endforeach
            @else
            @foreach($department_name as $divisi => $key)
            <option value="{{ $key->id }}">{{ $key->name_division }}</option>
            @endforeach
            @endif
        </select>
        </div>

        <div class="form-group col-md-6">
        <label for=""> Seksi </label><br/>
        @if(!empty($department_user))

        <input type="text" id="dataSeksiID" value="{{$department_user->seksi_id}}" hidden>

        @endif
        <select name="seksi" id="seksi" class="form-control">
                <option value="" selected disabled>--Select Seksi--</option>
        </select>
        </div>
    
        <div class="clearfix"></div>
        <div class="col-md-12 mb-3">
            <button type="submit" class="btn btn-success button-submit w-100"
                    data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
            </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        // GET SEKSI IF HAVE DIVISION EXIST
        var depid = $("select[name='department_name']").val();
        var dataSeksiID = $("#dataSeksiID").val();
            // console.log(depid);
        var selected = "selected";
        if(depid != ""){
            $.ajax({
                url: '/api/v1/getSeksiByDept/'+ depid,
                method: 'get',
                type: 'json',
                success: function (result) {
                    if(result.dataSeksi.length === 0){
                        $("select[name='seksi']").html("<option>--Select Seksi--</option>");
                    }else{
                        $.each(result.dataSeksi,function(key, value)
                        {
                            
                            if(value["id"] == dataSeksiID){
                                $("select[name='seksi']").append('<option value="' + value["id"] + '" '+selected+'>' + value["seksi_name"] + '</option>');
                            }else{
                                $("select[name='seksi']").append('<option value="' + value["id"] + '">' + value["seksi_name"] + '</option>');
                            }
                            // console.log('<option value="' + value["id"] + '">' + value["seksi_name"] + '</option>');
                            
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
        });
        }
            
        $('#edit').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                name: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                name: {
                    required: 'Enter User Name'
                }
            },
            submitHandler: function (form) {

                var myData = new FormData($("#edit")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: 'users/' + '{{ $user->id }}',
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();
                        $("#submit").prop('disabled', true); // disable button
                    },
                    success: function (data) {
                        // console.log(data);
                        if (data.type === 'success') {
                            reload_table();
                            notify_view(data.type, data.message);
                            $('#loader').hide();
                            $("#submit").prop('disabled', false); // disable button
                            $("html, body").animate({scrollTop: 0}, "slow");
                            $('#myModal').modal('hide'); // hide bootstrap modal

                        } else if (data.type === 'error') {
                            if (data.errors) {
                                $.each(data.errors, function (key, val) {
                                    $('#error_' + key).html(val);
                                });
                            }
                            $("#status").html(data.message);
                            $('#loader').hide();
                            $("#submit").prop('disabled', false); // disable button

                        }

                    },
                    error: function(xhr, status, error) {
                    console.log(xhr);
                    }
                });
            }

        });

        // GET DATA SEKSI (HR)
        $('#department_name').change(function () {
            var depid = $(this).val();
            // console.log(depid);
            $("select[name='seksi']").html("<option>--Select Seksi--</option>");
            $.ajax({
                url: '/api/v1/getSeksiByDept/'+ depid,
                method: 'get',
                type: 'json',
                success: function (result) {
                    if(result.dataSeksi.length === 0){
                        $("select[name='seksi']").html("<option>--Select Seksi--</option>");
                    }else{
                        $.each(result.dataSeksi,function(key, value)
                        {
                            // console.log('<option value="' + value["id"] + '">' + value["seksi_name"] + '</option>');
                            $("select[name='seksi']").append('<option value="' + value["id"] + '">' + value["seksi_name"] + '</option>');
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
        });

    });
</script>