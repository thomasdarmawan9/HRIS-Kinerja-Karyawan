{!! Form::model($department, ['method' => 'PATCH','id'=>'edit']) !!}
<div class="form-row">
    <div id="status"></div>
    <input type="text" class="form-control" id="ds" name="ds" value="department" hidden>
    <div class="form-group col-md-12 col-sm-12">
        {{ Form::label('name', 'Department Name') }}
        {{ Form::text('name_division', null, array('class' => 'form-control')) }}
        <span id="error_name" class="has-error"></span>
    </div>
    <div class="form-group col-md-12 col-sm-12">
        {{ Form::label('name', 'Leader Team Name') }}
        {{ Form::text('leader_team_name', null, array('class' => 'form-control')) }}
        <span id="error_name" class="has-error"></span>
    </div>
    <div class="clearfix"></div>
    <br/><br/>
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-success"><span class="fa fa-save fa-fw"></span> Save</button>
    </div>
</div>

{{ Form::close() }}

<script>
    $(document).ready(function () {
        $('#loader').hide();
        $('#edit').validate({// <- attach '.validate()' to your form
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


                    var myData = new FormData($("#edit")[0]);
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    myData.append('_token', CSRF_TOKEN);


                    $.ajax({
                            url: 'departmentseksi/' + '{{ $department->id }}',
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
                            error: function (result) {
                                console.log(result)
                            }
                        });

            }
        });

    });
</script>