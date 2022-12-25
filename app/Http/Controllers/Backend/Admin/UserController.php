<?php

namespace App\Http\Controllers\Backend\Admin;
use Auth;
use App\Models\Role;
use App\Models\Admin;
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
        return view('backend.admin.user.index');
    }

    public function getAll()
    {
        $can_edit = $can_delete = '';
        // if (!auth()->user()->can('user-edit')) {
        //     $can_edit = "style='display:none;'";
        // }
        // if (!auth()->user()->can('user-delete')) {
        //     $can_delete = "style='display:none;'";
        // }
        $users = Admin::all();
        return Datatables::of($users)
            // ->addColumn('file_path', function ($users) {
            //     return "<img src='" . asset($users->file_path) . "' class='img-thumbnail' width='50px'>";
            // })
            ->addColumn('status', function ($users) {
                return $users->status ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('action', function ($user) use ($can_edit, $can_delete) {
                $html = '<div class="btn-group">';
                $html .= '<a data-toggle="tooltip" ' . $can_edit . '  id="' . $user->id . '" class="btn btn-xs btn-info mr-1 edit" title="Edit"><i class="fa fa-edit"></i> </a>';
                $html .= '<a data-toggle="tooltip" ' . $can_delete . ' id="' . $user->id . '" class="btn btn-xs btn-danger mr-1 delete" title="Delete"><i class="fa fa-trash"></i> </a>';
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
        $role = DB::select('SELECT id, name from roles');

        $department = DB::select('SELECT id, name_division from divisi');

        $seksi = DB::select('SELECT id, seksi_name from seksi_has_divisi');
      
        if ($request->ajax()) {
      
            $haspermision = Auth::guard('admin');
           
            if ($haspermision) {

                $view = View::make('backend.admin.user.create')->render();
                return response()->json(['html' => $view, 'role' => $role,  'department' => $department,  'seksi' => $seksi]);
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
                        $admin->password = Hash::make($request->password);
                        $admin->save();

                        $lastInserID = $admin->id;

                        DB::insert('INSERT INTO model_has_roles (role_id, model_type, model_id) values (?, ?, ?)', [$request->input('role'), "App\Models\Admin",$lastInserID]);

                        DB::insert('INSERT INTO user_has_seksi (user_id, seksi_id, divisi_id) values (?, ?, ?)', [$lastInserID, $request->input('seksi'), $request->input('department') ]);

                        DB::commit();
                        return response()->json(['type' => 'success', 'message' => "Successfully Created"]);

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
            $haspermision = Auth::guard('admin');
            if ($haspermision) {
                $user = Admin::findOrFail($id);
                $view = View::make('backend.admin.user.edit', compact('user'))->render();
                return response()->json(['html' => $view]);
            } else {
                abort(403, 'Sorry, you are not authorized to access the page');
            }
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

                    DB::commit();
                    return response()->json(['type' => 'success', 'message' => "Successfully Updated"]);

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
            $haspermision = Auth::guard('admin');
            if ($haspermision) {
                $user = Admin::findOrFail($id); //Get user with specified id
                $user->delete();
                return response()->json(['type' => 'success', 'message' => "Successfully Deleted"]);
            } else {
                abort(403, 'Sorry, you are not authorized to access the page');
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }
}