@extends('backend.layouts.master')
@section('title', ' All Roles')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit"> </i>
                </div>
                <div>Laporan PKK Karyawan</div>
                <!-- <div class="d-inline-block ml-2">
                        <button class="btn btn-success" onclick="create()"><i
                                class="glyphicon glyphicon-plus"></i>
                            New Role
                        </button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="manage_all" class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>PKK Number</th>
                                <th>Nama Karyawan</th>
                                <th>Tahun</th>
                                <th>Periode</th>
                                <th>Nilai Akhir</th>
                                <th>Nilai Huruf</th>
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
                width: 90%;
                border-radius: 5px;
            }
        }
    </style>
    <script>
        $(function () {
            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/allLaporanPKK',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'pkk_number', name: 'pkk_number'},
                    {data: 'nama_karyawan', name: 'nama_karyawan'},
                    {data: 'tahun', name: 'tahun'},
                    {data: 'periode', name: 'periode'},
                    {data: 'nilai_akhir', name: 'nilai_akhir'},
                    {data: 'nilai_akhir', name: 'nilai_huruf',
                        "searchable": false,
                                "orderable":false,
                                "render": function (data, type, row) {
                                    if(row.nilai_akhir <= 227){
                                        return 'Kurang (D)';
                                    }else if(row.nilai_akhir <= 297 && row.nilai_akhir  >= 228){
                                        return 'Cukup (C)';
                                    }else if(row.nilai_akhir  <= 304 && row.nilai_akhir  >= 298){
                                        return 'Baik (B)';
                                    }else if(row.nilai_akhir  <= 380 && row.nilai_akhir  >= 305){
                                        return 'Baik Sekali (BS)';
                                    }
                        }
                    },
                    // {data: 'action', name: 'action'}
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
            $('.modal-title').text('Add New Role'); // Set Title to Bootstrap modal title

            $.ajax({
                type: 'GET',
                url: 'roles/create',
                success: function (data) {
                    $("#modal_data").html(data.html);
                    $('#myModal').modal('show'); // show bootstrap modal
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });

        }


        $("#manage_all").on("click", ".edit", function () {

            $("#modal_data").empty();
            $('.modal-title').text('Edit Role'); // Set Title to Bootstrap modal title

            var id = $(this).attr('id');

            $.ajax({
                url: 'roles/' + id + '/edit',
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

        $("#manage_all").on("click", ".view", function () {

            $("#modal_data").empty();
            $('.modal-title').text('View Role'); // Set Title to Bootstrap modal title

            var id = $(this).attr('id');

            $.ajax({
                url: 'roles/' + id,
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
                        url: 'roles/' + id,
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
