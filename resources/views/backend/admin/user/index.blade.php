@extends('backend.layouts.master')
@section('title', ' All Users')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit"> </i>
                </div>
                <div>All Data Karyawan</div>
                <div class="d-inline-block ml-2">
                        <button class="btn btn-success" onclick="create()"><i
                                    class="glyphicon glyphicon-plus"></i>
                            Buat akun karyawan
                        </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="manage_all"
                               class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <!-- <th>Photo</th> -->
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        @media screen and (min-width: 768px) {
            #myModal .modal-dialog {
                width: 55%;
                border-radius: 5px;
            }
        }
    </style>
    <script>
        $(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('admin.allUser.users') !!}',
                    "type": "GET",
                    headers: {
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                    },
                    "dataType": 'json'
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    // {data: 'file_path', name: 'file_path'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'}
                ],
                "autoWidth": false,
            });
            $('.dataTables_filter input[type="search"]').attr('placeholder', 'Type here to search...').css({
                'width': '220px',
                'height': '30px'
            });

        });
    </script>
    <script type="text/javascript">

        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax
        }


        function create() {

            $("#modal_data").empty();
            $('.modal-title').text('Add New User'); // Set Title to Bootstrap modal title

            $.ajax({
                type: 'GET',
                url: 'users/create',
                success: function (data) {
                    
                    $("#modal_data").html(data.html);
                    $('#myModal').modal('show'); // show bootstrap modal
                    // console.log(data.role);
                    $.each(data.jabatan, function(index, data ){
                        $("#jabatan").append('<option value="' + data.jabatan + '">' + data.jabatan  + '</option>');
                    });

                    $.each(data.department, function(index, data ){
                        $("#department").append('<option value="' + data.id + '">' + data.name_division  + '</option>');
                    });

                    $.each(data.seksi, function(index, data ){
                        $("#seksi").append('<option value="' + data.id + '">' + data.seksi_name  + '</option>');
                    });
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });

        }


        $("#manage_all").on("click", ".edit", function () {

            $("#modal_data").empty();
            $('.modal-title').text('Edit User'); // Set Title to Bootstrap modal title

            var id = $(this).attr('id');

            $.ajax({
                url: 'users/' + id + '/edit',
                type: 'get',
                success: function (data) {
                    console.log(data);
                    $("#modal_data").html(data.html);
                    $('#myModal').modal('show'); // show bootstrap modal
                    // $.each(data.department_name, function(index, data ){
                    //     $("#department_name").append('<option value="' + index + '">' + data  + '</option>');
                    // });
                },
                error: function (result) {
                    console.log(result);
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        });

        $("#manage_all").on("click", ".view", function () {

            $("#modal_data").empty();
            $('.modal-title').text('View User'); // Set Title to Bootstrap modal title

            var id = $(this).attr('id');

            $.ajax({
                url: 'users/' + id,
                type: 'get',
                success: function (data) {
                    $("#modal_data").html(data.html);
                    $('#myModal').modal('show'); // show bootstrap modal
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        });

    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            $("#manage_all").on("click", ".delete", function () {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var id = $(this).attr('id');
                // console.log(CSRF_TOKEN);
                swal({
                    title: "Are you sure?",
                    text: "Deleted data cannot be recovered!!",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel"
                }, function () {
                    $.ajax({
                        url: 'users/' + id,
                        data: {"_token": CSRF_TOKEN},
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (data) {
                            
                            if (data.type === 'success') {

                                swal("Done!", "Successfully Deleted", "success");
                                reload_table();

                            } else if (data.type === 'danger') {

                                swal("Error deleting!", "Try again", "error");

                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error deleting!", "Try again", "error");
                        }
                    });
                });
            });
        });

    </script>
@stop
