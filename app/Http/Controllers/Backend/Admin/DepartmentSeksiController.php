<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Divisi as Department;
use App\Models\Seksi as Seksi;
use App\Models\User as User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class DepartmentSeksiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.department_and_seksi.index');
    }

    public function getAllDepartment(Request $request)
    {
        if ($request->ajax()) {
            $department = Department::get();
            return Datatables::of($department)
                ->addColumn('action', function ($department) {
                    $html = '<div class="btn-group">';
                    $html .= '<a data-toggle="tooltip" id="' . $department->id . '" class="btn btn-xs btn-primary mr-1 edit text-white" title="Edit"><i class="fa fa-edit"></i> </a>';
                    $html .= '<a data-toggle="tooltip" id="' . $department->id . '" class="btn btn-xs btn-danger mr-1 delete text-white" title="Delete"><i class="fa fa-trash"></i> </a>';
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

    public function getAllSeksi(Request $request)
    {
        if ($request->ajax()) {

            $seksi = Seksi::get();
            return Datatables::of($seksi)
                ->addColumn('action', function ($seksi) {
                    $html = '<div class="btn-group">';
                    $html .= '<a data-toggle="tooltip" id="' . $seksi->id . '" class="btn btn-xs btn-primary mr-1 edit text-white" title="Edit"><i class="fa fa-edit"></i> </a>';
                    $html .= '<a data-toggle="tooltip" id="' . $seksi->id . '" class="btn btn-xs btn-danger mr-1 delete text-white" title="Delete"><i class="fa fa-trash"></i> </a>';
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
    public function createDepartment(Request $request)
    {
        $leader_team_name = DB::select('SELECT admins.id,admins.name FROM admins 
        JOIN `model_has_roles` ON model_has_roles.model_id = admins.id 
        WHERE model_has_roles.model_type != "Karyawan" ');

        if ($request->ajax()) {
            $view = View::make('backend.admin.department_and_seksi.create')->render();
            return response()->json(['html' => $view,'leader_team_name' => $leader_team_name]);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    public function createSeksi(Request $request)
    {
        $department_name = DB::select('SELECT id, name_division from divisi');

        $leader_seksi_name = DB::select('SELECT admins.id,admins.name FROM admins 
        JOIN `model_has_roles` ON model_has_roles.model_id = admins.id 
        WHERE model_has_roles.model_type != "Karyawan" ');

        if ($request->ajax()) {
            $view = View::make('backend.admin.department_and_seksi.createseksi')->render();
            return response()->json(['html' => $view,'leader_seksi_name' => $leader_seksi_name,'department_name' => $department_name]);
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
        if ($request->ajax() && $request->input('ds') == "department") {
            // Setup the validator
            $rulesDivisin = [
                'name_division' => 'required|unique:divisi,name_division',
                'leader_team_name' => 'required',
            ];

            $validator = Validator::make($request->all(), $rulesDivisin);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            } else {
                $department = Department::create(['name_division' => $request->input('name_division'),'leader_team_name' => $request->input('leader_team_name')]);
                return response()->json(['type' => 'success', 'message' => "Successfully Created"]);
            }
        } else if ($request->ajax() && $request->input('ds') == "seksi") {
             // Setup the validator
             $rulesDivisin = [
                'seksi_name' => 'required|unique:seksi_has_divisi,seksi_name',
            ];

            $validator = Validator::make($request->all(), $rulesDivisin);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            } else {
                $seksi = Seksi::create(['divisi_id' => $request->input('department_name'),'seksi_name' => $request->input('seksi_name'),'leader_seksi_name' => $request->input('leader_seksi_name')]);
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
                $view = View::make('backend.admin.department_and_seksi.view', compact('role', 'permissions'))->render();
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
            $leader_team_name = DB::select('SELECT admins.id,admins.name FROM admins 
            JOIN `model_has_roles` ON model_has_roles.model_id = admins.id 
            WHERE model_has_roles.model_type != "Karyawan" ');

            $department = Department::findOrFail($id);
            $view = View::make('backend.admin.department_and_seksi.edit', compact('department','leader_team_name'))->render();
            return response()->json(['html' => $view, 'departmentbyid' => $department,'leader_team_name' => $leader_team_name ]);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    public function editSeksi(Request $request, $id)
    {
        $seksi_name = DB::select('SELECT id, name_division from divisi where id =' . $id);

        $department_name = Department::pluck('name_division', 'id');

        $leader_seksi_name = User::pluck('name', 'name');
        
        if ($request->ajax()) {
            $seksi = Seksi::findOrFail($id);
            $view = View::make('backend.admin.department_and_seksi.editseksi', ['seksi'=> $seksi, 'seksi_name' => $seksi_name,'leader_seksi_name' => $leader_seksi_name,'department_name' => $department_name])->render();
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
    public function update(Request $request, Department $department, $id)
    {
        if ($request->ajax() && $request->input('ds') == "department") {
            // Setup the validator
            $rulesDivisin = [
                'name_division' => 'required',
                'leader_team_name' => 'required',
            ];

            $validator = Validator::make($request->all(), $rulesDivisin);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            } else {

                $department = Department::findOrFail($id);
                $department->name_division = $request->input('name_division');
                $department->leader_team_name = $request->input('leader_team_name');
                $department->save();

                return response()->json(['type' => 'success', 'message' => "Successfully Created"]);
            }
        } else if ($request->ajax() && $request->input('ds') == "seksi") {
            // Setup the validator
            $rulesDivisin = [
                'seksi_name' => 'required',
            ];

            $validator = Validator::make($request->all(), $rulesDivisin);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }  else {

                $seksi = Seksi::findOrFail($id);
                $seksi->divisi_id = $request->input('department_name');
                $seksi->seksi_name = $request->input('seksi_name');
                $seksi->leader_seksi_name = $request->input('leader_seksi_name');
                $seksi->save();

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

            $department = Department::findOrFail($id);
            $department->delete();
            return response()->json(['type' => 'success', 'message' => "Successfully Deleted"]);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    public function deleteSeksi(Request $request, $id)
    {
        if ($request->ajax()) {

            $department = Seksi::findOrFail($id);
            $department->delete();
            return response()->json(['type' => 'success', 'message' => "Successfully Deleted"]);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }
}
