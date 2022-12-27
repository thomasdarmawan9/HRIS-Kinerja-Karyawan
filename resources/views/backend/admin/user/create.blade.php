<form id='create' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
      novalidate>
    <div class="form-row">
        <div id="status"></div>
        <div class="col-12"> 
            <h5> Isi Data Karyawan</h5>
            <hr>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for=""> NIP </label>
            <input type="number" class="form-control" id="NIP" name="NIP" value="" placeholder="" required>
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for=""> Name </label>
            <input type="text" class="form-control" id="name" name="name" value="" placeholder="" required>
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for=""> Jabatan </label>
            <!-- <input type="text" class="form-control" id="jabatan" name="jabatan" value="" placeholder="" required> -->
            <select class="form-control" name="jabatan" id="jabatan">
                <option>--Select Jabatan</option>
            </select>
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for=""> Email </label>
            <input type="text" class="form-control" id="email" name="email" value="" placeholder="" required>
            <span id="error_email" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-6 col-sm-12">
            <label>Password:</label>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','required')) !!}
            <span id="error_password" class="has-error"></span>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label>Confirm Password:</label>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control','required')) !!}
            <span id="error_confirm-password" class="has-error"></span>
        </div>
   
        <div class="col-12"> 
        <hr>
            <h5> Pilih Department & Seksi </h5>
            <hr>
        </div>
        <br>
        <div class="form-group col-md-6 col-sm-6">
            <label for=""> Departement </label>
            <select class="form-control" name="department" id="department">
            <option value="">--Select Department--</option>
            </select>
        </div>
        <div class="form-group col-md-6 col-sm-6">
            <label for=""> Seksi </label>
            <select class="form-control" name="seksi" id="seksi">
            <option value="">--Select Seksi--</option>
            </select>
        </div>
        <!-- <div class="clearfix"></div>
        <div class="col-md-12">
            <label for="photo">Upload Image</label>
            <input id="photo" type="file" name="photo" style="display:none">
            <div class="input-group">
                <div class="input-group-btn">
                    <a class="btn btn-success" onclick="$('input[id=photo]').click();">Browse</a>
                </div>
                <input type="text" name="SelectedFileName" class="form-control" id="SelectedFileName"
                       value="" readonly>
            </div>
            <div class="clearfix"></div>
            <p class="help-block">File must be jpg, jpeg, png. width below 1500px and heigth 700px and less than 2mb</p>
            <script type="text/javascript">
                $('input[id=photo]').change(function () {
                    $('#SelectedFileName').val($(this).val());
                });
            </script>
            <span id="error_photo" class="has-error"></span>
        </div>
        <div class="clearfix"></div> -->
        
        <div class="col-md-12 mb-3">
            <button type="submit" class="btn btn-success button-submit w-100"
                    data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
            </button>
        </div>
    </div>
</form>

<script>

    $(document).ready(function () {
        $('#create').validate({// <- attach '.validate()' to your form
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

                var myData = new FormData($("#create")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: 'users',
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
                        console.log(data);
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
                            swal("Error, NIP has already been taken!", "Try again", "error");
                            $("#status").html(data.message);
                            $('#loader').hide();
                            $("#submit").prop('disabled', false); // disable button

                        }

                    }, 
                    error: function(xhr, status, error) {
                    console.log(xhr);
                    swal("Error create user!", "Try again", "error");
                    }
                });
            }

        });

    });
</script>