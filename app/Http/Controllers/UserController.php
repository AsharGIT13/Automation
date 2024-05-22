<?php

namespace App\Http\Controllers;

use App\Models\Right;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = auth()->user();

        // $rights = Right::select('rights_id')->where('role_id', $user->role_id)->get();
        $rights = Right::where('role_id', $user->role_type)->pluck('rights_id')->toArray();
        $limit_val = $request->input('length');
        $start = $request->input('start');
        $searchText = $request->input('search.value');
        $query = User::where('users.approved_status', 1)
            ->whereIn('users.role_type', $rights)
            ->join('roles AS roles', 'roles.id', '=', 'users.role_type')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.mobile_no',
                'users.password',
                'users.role_type',
                'users.approved_status',
                'roles.name AS role_name',
            );

        if (!empty($searchText)) {
            $query->where(function ($q) use ($searchText) {
                $q->where('users.name', 'LIKE', "%{$searchText}%")
                    ->orWhere('users.email', 'LIKE', "%{$searchText}%")
                    ->orWhere('users.mobile_no', 'LIKE', "%{$searchText}%")
                    ->orWhere('roles.name', 'LIKE', "%{$searchText}%");
            });
        }

        $totalDataRecord = $query->count();

        $orderColumnIndex = $request->input('order.0.column');
        $orderColumnName = $request->input('columns.' . $orderColumnIndex . '.data');
        $orderDirection = $request->input('order.0.dir');
        if ($orderColumnName && in_array($orderDirection, ['asc', 'desc'])) {
            $query->orderBy('id', $orderDirection);
        }

        // Pagination
        if ($limit_val != -1) { // Check if 'All' records are requested
            $post_data = $query->offset($start)->limit($limit_val)->get();
        } else {
            $post_data = $query->get();
        }
        foreach ($post_data  as $index =>  $data) {
            $serialNumber = $start + $index + 1;
            // $edit_driver = '<a href="' . route('edit_driver', ['id' => $data->id]) . '"><i class="far fa-edit"></i></a>';
            $edit = '<button type="button" class="btn btn-outline-secondary btn-sm edit" title="Edit User" onclick="editdata(' . $data->id . ')"><i class="fas fa-pencil-alt"></i></button>';
            $delete_driver = '<a href="' . route('delete_user', ['id' => $data->id]) . '"><button type="button" class="btn btn-outline-secondary btn-sm edit" title="Edit User" ><i class="far fa-trash-alt"></i></button></a>';
            $array_data[] = array(
                'S No' => $serialNumber,
                'id' => $data->id,
                'name' => $data->name,
                'email' => $data->email,
                'mobile_no' => $data->mobile_no,
                'role_type' => $data->role_id,
                'role_name' => $data->role_name,
                'action' =>  $edit . '   ' . $delete_driver
            );
        }

        if (!empty($array_data)) {
            $draw_val = $request->input('draw');
            $get_json_data = array(
                "draw"            => intval($draw_val),
                "recordsTotal"    => intval($totalDataRecord),
                "recordsFiltered" => intval($totalDataRecord),
                "data"            => $array_data
            );

            echo json_encode($get_json_data);
        } else {
            $draw_val = $request->input('draw');
            $get_json_data = array(
                "draw"            => "intval($draw_val)",
                "recordsTotal"    => 0,
                "recordsFiltered" => 0,
                "data"            => ""
            );
            echo json_encode($get_json_data);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile_no'   => ['required', 'numeric', 'regex:/^\d{0,20}$/', 'unique:users,mobile_no'],
            'email'     => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response([
                "success" => 'validation',
                "message" => $validator->errors()
            ]);
        }
        try {
            $data = array(
                'name' => $request->post('name'),
                'mobile_no'  => $request->post('mobile_no'),
                'email'    => $request->post('email'),
                'password' => Hash::make($request->post('password')),
                'role_type' => $request->post('role_id'),
                'approved_status' => 1,
            );

            User::create($data);
            return response(["success" => true, "message" => "User Details Inserted Successfully"]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("User Creation Failed: " . $e->getMessage());
            return response([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles')->where('id', $id)->first();
        if (!$user) {
            return response(["success" => false, "message" => trans('message.user_not_found')]);
        }
        return response(["success" => true, "data" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function user_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile_no'   => ['required', 'numeric', 'regex:/^\d{0,20}$/', 'unique:users,mobile_no,' . $request->post('id') . 'id'],
            'email'     => 'required|email|max:255|unique:users,email,' . $request->post('id') . 'id',
        ]);

        if ($validator->fails()) {
            return response([
                "success" => 'validation',
                "message" => $validator->errors()
            ]);
        }
        try {
            $recordToUpdate = User::find($request->post('id'));
            $recordToUpdate->update([
                'name' => $request->post('name'),
                'mobile_no'  => $request->post('mobile_no'),
                'email'    => $request->post('email')
            ]);
            return response(["success" => true, "message" => "User Details Updated Successfully"]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("User Creation Failed: " . $e->getMessage());
            return response([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $driver_id = $request->get('id');
        $delete_data = User::find($driver_id);
        $delete_data->approved_status = 0;
        $delete_data->save();
        return redirect()->route('user.index');
    }

    public function role_list()
    {
        $role_id = auth()->user()->role_type;

        $rights_list = Right::where('role_id', $role_id)->select('rights_id')->get();

        $res =  Role::whereIn('id', $rights_list)->select('id', 'name')->orderBy('id', 'ASC')->get();

        if ($res->isEmpty()) {
            return response(["success" => false, "message" => "User Not Found"]);
        }
        return response(["success" => true, "data" => $res]);
    }
}
