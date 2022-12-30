<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Nilai as NilaiKaryawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class LaporanpkkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('backend.admin.laporanpkk.index');
    }

    public function indexLaporanPribadi()
    {
        
        return view('backend.admin.laporanpkk.index_pribadi');
    }

    public function getAll(Request $request)
    {
       
        // dd($LaporanpkkAtasanLangsung->unique());
        if ($request->ajax()) {
            $LaporanpkkAtasanLangsung = 
            DB::table('status_nilai_karyawan')->select('status_nilai_karyawan.id as id','status_nilai_karyawan.form_id as pkk_number','status_nilai_karyawan.nilai_akhir as nilai_akhir',
            'nilai_karyawan.tahun as tahun','nilai_karyawan.periode as periode','nilai_karyawan.user_id_ternilai as user_id','admins.name as nama_karyawan','admins.jabatan as jabatan','seksi_has_divisi.seksi_name as seksi','divisi.name_division as divisi')->where('nilai_karyawan.user_id_penilai',Auth::user()->id)
            ->join('nilai_karyawan', 'nilai_karyawan.form_id', '=', 'status_nilai_karyawan.form_id')
            ->join('admins','admins.id','=','nilai_karyawan.user_id_ternilai')
            ->join('user_has_seksi', 'user_has_seksi.user_id', '=', 'admins.id')
            ->join('divisi', 'divisi.id', '=', 'user_has_seksi.divisi_id')
            ->join('seksi_has_divisi', 'seksi_has_divisi.id', '=', 'user_has_seksi.seksi_id')->get();

            $laporanpkkAL = $LaporanpkkAtasanLangsung->unique();
            
            return Datatables::of($laporanpkkAL)
                ->addColumn('action', function ($laporanpkkAL) {
                    $html = '<div class="btn-group">';
                        $html .= '<a data-toggle="tooltip" id="' . $laporanpkkAL->id . '" class="btn btn-xs btn-primary mr-1 edit text-white" title="Edit"><i class="fa fa-edit"></i> </a>';
                        $html .= '<a data-toggle="tooltip" id="' . $laporanpkkAL->id . '" class="btn btn-xs btn-danger mr-1 delete text-white" title="Delete"><i class="fa fa-trash"></i> </a>';
                        $html .= '</div>';
                        return $html;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    public function getAllLaporanPribadi(Request $request)
    {
       
        // dd($LaporanpkkAtasanLangsung->unique());
        if ($request->ajax()) {
            $LaporanpkkAtasanLangsung = 
            DB::table('status_nilai_karyawan')->select('status_nilai_karyawan.id as id','status_nilai_karyawan.form_id as pkk_number','status_nilai_karyawan.nilai_akhir as nilai_akhir',
            'nilai_karyawan.tahun as tahun','nilai_karyawan.periode as periode','nilai_karyawan.user_id_ternilai as user_id','admins.name as nama_karyawan')->where('nilai_karyawan.user_id_ternilai',Auth::user()->id)
            ->join('nilai_karyawan', 'nilai_karyawan.form_id', '=', 'status_nilai_karyawan.form_id')
            ->join('admins','admins.id','=','nilai_karyawan.user_id_ternilai')->get();

            $laporanpkkAL = $LaporanpkkAtasanLangsung->unique();
            
            return Datatables::of($laporanpkkAL)
                ->addColumn('action', function ($laporanpkkAL) {
                    $html = '<div class="btn-group">';
                        $html .= '<a data-toggle="tooltip" id="' . $laporanpkkAL->id . '" class="btn btn-xs btn-primary mr-1 edit text-white" title="Edit"><i class="fa fa-edit"></i> </a>';
                        $html .= '<a data-toggle="tooltip" id="' . $laporanpkkAL->id . '" class="btn btn-xs btn-danger mr-1 delete text-white" title="Delete"><i class="fa fa-trash"></i> </a>';
                        $html .= '</div>';
                        return $html;
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
            $permission = Permission::get();
            $view = View::make('backend.admin.role.create', compact('permission'))->render();
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
            // Setup the validator
            $rules = [
                'name' => 'required|unique:roles',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            } else {
                $role = Role::create(['name' => $request->input('name')]);
                return response()->json(['type' => 'success', 'message' => "Successfully Created"]);
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if ($request->ajax()) {
            $haspermision = auth()->user()->can('role-view');
            if ($haspermision) {
                $role = Role::find($id);
                $permissions = $role->permissions()->get();
                $view = View::make('backend.admin.role.view', compact('role', 'permissions'))->render();
                return response()->json(['html' => $view]);
            } else {
                abort(403, 'Sorry, you are not authorized to access the page');
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
                $role = Role::findOrFail($id);
                $view = View::make('backend.admin.role.edit', compact('role'))->render();
                return response()->json(['html' => $view]);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if ($request->ajax()) {
            // Setup the validator
            $rules = [
                'name' => 'required|unique:roles,name,' . $role->id,
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            } else {

                $role = Role::findOrFail($role->id);
                $role->name = $request->input('name');
                $role->save();

                return response()->json(['type' => 'success', 'message' => "Successfully Created"]);
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $role = Role::findOrFail($id);
                $role->delete();
                return response()->json(['type' => 'success', 'message' => "Successfully Deleted"]);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }
}
