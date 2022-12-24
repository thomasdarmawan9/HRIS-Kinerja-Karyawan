<form id='create' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="form-row">
        <div id="status"></div>
        <input type="text" class="form-control" id="ds" name="ds" value="department" hidden>
        <div class="form-group col-md-12 col-sm-12">
            <label for=""> Department Name </label>
            <input type="text" class="form-control" id="name_division" name="name_division" value=""
                   placeholder="" required>
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-group col-md-12 col-sm-12">
            <label for=""> Department Leader </label>
            <select class="form-control" name="leader_team_name" id="leader_team_name">
            </select>
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <br/><br/>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success"><span class="fa fa-save fa-fw"></span> Save</button>
        </div>
        <div class="clearfix"></div>
    </div>
</form>

<script>

    $(document).ready(function () {
        $('#loader').hide();
        $('#create').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                name_division: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                name_division: {
                    required: 'Enter Department Name'
                }
            },
            submitHandler: function (form) {

              
                    var myData = new FormData($("#create")[0]);
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    myData.append('_token', CSRF_TOKEN);


                    $.ajax({
                            url: 'departmentseksi',
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
                                console.log(data)
                                if (data.type === 'success') {
                                    swal("Done!", "It was succesfully done!", "success");
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
                                    swal("Error sending!", "Please try again", "error");

                                }

                            },
                            error: function(xhr, status, error) {
                            console.log(xhr);
                            }
                        });

            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });
</script>