<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Divisi as Department;
use App\Models\Seksi as Seksi;
use App\Models\Penilaian as Penilaian;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use View;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\Admin as Admin;
use App\Models\Nilai as Nilai;
use App\Models\Status_nilai as Status;


class KinerjaController extends Controller
{
   /**
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    */

   public function index(Request $request)
   {
      //USERS DATA FOR FILTER
      $namaUser = Auth::user()->name;
      $NIP = Auth::user()->NIP;
      $jabatan = Auth::user()->jabatan;
      $usersid = Auth::user()->id;

      $userLoginRole = DB::select('SELECT roles.name as roleName FROM model_has_roles 
      JOIN `roles` ON model_has_roles.role_id = roles.id
      JOIN `admins` ON model_has_roles.model_id = admins.id
      WHERE model_id =' . $usersid);

      $department = DB::select("SELECT admins.id, admins.NIP, admins.name, seksi_has_divisi.seksi_name, divisi.name_division, divisi.leader_team_name as leader_name
      FROM `user_has_seksi` LEFT JOIN `admins` ON admins.id = user_has_seksi.user_id 
      JOIN `seksi_has_divisi` ON seksi_has_divisi.id = user_has_seksi.seksi_id 
      JOIN `divisi` ON divisi.id = seksi_has_divisi.divisi_id WHERE admins.id =  " . $usersid );


      $departmentList =  Department::pluck('name_division', 'id');
      $seksiList =  Seksi::pluck('seksi_name', 'id');

      $kemampuanKerja = Penilaian::Where("kriteria","Kemampuan Kerja")->get();
      $disiplin = Penilaian::Where("kriteria","Disiplin")->get();
      $attitude = Penilaian::Where("kriteria","Attitude")->get();
      
      if($userLoginRole[0]->roleName == "HR"){
         // $dataUser = []; 
         $dataUsers = DB::select("SELECT admins.id, admins.NIP,admins.jabatan, admins.name, seksi_has_divisi.seksi_name, divisi.name_division, divisi.leader_team_name as leader_name
         FROM `user_has_seksi` JOIN `admins` ON admins.id = user_has_seksi.user_id 
         JOIN `seksi_has_divisi` ON seksi_has_divisi.id = user_has_seksi.seksi_id 
         JOIN `divisi` ON divisi.id = seksi_has_divisi.divisi_id
         WHERE admins.id != ". $usersid);
         // $dataUser['id']  = $dataUser[0]->id;
         // $dataUser['name']  = $dataUser[0]->name;
         // $listUser = $dataUser;
         foreach($dataUsers as $listUser){
            $listUserfix['id'] = $listUser->id;
            $listUserfix['name'] = $listUser->name;
            $dataUser[] = $listUserfix;
         }
         // dd($dataUser);
      }else if($userLoginRole[0]->roleName == "Atasan Langsung"){
         $dataUsers = DB::select("SELECT admins.id, admins.NIP,admins.jabatan, admins.name, seksi_has_divisi.seksi_name, divisi.name_division, divisi.leader_team_name as leader_name
         FROM `user_has_seksi` LEFT JOIN `admins` ON admins.id = user_has_seksi.user_id 
         JOIN `seksi_has_divisi` ON seksi_has_divisi.id = user_has_seksi.seksi_id 
         JOIN `divisi` ON divisi.id = seksi_has_divisi.divisi_id
         WHERE divisi.name_division ='$department[0]->name_division'
         AND WHERE admins.id != ". $usersid);

         foreach($dataUsers as $listUser){
            $listUserfix['id'] = $listUser->name;
            $listUserfix['name'] = $listUser->name;
            $dataUser[] = $listUserfix;
         }
      }else{
         $dataUsers = DB::select("SELECT admins.id, admins.NIP,admins.jabatan, admins.name, seksi_has_divisi.seksi_name, divisi.name_division, divisi.leader_team_name as leader_name
         FROM `user_has_seksi` JOIN `admins` ON admins.id = user_has_seksi.user_id 
         JOIN `seksi_has_divisi` ON seksi_has_divisi.id = user_has_seksi.seksi_id 
         JOIN `divisi` ON divisi.id = seksi_has_divisi.divisi_id");
         // $dataUser['id']  = $dataUser[0]->id;
         // $dataUser['name']  = $dataUser[0]->name;
         // $listUser = $dataUser;
         foreach($dataUsers as $listUser){
            $listUserfix['id'] = $listUser->id;
            $listUserfix['name'] = $listUser->name;
            $dataUser[] = $listUserfix;
         }
      }

      // dd($penilai);

      return view('backend.admin.kinerja.index', ['usersID'=>$usersid,'userRole'=>$userLoginRole[0]->roleName ,'namaUser' => $namaUser,'NIP' => $NIP,'jabatan'=> $jabatan, 
      'department'=>$department,'departmentList'=>$departmentList,'seksiList'=>$seksiList,'dataUser'=>$dataUser,'kemampuanKerja'=>$kemampuanKerja,'disiplin'=>$disiplin,'attitude'=>$attitude]);
   }

   public function getAll(Request $request)
   {

      if ($request->ajax()) {        

         $penilaian = Penilaian::get();
         return Datatables::of($penilaian)
             ->addColumn('action', function ($penilaian) {
                 $html = '<div class="btn-group">';
                 $html .= '<a data-toggle="tooltip" id="' .$penilaian->id . '" class="btn btn-xs btn-primary mr-1 edit text-white" title="Edit"><i class="fa fa-edit"></i> </a>';
                 $html .= '<a data-toggle="tooltip" id="' . $penilaian->id . '" class="btn btn-xs btn-danger mr-1 delete text-white" title="Delete"><i class="fa fa-trash"></i> </a>';
                 $html .= '</div>';
                 return $html;
                 return "<a class='btn btn-danger text-white'>Disabled</a>";
             })
             ->rawColumns(['action'])
             ->addIndexColumn()
             ->make(true);
     } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
     }
   }

   /**
    * Show the form for creating a new resource.
    * @return \Illuminate\Http\Response
    */
   public function create(Request $request)
   {
      if ($request->ajax()) {
         $view = View::make('backend.admin.kinerja.create')->render();
         return response()->json(['html' => $view]);
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    *
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      if ($request->ajax()) {
         $rules = [
            'faktor' => 'required|unique:kriteria_faktor_penilaian,faktor',
            'kriteria' => 'required',
            'bobot' => 'required',
          ];

          $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
             return response()->json([
               'type' => 'error',
               'errors' => $validator->getMessageBag()->toArray()
             ]);
          } else {
             $penilaian = Penilaian::create(['kriteria' => $request->input('kriteria'),
             'faktor' => $request->input('faktor'), 'bobot' => $request->input('bobot'), 'nilai0' => $request->input('nilai0'), 'nilai1' => $request->input('nilai1'),
             'nilai2' => $request->input('nilai2'), 'nilai4' => $request->input('nilai4'), 'nilai5' => $request->input('nilai5')]);
             return response()->json(['type' => 'success', 'message' => "Successfully Created"]);
          }
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\Blog $blog
    *
    * @return \Illuminate\Http\Response
    */
   public function show(Request $request, Blog $blog)
   {
      if ($request->ajax()) {
         $view = View::make('backend.admin.blog.view', compact('blog'))->render();
         return response()->json(['html' => $view]);
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Blog $blog
    *
    * @return \Illuminate\Http\Response
    */
   public function edit(Request $request, Blog $blog)
   {
      if ($request->ajax()) {
         $view = View::make('backend.admin.blog.edit', compact('blog'))->render();
         return response()->json(['html' => $view]);
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  \App\Models\Blog $blog
    *
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Blog $blog)
   {
      if ($request->ajax()) {
         $haspermision = auth()->user()->can('blog-edit');
         if ($haspermision) {

            $rules = [
              'title' => 'required',
              'photo' => 'max:2048|dimensions:max_width=2000,max_height=1000', // 2mb
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
               return response()->json([
                 'type' => 'error',
                 'errors' => $validator->getMessageBag()->toArray()
               ]);
            } else {

               if ($request->hasFile('photo')) {
                  $extension = Input::file('photo')->getClientOriginalExtension();;
                  if ($extension == "jpg" || $extension == "jpeg" || $extension == "png") {
                     if (Input::file('photo')->isValid()) {
                        $destinationPath = 'assets/images/blog'; // upload path
                        $extension = Input::file('photo')->getClientOriginalExtension(); // getting image extension
                        $fileName = time() . '.' . $extension; // renameing image
                        $file_path = 'assets/images/blog/' . $fileName;
                        Input::file('photo')->move($destinationPath, $fileName); // uploading file to given path
                        $upload_ok = 1;

                     } else {
                        return response()->json([
                          'type' => 'error',
                          'message' => "<div class='alert alert-warning'>File is not valid</div>"
                        ]);
                     }
                  } else {
                     return response()->json([
                       'type' => 'error',
                       'message' => "<div class='alert alert-warning'>Error! File type is not valid</div>"
                     ]);
                  }
               } else {
                  $upload_ok = 1;
                  $file_path = $request->input('SelectedFileName');
               }

               if ($upload_ok == 0) {
                  return response()->json([
                    'type' => 'error',
                    'message' => "<div class='alert alert-warning'>Sorry Failed</div>"
                  ]);
               } else {
                  $blog = Blog::findOrFail($blog->id);
                  $blog->title = $request->input('title');
                  $blog->description = $request->input('description');
                  $blog->category = $request->input('category');
                  $blog->uploaded_by = auth()->user()->id;
                  $blog->file_path = $file_path;
                  $blog->status = $request->input('status');
                  $blog->save(); //
                  return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);
               }
            }
         } else {
            abort(403, 'Sorry, you are not authorized to access the page');
         }
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Blog $blog
    *
    * @return \Illuminate\Http\Response
    */
   public function deleteFaktor(Request $request, $id)
   {
      if ($request->ajax()) {
         $penilaian = Penilaian::findOrFail($id);
         $penilaian->delete();
         return response()->json(['type' => 'success', 'message' => 'Successfully Deleted']);
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
   }

   public function storeNilai(Request $request)
   {
      if ($request) {
         $rules = [
            'user_id_ternilai' => 'required',
            'user_id_penilai' => 'required',
            'faktor_id' => 'required',
            'bobot' => 'required',
            'nilai' => 'required',
            'jumlah' => 'required',
            'tahun' => 'required',
            'periode' => 'required',
          ];

          $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
             return response()->json([
               'type' => 'error',
               'errors' => $validator->getMessageBag()->toArray()
             ]);
          } else {
         foreach($request->input('faktor_id') as $key => $value) {

               $Record = new Nilai;
               $Record->form_id = $request->input('pkk_number');
               $Record->user_id_ternilai = $request->input('user_id_ternilai');
               $Record->user_id_penilai = $request->input('user_id_penilai');
               $Record->faktor_id = $request->get('faktor_id')[$key];
               $Record->bobot = $request->get('bobot')[$key];
               $Record->nilai =$request->get('nilai')[$key]; 
               $Record->jumlah =$request->get('jumlah')[$key];
               $Record->tahun = $request->input('tahun');
               $Record->periode =$request->input('periode');
   
               $Record->save();
         }
         
            $checkStatus = Status::Where("form_id", $request->input('pkk_number'))->first();
            if($checkStatus->count() != 0){
               $Status_record = $checkStatus;
               if($request->input('status_kk') != ""){
                  $Status_record->status_kemampuan_kerja =$request->input('status_kk');
               }else if($request->input('status_disiplin') != ""){
                  $Status_record->status_disiplin =$request->input('status_disiplin');
               }else if($request->input('status_attitude') != ""){
                  $Status_record->status_attitude =$request->input('status_attitude');
               }
      
               $Status_record->save();

               return response()->json(['type' => 'success', 'message' => "Successfully Created", 'ck' => $checkStatus->count() , 'cks' => "update" ]);
            }else{
               $Status_record = new Status;
               $Status_record->user_id_ternilai = $request->input('user_id_ternilai');
               $Status_record->form_id =$request->input('pkk_number');
               if($request->input('status_kk') != ""){
                  $Status_record->status_kemampuan_kerja =$request->input('status_kk');
               }else if($request->input('status_disiplin') != ""){
                  $Status_record->status_disiplin =$request->input('status_disiplin');
               }else if($request->input('status_attitude') != ""){
                  $Status_record->status_attitude =$request->input('status_attitude');
               }
      
               $Status_record->save();

               return response()->json(['type' => 'success', 'message' => "Successfully Created", 'ck' => $checkStatus->count() ,'cks' => "insert" ]);
            }
         

         }
      } else {
         return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
      }
   }

   public function checkStatus(Request $request, $userid, $periode)
   {
      
      if ($userid == "" && $periode == "" ) {
         return response()->json([
           'type' => 'error',
           'errors' => "userid not found"
         ]);
      } else {
     
     
         $status_dokumen_user = DB::select("SELECT status_nilai_karyawan.form_id, status_kemampuan_kerja as sk, status_disiplin as sd, status_attitude as sa FROM status_nilai_karyawan 
         JOIN nilai_karyawan ON nilai_karyawan.form_id = status_nilai_karyawan.form_id
         WHERE status_nilai_karyawan.user_id_ternilai = $userid
         AND nilai_karyawan.periode = '$periode'");

        if($status_dokumen_user == null){
           $status_dokumen_all = Status::all(); 
           $generatePKK = $status_dokumen_all->count()+1;
           $statusNew = "open";
           return response()->json(['type' => 'success', 'message' => "Successfully Created", 'pkk_number' => $generatePKK,
           'SK' => $statusNew, 'SD' => $statusNew,'SA' => $statusNew]);
        }else{
            // $status_form = DB::select("SELECT status_kemampuan_kerja, status_disiplin, status_attitude FROM status_nilai_karyawan");
           return response()->json(['type' => 'success', 'message' => "Successfully Created", 'pkk_number' => $status_dokumen_user[0]->form_id,
           'SK' => $status_dokumen_user[0]->sk, 'SD' => $status_dokumen_user[0]->sd,'SA' => $status_dokumen_user[0]->sa]);
        }
     
     }
   }

   public function getSeksiByDept(Request $request, $depid)
   {
      
      if ($depid == "") {
         return response()->json([
           'type' => 'error',
           'errors' => "deptid not found"
         ]);
      } else {
         $getSeksi = Seksi::Where("divisi_id",$depid)->get();
         $leaderDept = Department::Where("id",$depid)->get();

        if(isset($getSeksi)){
           return response()->json(['type' => 'success', 'message' => "Successfully get seksi", 'leaderDept' => $leaderDept, 'dataSeksi' => $getSeksi]);
        }else{
         return response()->json(['type' => 'success', 'message' => "get seksi failed", 'error' => $getSeksi]);
        }
     
     }
   }

   public function getUserBySeksi(Request $request, $seksiid)
   {
      
      if ($seksiid == "") {
         return response()->json([
           'type' => 'error',
           'errors' => "seksi id not found"
         ]);
      } else {
         $getUser = DB::select("SELECT admins.id, admins.name FROM user_has_seksi 
         JOIN admins ON admins.id = user_has_seksi.user_id
         WHERE user_has_seksi.seksi_id =" . $seksiid);

        if(isset($getUser)){
           return response()->json(['type' => 'success', 'message' => "Successfully get list user", 'dataUser' => $getUser]);
        }else{
         return response()->json(['type' => 'success', 'message' => "get list user failed", 'error' => $getUser]);
        }
     
     }
   }

   public function getUserDetail(Request $request, $userid)
   {
      
      if ($userid == "") {
         return response()->json([
           'type' => 'error',
           'errors' => "user id not found"
         ]);
      } else {
         $getUserDetail = DB::select("SELECT id, name, jabatan, NIP FROM admins 
         WHERE id =" . $userid);

        if(isset($getUserDetail)){
           return response()->json(['type' => 'success', 'message' => "Successfully Created", 'dataUserDetail' => $getUserDetail]);
        }else{
         return response()->json(['type' => 'success', 'message' => "get detail user failed", 'error' => $getUserDetail]);
        }
     
     }
   }


}
