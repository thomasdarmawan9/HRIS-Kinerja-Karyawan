<?php

namespace App\Http\Controllers\Backend\Admin;
use Auth;
use App\Models\Role as Role;
use App\Models\Admin as Admin;
use App\Models\Divisi as Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

use View;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        // $department_name = DB::table('divisi')->select('name_division','id')->get();
     
        return view('backend.admin.user.index');
    }

    public function getAll()
    {
        $can_edit = $can_delete = '';
        $users = Admin::all();
        return Datatables::of($users)
            ->addColumn('status', function ($users) {
                return $users->status ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('action', function ($user) use ($can_edit, $can_delete) {
                $html = '<div class="btn-group">';
                $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $user->id . '" class="btn btn-xs btn-primary mr-1 edit text-white" title="Edit"><i class="fa fa-edit"></i> </a>';
                $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $user->id . '" class="btn btn-xs btn-danger mr-1 delete text-white" title="Delete"><i class="fa fa-trash"></i> </a>';
                $html .= '</div>';
                return $html;
            })
            // ->rawColumns(['action', 'file_path', 'status'])
            ->rawColumns(['action', 'status'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $jabatan = DB::select('SELECT id, jabatan from roles');

        $department = DB::select('SELECT id, name_division from divisi');

        $seksi = DB::select('SELECT id, seksi_name from seksi_has_divisi');
      
        if ($request->ajax()) {
      
            $haspermision = Auth::guard('admin');
           
            if ($haspermision) {

                $view = View::make('backend.admin.user.create')->render();
                return response()->json(['html' => $view, 'jabatan' => $jabatan,  'department' => $department,  'seksi' => $seksi]);
            } else {
                abort(403, 'Sorry, you are not authorized to access the page');
            }
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
                'NIP' => 'required|unique:admins,NIP',
                'name' => 'required',
                'email' => 'required|email|unique:admins,email',
                'password' => 'required|same:confirm-password'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            } else {
                DB::beginTransaction();
                    try {

                        $admin = new Admin();
                        $admin->NIP = $request->input('NIP');
                        $admin->name = $request->input('name');
                        $admin->email = $request->input('email');
                        $admin->jabatan = $request->input('jabatan');
                        $admin->password = Hash::make($request->input('password'));

                        $create = $admin->save();

                        $lastInserID = $admin->id;
                        // DB::commit();
                        // return response()->json(['type' => 'success', 'message' => "Successfully Created"]);

                        $role = DB::SELECT('SELECT id, name FROM roles WHERE jabatan = "'. $request->input('jabatan'). '"');
    
                        DB::insert('INSERT INTO model_has_roles (role_id, model_type, model_id) values (?, ?, ?)', [$role[0]->id, $role[0]->name ,$lastInserID]);

                        if($request->input('department') != "" && $request->input('seksi') != ""){
                            
                            DB::insert('INSERT INTO user_has_seksi (user_id, seksi_id, divisi_id) values (?, ?, ?)', [$lastInserID, $request->input('seksi'), $request->input('department') ]);
    
                            DB::commit();

                            return response()->json(['type' => 'success', 'message' => "Successfully Created"]);
                        }else {
                            DB::commit();
                            return response()->json(['type' => 'success', 'message' => "Successfully Created User Need Update!"]);
                        }
                      
                        // return response()->json(['type' => 'success', 'message' => "Successfully Created"]);

                    } catch (\Exception $e) {
                        DB::rollback();
                        return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
                    }
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
            $user = User::findOrFail($id);
            $view = View::make('backend.admin.user.view', compact('user'))->render();
            return response()->json(['html' => $view]);
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
    public function edit($id, Request $request)
    {
        if ($request->ajax()) {
            $department_name = DB::table('divisi')->select('name_division','id')->get();
            $jabatan = DB::table('roles')->select('name','jabatan','id')->get();
            $department_user = DB::table('user_has_seksi')->select('divisi_id','seksi_id')->where('user_id',$id)->first();
            $user = Admin::findOrFail($id);
            $view = View::make('backend.admin.user.edit', compact('user','department_name','department_user','jabatan'))->render();
            return response()->json(['html' => $view,'department_name'=>$department_name]);
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
    public function update(Request $request, Admin $admin)
    {
        if ($request->ajax()) {

            Admin::find($admin->id);

            $rules = [
                'name' => 'required',
                'email' => 'required|email'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'error',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            } else {

                DB::beginTransaction();
                try {
                    $admin = Admin::find($request->input('id'));
                    $admin->NIP = $request->input('NIP');
                    $admin->jabatan = $request->input('jabatan');
                    $admin->name = $request->input('name');
                    $admin->email = $request->input('email');
                    $admin->status = $request->input('status');
                    $admin->password = Hash::make($request->password);
                    $admin->save();

                    $rolejabatan = $request->input('rolejabatan');
                    // $roleuser = Role::where('model_id',$request->input('id'))->first();
                    DB::statement("UPDATE model_has_roles SET role_id = ". $request->input('roleid').", model_type = '".$rolejabatan."' WHERE model_id = ".$request->input('id'));

                    if($request->input('department_name') != "" && $request->input('seksi') != ""){
                        $checkDS = DB::table("user_has_seksi")->where("user_id",$request->input('id'))->first();
                        if($checkDS == ""){
                            DB::insert('INSERT INTO user_has_seksi (user_id, seksi_id, divisi_id) values (?, ?, ?)', [$request->input('id'), $request->input('seksi'), $request->input('department_name') ]);
                            DB::commit();
                        }else{
                            DB::statement("UPDATE user_has_seksi SET user_id = ". $request->input('id') .", seksi_id = ". $request->input('seksi') . ", divisi_id = ". $request->input('department_name') ." WHERE user_id = ". $request->input('id'));
                            DB::commit();
                        }

                        return response()->json(['type' => 'success', 'message' => "Successfully Created"]);
                    }else{
                        DB::commit();
                        return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);
                    }
                   

                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
                }

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
    public function destroy($id, Request $request)
    {
        if ($request->ajax()) {
            // $user = Admin::findOrFail($id); //Get user with specified id
            // $user->delete();
            DB::table('admins')->where('id', $id)->delete();
            DB::table('user_has_seksi')->where('user_id', $id)->delete();
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            return response()->json(['type' => 'success', 'message' => "Successfully Deleted"]);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }
}
