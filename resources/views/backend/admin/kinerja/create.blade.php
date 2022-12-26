<form id='create' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
      novalidate>
    <div class="clearfix"></div>
    <div class="form-row">
        <div id="status"></div>
        <div class="form-group col-md-12 col-sm-12">
            <label for=""> Kriteria </label>
            <input type="text" class="form-control" id="kriteria" name="kriteria" value=""
                   placeholder="" required>
            <span id="error_title" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12 col-sm-12">
            <label for=""> Faktor </label>
            <input type="text" class="form-control" id="faktor" name="faktor" value=""
                      placeholder=""></input>
            <span id="error_description" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12 col-sm-12">
            <label for=""> Bobot </label>
            <input type="text" class="form-control" id="bobot" name="bobot" value="" placeholder=""></input>
            <span id="error_description" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Nilai 0 </label>
            <input type="text" class="form-control" id="nilai0" name="nilai0" value=""
                      placeholder=""></input>
            <span id="error_category" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Nilai 1 </label>
            <input type="text" class="form-control" id="nilai1" name="nilai1" value=""
                      placeholder=""></input>
            <span id="error_category" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Nilai 2 </label>
            <input type="text" class="form-control" id="nilai2" name="nilai2" value=""
                      placeholder=""></input>
            <span id="error_category" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Nilai 4 </label>
            <input type="text" class="form-control" id="nilai4" name="nilai4" value=""
                      placeholder=""></input>
            <span id="error_category" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Nilai 5 </label>
            <input type="text" class="form-control" id="nilai5" name="nilai5" value=""
                      placeholder=""></input>
            <span id="error_category" class="has-error"></span>
        </div>
        
        <div class="clearfix"></div>
        <div class="form-group col-md-12 mt-3">
            <button type="submit" class="btn btn-success button-submit w-100"
                    data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
            </button>
        </div>
    </div>
</form>


<script>
    $(document).ready(function () {

        $('.filter').select2();
        $('#loader').hide();

        $('#create').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                kriteria: {
                    required: true
                },
                faktor: {
                    required: true
                },
                bobot: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                kriteria: {
                    required: 'Enter kriteria name'
                }
            },
            submitHandler: function (form) {

                var myData = new FormData($("#create")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: 'kinerja',
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();
                        $(".button-submit").prop('disabled', false); // disable button
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            reload_table();
                            $('#loader').hide();
                            $(".button-submit").prop('disabled', false); // disable button
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
                            $(".button-submit").prop('disabled', false); // disable button

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