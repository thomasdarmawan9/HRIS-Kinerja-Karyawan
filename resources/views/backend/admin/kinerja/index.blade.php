@extends('backend.layouts.master')
@section('title', ' All Blogs')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit"> </i>
            </div>
            <div>Input Data Karyawan</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form>
                    <div class="row">
                        <input type="text" class="form-control" id="user_id_penilai" value="{{$usersID}}" hidden
                            disabled>
                        <div class="form-group col-4">
                            <div class="row">
                                <div class="col-4" style="padding-left:5px;padding-right:5px">
                                    <label for="pkkNumber">PKK Number :</label>
                                </div>
                                <div class="col-8" style="padding-left:5px;">
                                    <input type="text" class="form-control" id="pkkNumber" name="pkk_number" aria-describedby="pkkNumber"
                                        placeholder="Check dokumen status !" style="font-size:12px" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <div class="row">
                                <div class="col-4" style="padding-left:5px;padding-right:5px">
                                    <label for="periodePenilaian">Periode Penilaian :</label>
                                </div>
                                <div class="col-8" style="padding-left:5px;">
                                    <select class="form-control" name="periodePenilaian" id="periodePenilaian" style="font-size:12px">
                                        <option value="Q1"></option>
                                        <option value="Q2"></option>
                                        <option value="Q3"></option>
                                        <option value="Q4"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <div class="row">
                                <div class="col-4" style="padding-left:5px;padding-right:5px">
                                    <label for="namaAtasan">Nama Atasan :</label>
                                </div>
                                <div class="col-8" style="padding-left:5px;">
                                    <input type="text" class="form-control" id="namaAtasan" name="namaAtasan"
                                        value="" style="font-size:12px" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <div class="row">
                                <div class="col-3" style="padding-left:5px;padding-right:5px">
                                    <label for="tahun">Tahun :</label>
                                </div>
                                <div class="col-9" style="padding-left:5px;">
                                    {!! Form::selectYear('year', date('Y'), 2000, null,
                                    ['class'=>'form-control', 'id'=>'year', 'style'=>'font-size:12px']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <div class="row">
                                <div class="col-4" style="padding-left:5px;padding-right:5px">
                                    <label for="departemen">Departement :</label>
                                </div>
                                <div class="col-8" style="padding-left:5px;">
                                        @if(Auth::user()->role->model_type == "HR")
                                            {{ Form::select('departmentList', $departmentList, NULL, ['id' => 'department', 'class' => 'form-control','style' => 'font-size:12px','placeholder' => '--Select Department--', 'style'=>'font-size:12px']) }}
                                        @else

                                        <input type="text" class="form-control" id="departement" name="departement" disabled style="font-size:12px" value="{{ $department && $department[0]->name_division ? $department[0]->name_division: '' }}" data-id="{{ $department && $department[0]->divisi_id ? $department[0]->divisi_id: '' }}" placeholder="departemen">
                                        
                                        @endif
                                        
                                    </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <div class="row">
                                <div class="col-3" style="padding-left:5px;padding-right:5px">
                                    <label for="seksi">Seksi :</label>
                                </div>
                                <div class="col-9" style="padding-left:5px;">
                                @if(Auth::user()->role->model_type == "HR")
                                    <select name="seksi" id="seksi" class="form-control" style="font-size:12px">
                                        <option value="" selected disabled>--Select Seksi--</option>
                                    </select>
                                @else
                                    <input type="text" class="form-control" id="seksi" name="seksi" style="font-size:12px" disabled value="{{ $department && $department[0]->seksi_name ? $department[0]->seksi_name: '' }}" placeholder="seksi">
                                @endif
                                    <!-- <select name="provinsi" id="seksi" class="form-control">
                                        @foreach ($seksiList as $listSeksi)
                                        @if(empty($department))
                                        <option value="{{$listSeksi}}">
                                            {{$listSeksi}}
                                        </option>
                                        @else
                                        <option value="{{$listSeksi}}"
                                            {{($department[0]->seksi_name == $listSeksi) ? 'selected' : ''}}>
                                            {{$listSeksi}}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select> -->
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <div class="row">
                                <div class="col-3" style="padding-left:5px;padding-right:5px">
                                    <label for="nama">Nama :</label>
                                </div>
                                <div class="col-9" style="padding-left:5px;">
                                @if(Auth::user()->role->model_type == "HR")
                                    <select name="name" id="name" class="form-control" style="font-size:12px">
                                        <option value="" selected disabled>--Select User--</option>
                                    </select>
                                @elseif(Auth::user()->role->model_type == "Atasan Langsung")
                                    <select name="name" id="name" class="form-control" style="font-size:12px">
                                    <option value="" selected disabled>--Select User--</option>
                                        @foreach ($dataUser as $listUser)
                                        <option value="{{$listUser['id']}}" data-id="{{$listUser['id']}}"
                                            {{($namaUser == $listUser['name']) ? 'selected' : ''}}>
                                            {{$listUser['name']}}
                                        </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control" id="name" name="nama" disabled style="font-size:12px" value="{{$namaUser}}" data-id="{{$usersID}}" placeholder="nama">
                                @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <div class="row">
                                <div class="col-3" style="padding-left:5px;padding-right:5px">
                                    <label for="departemen">NIP :</label>
                                </div>
                                <div class="col-9" style="padding-left:5px;">
                                    <input type="number" class="form-control" id="NIP" name="NIP" value=""
                                        placeholder="NIP" style="font-size:12px" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <div class="row">
                                <div class="col-3" style="padding-left:5px;padding-right:5px">
                                    <label for="jabatan">Jabatan :</label>
                                </div>
                                <div class="col-9" style="padding-left:5px;">
                                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                                        value="" placeholder="jabatan" style="font-size:12px" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <div class="row">
                                <div class="col-3" style="padding-left:5px;padding-right:5px">
                                    <label for="tempatKerja">Tempat Kerja :</label>
                                </div>
                                <div class="col-9" style="padding-left:5px;">
                                    <input type="text" class="form-control" id="tempatKerja"
                                        value="PT Alamanda Health Global" placeholder="tempatKerja" style="font-size:12px" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <button type="button" class="form-control btn btn-primary w-100" id="check">Check</button>
                        </div>

                    </div>

                </form>
                <hr>
                <div class="row">

                <input type="text" class="form-control" id="nilaiAkhir" name="nilaiAkhir" style="font-size:12px" hidden disabled>
                    <div class="col-12">
                        <h5>Status Dokumen :</h5>
                    </div>
                    <div class="col-12" id="infostatus" style="display:none">
                        <button type="button" class="btn SK">Kemampuan Kerja</button>
                        
                        <button type="button" class="btn SD">Disiplin</button>

                        <button type="button" class="btn SA">Attitude</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="d-inline-block mb-4">

                    <button class="btn btn-primary fnk" style="display:none" onclick="createFaktor()"><i class="glyphicon glyphicon-plus"></i>
                        Tambah Faktor & Kriteria
                    </button>

                </div>
                <div class="table-responsive">
                    <table id="manage_all" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Faktor</th>
                                <th>Kriteria</th>
                                <th>Nilai 0</th>
                                <th>Nilai 1</th>
                                <th>Nilai 2</th>
                                <th>Nilai 4</th>
                                <th>Nilai 5</th>
                                <th class="action">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="forminputkinerja">
    
    <div class="col-md-12 col-sm-12">
        <div class="main-card mb-3 card">
        <div class="card-header">
    
        Evaluasi Kinerja
  </div>
            <div class="card-body card-penilaian-kosong" style="display:none">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4>Belum ada data penilaian</h4>
                    </div>
                </div>
            </div>
            <div class="card-body card-penilaian">
                <nav>
                    <div class="nav nav-tabs row" id="nav-tab" role="tablist">
                        <a class="col-3 nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                            role="tab" aria-controls="nav-home" aria-selected="true">Kemampuan Kerja</a>
                        <a class="col-3 nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                            role="tab" aria-controls="nav-profile" aria-selected="false">Disiplin</a>
                        <a class="col-3 nav-item nav-link" id="nav-attitude" data-toggle="tab" href="#navattitude"
                            role="tab" aria-controls="nav-attitude" aria-selected="false">Attitude</a>
                        <a class="col-3 nav-item nav-link" id="nav-nilai-akhir" data-toggle="tab" href="#nav-contact"
                            role="tab" aria-controls="nav-contact" aria-selected="false">Nilai Akhir</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row pb-3">
                            <div class="col-3">Faktor</div>
                            <div class="col-3">Bobot</div>
                            <div class="col-3">Nilai</div>
                            <div class="col-3">Jumlah</div>
                        </div>
                        <form id="formkemampuankerja">
                            @foreach($kemampuanKerja as $value)
                            <div class="row pb-3">
                                <div class="col-3"><input type="text" id="faktorid-{{$value->id}}" name="faktoridkk[]"
                                        value="{{$value->id}}" hidden>{{$value->faktor}}</div>
                                <div class="col-3"><input type="text" id="bobot-{{$value->id}}" name="bobotkk[]"
                                        value="{{$value->bobot}}" hidden>{{$value->bobot}}</div>
                                <div class="col-3">
                                    <select class="form-control nilaikk" data-id="{{ $value->id }}"
                                        id="nilai-{{$value->id}}" name="nilaikk[]" value="" required>
                                        <option value=""></option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="jumlahkk-{{$value->id}}"
                                        name="jumlahkk[]" value="" disabled>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" id="kemampuankerja"
                                        class="form-control btn btn-primary w-100">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row pb-3">
                            <div class="col-3">Faktor</div>
                            <div class="col-3">Bobot</div>
                            <div class="col-3">Nilai</div>
                            <div class="col-3">Jumlah</div>
                        </div>
                        <form id="formdisiplin">
                            @foreach($disiplin as $value)
                            <div class="row pb-3">
                                <div class="col-3"><input type="text" id="faktorid-{{$value->id}}"
                                        name="faktoriddisiplin[]" value="{{$value->id}}" hidden>{{$value->faktor}}</div>
                                <div class="col-3"><input type="text" id="bobotdisiplin-{{$value->id}}" name="bobotdisiplin[]"
                                        value="{{$value->bobot}}" hidden>{{$value->bobot}}</div>
                                <div class="col-3">
                                    <select class="form-control nilaidisiplin" name="nilaidisiplin[]" data-id="{{ $value->id }}" id="nilaidisiplin-{{$value->id}}" value="" required>
                                        <option value=""></option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control jumlahdisiplin" id="jumlahdisiplin-{{$value->id}}"
                                        name="jumlahdisiplin[]" value="" disabled>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" id="disiplin"
                                        class="form-control btn btn-primary w-100">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="navattitude" role="tabpanel" aria-labelledby="nav-attitude-tab">
                        <div class="row pb-3">
                            <div class="col-3">Faktor</div>
                            <div class="col-3">Bobot</div>
                            <div class="col-3">Nilai</div>
                            <div class="col-3">Jumlah</div>
                        </div>
                        <form id="formattitude">
                            @foreach($attitude as $value)
                            <div class="row pb-3">
                                <div class="col-3"><input type="text" id="faktorid-{{$value->id}}"
                                        name="faktoridattitude[]" value="{{$value->id}}" hidden>{{$value->faktor}}</div>
                                <div class="col-3"><input type="text" id="bobotattitude-{{$value->id}}" name="bobotattitude[]"
                                        value="{{$value->bobot}}" hidden>{{$value->bobot}}</div>
                                <div class="col-3">
                                    <select class="form-control nilaiattitude" name="nilaiattitude[]" data-id="{{ $value->id }}" id="nilaiattitude-{{ $value->id }}">
                                        <option value=""></option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="jumlahattitude-{{$value->id}}"
                                        name="jumlahattitude[]" value="" disabled>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" id="btnattitude"
                                        class="form-control btn btn-primary w-100">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row pb-3 border-bottom border-dark">
                            <div class="col-12">
                                Keterangan nilai huruf :
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-4">
                                <p>305 - 380 : Baik Sekali (BS)</p>
                                <p>298 - 304 : Baik (B)</p>
                                <p>228 - 297 : Cukup (C)</p>
                                <p>0 - 227 : Kurang (D)</p>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary btn-lg w-100" id="na-close" disabled></button>
                                <br>
                                <br>
                                <button class="btn btn-primary btn-lg w-100" id="nc-close" disabled></button>
                            </div>
                            <div class="col-4 text-center">
                                Status Dokumen :
                                <br>
                                <br>
                                <button class="btn btn-success btn-lg w-50">close</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media screen and (min-width: 768px) {
        #myModal .modal-dialog {
            width: 70%;
            border-radius: 5px;
        }
    }
</style>
<script>
    $(function () {
        table = $('#manage_all').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/allPenilaian',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'faktor',
                    name: 'faktor'
                },
                {
                    data: 'kriteria',
                    name: 'kriteria'
                },
                {
                    data: 'nilai0',
                    name: 'nilai0'
                },
                {
                    data: 'nilai1',
                    name: 'nilai1'
                },
                {
                    data: 'nilai2',
                    name: 'nilai2'
                },
                {
                    data: 'nilai4',
                    name: 'nilai4'
                },
                {
                    data: 'nilai5',
                    name: 'nilai5'
                },
                {
                    data: 'action',
                    name: 'action',
                    className:'action'
                }
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


    function createFaktor() {

        $("#modal_data").empty();
        $('.modal-title').text('Tambah Faktor & Kriteria'); // Set Title to Bootstrap modal title

        $.ajax({
            type: 'GET',
            url: 'kinerja/create',
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
        $('.modal-title').text('Edit Faktor'); // Set Title to Bootstrap modal title

        var id = $(this).attr('id');

        $.ajax({
            url: 'kinerja/' + id + '/edit',
            type: 'get',
            success: function (data) {
                $("#modal_data").html(data.html);
                $('#myModal').modal('show'); // show bootstrap modal
            },
            error: function (result) {
                // console.log(result);
                $("#modal_data").html("Sorry Cannot Load Data");
            }
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#department option:first"). attr('disabled','true'); 
        $("#name option:first"). attr('disabled','true'); 
        
        ///////////////////////////////////////////////////////

        $('#forminputkinerja').hide();
        // GET DATA SEKSI (HR)
        $('#department').change(function () {
            var depid = $(this).val();
            // console.log(depid);
            $("input[name='namaAtasan']").val("");
            $("input[name='pkk_number']").val("Check dokumen status!");
            $("#NIP").val("");
            $("#jabatan").val("");
            $('#forminputkinerja').hide();
            $('#infostatus').hide();
            $("select[name='seksi']").html("<option selected disabled>--Select Seksi--</option>");
            $("select[name='name']").html("<option selected disabled>--Select User--</option>");
            $.ajax({
                url: '/api/v1/getSeksiByDept/'+ depid,
                method: 'get',
                type: 'json',
                success: function (result) {
                    // console.log(result.dataSeksi);
                    $("input[name='namaAtasan']").val(result.leaderDept[0]['leader_team_name']);
                    if(result.dataSeksi.length === 0){
                        $("select[name='seksi']").html("<option selected disabled >--Select Seksi--</option>");
                        $("select[name='name']").html("<option selected disabled>--Select User--</option>");
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

        // GET DATA USER (HR)
        $('#seksi').change(function () {
            var seksiid = $(this).val();
            $("#NIP").val("");
            $("#jabatan").val("");
            $('#forminputkinerja').hide();
            $('#infostatus').hide();
            $("select[name='name']").html("<option selected disabled>--Select User--</option>");
            $.ajax({
                url: '/api/v1/getUserBySeksi/'+ seksiid,
                method: 'get',
                type: 'json',
                success: function (result) {
                    // console.log(result.dataUser);
                    if(result.dataUser.length === 0){
                        $("select[name='name']").html("<option selected disabled>--Select User--</option>");
                    }else{
                        $.each(result.dataUser,function(key, value)
                        {
                            // console.log(result["name"]);
                            $("select[name='name']").append('<option value="' + value["id"] + '">' + value["name"] + '</option>');
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
        });

        // GET DATA USER DETAIL (HR) 
        $('#name').change(function () {
            var userid = $(this).val();
            $.ajax({
                url: '/api/v1/getUserDetail/'+ userid,
                method: 'get',
                type: 'json',
                success: function (result) {
                    $('#forminputkinerja').hide();
                    $('#infostatus').hide();
                    // console.log(result);
                    $("#NIP").val(result.dataUserDetail[0]['NIP']);
                    $("#jabatan").val(result.dataUserDetail[0]['jabatan']);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
        });
      
        @if(Auth::user()->role->model_type == "Karyawan" || Auth::user()->role->model_type == "Atasan Langsung")
            var table = $('#manage_all').DataTable();

            table.column( 8 ).visible( false );
            // HIT API NAMA ATASAN
            var depid = $("#departement").attr("data-id");
            // console.log(depid);
            $.ajax({
                url: '/api/v1/getSeksiByDept/'+ depid,
                method: 'get',
                type: 'json',
                success: function (result) {
                   
                    $("input[name='namaAtasan']").val(result.leaderDept[0]['leader_team_name']);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });

              // HIT API USER DEtAIL FOR KARYAWAN
            @if(Auth::user()->role->model_type == "Karyawan")
            var userid = $("#name").attr("data-id");
            @elseif(Auth::user()->role->model_type == "Atasan Langsung")
            var userid = $("#name").find(':selected').data('id');
            @endif

            $.ajax({
                url: '/api/v1/getUserDetail/'+ userid,
                method: 'get',
                type: 'json',
                success: function (result) {
                    $('#forminputkinerja').hide();
                    $('#infostatus').hide();
                    // console.log(result);
                    $("#NIP").val(result.dataUserDetail[0]['NIP']);
                    $("#jabatan").val(result.dataUserDetail[0]['jabatan']);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });

        @else

        $(".fnk").show();
        
        @endif

        // FUNCION LOGIC RELOAD STATUS
        function reloadStatus(result){
                           
                    if(result['SK'] == "close" && result['SD'] == "close" && result['SA'] == "close"){
                        $("#nav-nilai-akhir").removeClass('disabled');
                        $('#na-close').text(result['nilaiAkhir']);

                        if($('#na-close').text() <= 227){
                            $('#nc-close').text("Kurang (D)");
                        }else if($('#na-close').text() <= 297 && $('#na-close').text() >= 228){
                            $('#nc-close').text("Cukup (C)");
                        }else if($('#na-close').text() <= 304 && $('#na-close').text() >= 298){
                            $('#nc-close').text("Baik (B)");
                        }else if($('#na-close').text() <= 380 && $('#na-close').text() >= 305){
                            $('#nc-close').text("Baik Sekali (BS)");
                        }
                    }else{
                        $("#nav-nilai-akhir").addClass('disabled');
                    }

                    if("{!! Auth::user()->role->model_type !!}" == "Atasan Langsung"){
                        if("{!! Auth::user()->id !!}" == $("#name").val()){
                            $("#kemampuankerja").hide();
                            $("#disiplin").hide();
                            $("#btnattitude").hide();
                            if(result['SK'] == "open" || result['SD'] == "open" || result['SA'] == "open"){
                                $(".card-penilaian").hide();
                                $(".card-penilaian-kosong").show()
                            }
                        }else{
                        
                                $("#nav-profile-tab").addClass("disabled");
                            
                        }
                    }else if("{!! Auth::user()->role->model_type !!}" == "Karyawan"){
                        if("{!! Auth::user()->name !!}" == $("#name").val()){
                            $(".nilaikk").prop("disabled", true);
                            $(".nilaidisiplin").prop("disabled", true);
                            $(".nilaiattitude").prop("disabled", true);
                            $("#kemampuankerja").hide();
                            $("#disiplin").hide();
                            $("#btnattitude").hide();
                            if(result['SK'] == "open" || result['SD'] == "open" || result['SA'] == "open"){
                                $(".card-penilaian").hide();
                                $(".card-penilaian-kosong").show()
                            }
                        }
                    }

                    if(result['SK'] == "open"){
                        $(".SK").removeClass('btn-success');
                        $(".SK").addClass('btn-primary');
                    }else{
                        $(".SK").removeClass('btn-primary');
                        $(".SK").addClass('btn-success');
                    }

                    if(result['SD'] == "open"){
                        $(".SD").removeClass('btn-success');
                        $(".SD").addClass('btn-primary');
                    }else{
                        $(".SD").removeClass('btn-primary');
                        $(".SD").addClass('btn-success');
                    }

                    if(result['SA'] == "open"){
                        $(".SA").removeClass('btn-success');
                        $(".SA").addClass('btn-primary');
                    }else{
                        $(".SA").removeClass('btn-primary');
                        $(".SA").addClass('btn-success');
                    }
        }
        
        // CHECK DATA FIRST
        $("#check").click(function(event){
            @if(Auth::user()->role->model_type == "HR" || Auth::user()->role->model_type == "Atasan Langsung")
            var user_ternilai = $("#name").val();
            @elseif(Auth::user()->role->model_type == "Karyawan")
            var user_ternilai = $("#name").data("id");
            @endif
          
            var periodePenilaian = $("#periodePenilaian").val();
            var year = $("#year").val();
            var periode = periodePenilaian + year ;

            // console.log(periode);
            $.ajax({
                url: '/api/v1/checkStatus/'+ user_ternilai +"/"+ periode,
                method: 'get',
                type: 'json',
                success: function (result) {
                    $('#infostatus').show();
                    $('#forminputkinerja').show();
                    $(".card-penilaian-kosong").hide()
                    $(".card-penilaian").show();

                    reloadStatus(result);
                    // console.log(result['dataForm'][0]['kriteria']);
                    if(result['message'] != "GetNewForm"){
                        $.each(result.dataForm, function(index, result ){
                            
                            if(result.kriteria == "Kemampuan Kerja"){
                                
                                // console.log(result);
                                if($("#nilai-"+result.id).data("id") == result.id){
                                    $("#nilai-"+result.id).val(result.nilai)
                                    $("#jumlahkk-"+result.id).val(result.jumlah)
                                }
                            }
                            if(result.kriteria == "Disiplin"){
                                // console.log(result);
                                if($("#nilaidisiplin-"+result.id).data("id") == result.id){
                                    $("#nilaidisiplin-"+result.id).val(result.nilai)
                                    $("#jumlahdisiplin-"+result.id).val(result.jumlah)
                                }
                            }
                            if(result.kriteria == "Attitude"){
                                // console.log(result);
                                if($("#nilaiattitude-"+result.id).data("id") == result.id){
                                    $("#nilaiattitude-"+result.id).val(result.nilai)
                                    $("#jumlahattitude-"+result.id).val(result.jumlah)
                                }
                            }
                        });
                    }else{
                        $('.nilaikk').val("");
                        $('.jumlahkk').val("");
                        $('.nilaidisiplin').val("");
                        $('.jumlahdisiplin').val("");
                        $('.nilaiattitude').val("");
                        $('.jumlahattitude').val("");
                        // console.log("here");
                    }
                   
                    // if(result['dataForm']['kriteria'] == "")

                    $('#nilaiAkhir').val(result['nilaiAkhir']);

                    pkk_number = ('000' + result['pkk_number']).substr(-3)
                    $('#pkkNumber').val("pkk"+pkk_number);
                    swal("Done!", "Successfully Check Status", "success");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    swal("Error check status!", "Try again", "error");
                }
            });
            
        });

        // YEAR & PERIODE SETTING 

        var year = $("#year").val();
        $('#periodePenilaian option[value="Q1"]').text("Q1 " + year);
        $('#periodePenilaian option[value="Q2"]').text("Q2 " + year);
        $('#periodePenilaian option[value="Q3"]').text("Q3 " + year);
        $('#periodePenilaian option[value="Q4"]').text("Q4 " + year);

        $("#year").change(function () {
            var yearChange = $("#year option:selected").text();
            $('#periodePenilaian option[value="Q1"]').text("Q1 " + yearChange);
            $('#periodePenilaian option[value="Q2"]').text("Q2 " + yearChange);
            $('#periodePenilaian option[value="Q3"]').text("Q3 " + yearChange);
            $('#periodePenilaian option[value="Q4"]').text("Q4 " + yearChange);
            $('#forminputkinerja').hide();
            $('#infostatus').hide();
        });

        $("#periodePenilaian").change(function () {
            $('#forminputkinerja').hide();
            $('#infostatus').hide();
        });

        $('.nilaikk').change(function () {
            var dataid = $(this).data("id");
            var bobotHitung = $("#bobot-" + dataid).val();
            var nilaiHitung = $("#nilai-" + dataid).val();
            var jumlahHitung = bobotHitung * nilaiHitung;
            $("#jumlahkk-" + dataid).val(jumlahHitung);
            // console.log(jumlahHitung);
        });

        $('.nilaidisiplin').change(function () {
            var dataid = $(this).data("id");
            var bobotHitung = $("#bobotdisiplin-" + dataid).val();
            var nilaiHitung = $("#nilaidisiplin-" + dataid).val();
            var jumlahHitung = bobotHitung * nilaiHitung;
            $("#jumlahdisiplin-" + dataid).val(jumlahHitung);
            // console.log(jumlahHitung);
        });

        $('.nilaiattitude').change(function () {
            var dataid = $(this).data("id");
            var bobotHitung = $("#bobotattitude-" + dataid).val();
            var nilaiHitung = $("#nilaiattitude-" + dataid).val();
            var jumlahHitung = bobotHitung * nilaiHitung;
            $("#jumlahattitude-" + dataid).val(jumlahHitung);
            // console.log(jumlahHitung);
        });

        // CHECK FORM VALUE CANNOT BE NULL
        function checkValue(arr) {
            return arr.every(el => el !== "");
        }

        // POST API KEMAMPUAN KERJA AJAX CALL

        $('#kemampuankerja').click(function () {
            var pkk_number = $("#pkkNumber").val();
            var user_ternilai = $("#name").val();
            var user_penilai = $("#user_id_penilai").val();
            var year = $("#year").val();
            var periode = $("#periodePenilaian").val();

            var faktorid = [];
            $('input[name="faktoridkk[]"]').each(function () {
                faktorid.push(this.value);
            });

            var bobotkk = [];
            $('input[name="bobotkk[]"]').each(function () {
                bobotkk.push(this.value);
            });

            var nilaikk = [];
            $('select[name="nilaikk[]"]').each(function () {
                nilaikk.push(this.value);
            });

            var jumlahkk = [];
            $('input[name="jumlahkk[]"]').each(function () {
                jumlahkk.push(this.value);
            });

            var nilaiAkhir = $('#nilaiAkhir').val();

            totalNilaiAkhir = 0;
            $('input[name="jumlahkk[]"]').each(function(){
                    var na = parseInt($(this).val()); // to get the stock count
                    totalNilaiAkhir += na; // calculate total Stocks
            });

            if(nilaiAkhir == ""){
                nilaiAkhirFinal = totalNilaiAkhir;
            }else{
                nilaiAkhirFinal = parseInt(nilaiAkhir)+totalNilaiAkhir
            }

            // console.log(nilaiAkhir);

            if(checkValue(nilaikk) == false){
                swal("Error Submit Form!", "Your Input cannot be null", "error");
            }else{
                swal({
                title: "Are you sure with the score?",
                text: "Data will store to database!!",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Submit",
                cancelButtonText: "Cancel"
                }, function () {
                    $.ajax({
                        url: '/api/v1/storeNilai',
                        data: {
                            "pkk_number": pkk_number,
                            "user_id_ternilai": user_ternilai,
                            "user_id_penilai": user_penilai,
                            "faktor_id": faktorid,
                            "bobot": bobotkk,
                            "nilai": nilaikk,
                            "jumlah": jumlahkk,
                            "tahun": year,
                            "periode": periode +year,
                            "nilaiAkhir": nilaiAkhirFinal,
                            "status_kk" : "close"
                        },
                        method: 'post',
                        type: 'json',
                        success: function (result) {
                            // console.log("sukses post kemampuan kerja");
                            // console.log(result);
                            swal({
                                title: "Done!", 
                                text: "Successfully submit", 
                                type: "success"
                                },
                            function(){ 
                                $(".SK").removeClass('btn-primary');
                                $(".SK").addClass('btn-success');
                                $("html").scrollTop(0);
                            });
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log(xhr);
                        }
                    });
                });
                
            }
            
        });

        // POST API DISIPLIN AJAX CALL

        $('#disiplin').click(function () {
            var pkk_number = $("#pkkNumber").val();
            var user_ternilai = $("#name").val();
            var user_penilai = $("#user_id_penilai").val();
            var year = $("#year").val();
            var periode = $("#periodePenilaian").val();

            var faktorid = [];
            $('input[name="faktoriddisiplin[]"]').each(function () {
                faktorid.push(this.value);
            });

            var bobotdisiplin = [];
            $('input[name="bobotdisiplin[]"]').each(function () {
                bobotdisiplin.push(this.value);
            });

            var nilaidisiplin = [];
            $('select[name="nilaidisiplin[]"]').each(function () {
                nilaidisiplin.push(this.value);
            });

            var jumlahdisiplin = [];
            $('input[name="jumlahdisiplin[]"]').each(function () {
                jumlahdisiplin.push(this.value);
            });

            var nilaiAkhir = $('#nilaiAkhir').val();

            totalNilaiAkhir = 0;
            $('input[name="jumlahdisiplin[]"]').each(function(){
                    var na = parseInt($(this).val()); // to get the stock count
                    totalNilaiAkhir += na; // calculate total Stocks
            });

            if(nilaiAkhir == ""){
                nilaiAkhirFinal = totalNilaiAkhir;
            }else{
                nilaiAkhirFinal = parseInt(nilaiAkhir)+totalNilaiAkhir
            }


            if(checkValue(nilaidisiplin) == false){
                swal("Error Submit Form!", "Your Input cannot be null", "error");
            }else{
                swal({
                    title: "Are you sure with the score?",
                    text: "Data will store to database!!",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Submit",
                    cancelButtonText: "Cancel"
                    }, function () {
                        
                        $.ajax({
                            url: '/api/v1/storeNilai',
                            data: {
                                "pkk_number": pkk_number,
                                "user_id_ternilai": user_ternilai,
                                "user_id_penilai": user_penilai,
                                "faktor_id": faktorid,
                                "bobot": bobotdisiplin,
                                "nilai": nilaidisiplin,
                                "jumlah": jumlahdisiplin,
                                "tahun": year,
                                "periode": periode +year,
                                "nilaiAkhir": nilaiAkhirFinal,
                                "status_disiplin" : "close"
                            },
                            method: 'post',
                            type: 'json',
                            success: function (result) {
                                // console.log("sukses post disiplin");
                                // console.log(result);
                                swal({
                                    title: "Done!", 
                                    text: "Successfully submit", 
                                    type: "success"
                                    },
                                function(){ 
                                    $(".SD").removeClass('btn-primary');
                                    $(".SD").addClass('btn-success');
                                    $("html").scrollTop(0);
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                console.log(xhr);
                            }
                        });

                    });
            }
            
        });

        // POST API ATTITUDE AJAX CALL

        $('#btnattitude').click(function () {
            var pkk_number = $("#pkkNumber").val();
            var user_ternilai = $("#name").val();
            var user_penilai = $("#user_id_penilai").val();
            var year = $("#year").val();
            var periode = $("#periodePenilaian").val();

            var faktorid = [];
            $('input[name="faktoridattitude[]"]').each(function () {
                faktorid.push(this.value);
            });

            var bobotattitude = [];
            $('input[name="bobotattitude[]"]').each(function () {
                bobotattitude.push(this.value);
            });

            var nilaiattitude = [];
            $('select[name="nilaiattitude[]"]').each(function () {
                nilaiattitude.push(this.value);
            });

            var jumlahattitude = [];
            $('input[name="jumlahattitude[]"]').each(function () {
                jumlahattitude.push(this.value);
            });

            var nilaiAkhir = $('#nilaiAkhir').val();

            totalNilaiAkhir = 0;
            $('input[name="jumlahattitude[]"]').each(function(){
                    var na = parseInt($(this).val()); // to get the stock count
                    totalNilaiAkhir += na; // calculate total Stocks
             });

            if(nilaiAkhir == ""){
                nilaiAkhirFinal = totalNilaiAkhir;
            }else{
                nilaiAkhirFinal = parseInt(nilaiAkhir)+totalNilaiAkhir
            }

            
            // console.log(totalNilaiAkhir);

            if(checkValue(nilaiattitude) == false){
                swal("Error Submit Form!", "Your Input cannot be null", "error");
            }else{
                swal({
                    title: "Are you sure with the score?",
                    text: "Data will store to database!!",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Submit",
                    cancelButtonText: "Cancel"
                    }, function () {
                        $.ajax({
                            url: '/api/v1/storeNilai',
                            data: {
                                "pkk_number": pkk_number,
                                "user_id_ternilai": user_ternilai,
                                "user_id_penilai": user_penilai,
                                "faktor_id": faktorid,
                                "bobot": bobotattitude,
                                "nilai": nilaiattitude,
                                "jumlah": jumlahattitude,
                                "tahun": year,
                                "periode": periode +year,
                                "nilaiAkhir": nilaiAkhirFinal,
                                "status_attitude" : "close"
                            },
                            method: 'post',
                            type: 'json',
                            success: function (result) {
                                // console.log("sukses post attitude");
                                swal({
                                    title: "Done!", 
                                    text: "Successfully submit", 
                                    type: "success"
                                    },
                                function(){ 
                                    $(".SA").removeClass('btn-primary');
                                    $(".SA").addClass('btn-success');
                                    $("html").scrollTop(0);
                                }
                                );
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                console.log(xhr);
                            }
                        });
                    });

                
            }
           
        });

        // Delete API AJAX CALL

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
                    url: '/admin/deleteFaktor/' + id,
                    type: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                        "Authorization": "Bearer {{ Cookie::get('access_token') }}",
                    },
                    "dataType": 'json',
                    success: function (data) {

                        if (data.type === 'success') {

                            swal("Done!", "Successfully Deleted", "success");
                            reload_table();

                        } else if (data.type === 'danger') {

                            swal("Error deleting!", "Try again", "error");

                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                        swal("Error deleting!", "Try again", "error");
                    }
                });
            });
        });
    });
</script>
@stop