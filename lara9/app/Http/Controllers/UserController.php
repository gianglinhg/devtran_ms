<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::join('users_status','status_id','users_status.id')
        ->join('departments','department_id','departments.id')
        ->select('users.*','departments.name as department','users_status.name as status')
        ->get();
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users_status = DB::table('users_status')
        ->select('id as value','name as label')
        ->get();
        $departments = DB::table('departments')
        ->select('id as value','name as label')
        ->get();
        return response()->json([
            'users_status' => $users_status,
            'departments' => $departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'status_id' => 'required',
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'department_id' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ],[
            'status_id.required' => 'Trường này bắt buộc nhập',
            'username.required' => 'Trường này bắt buộc nhập'
        ]);
        $user = new User;
        $user->name = $request['name'];
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->department_id = $request['department_id'];
        $user->status_id = $request['status_id'];
        $user->password = Hash::make($request['password']);
        $user->save();

        return response()->json( $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);

        $users_status = DB::table('users_status')
        ->select('id as value','name as label')
        ->get();
        $departments = DB::table('departments')
        ->select('id as value','name as label')
        ->get();
        return response()->json([
            'users' => $users,
            'users_status' => $users_status,
            'departments' => $departments
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required',
            'name' => 'required | max:255',
            'username' => 'required | unique:users,username,'.$id,
            'email' => 'required | email',
            'department_id' => 'required',
        ],[
            'status_id.required' => 'Trường này bắt buộc nhập',
            'name.required' => 'Trường này bắt buộc nhập',
            'username.required' => 'Trường này bắt buộc nhập',
            'username.unique' => 'Tài khoản đã tồn tại',
            'email.email' => 'Chưa nhập đúng định dạng email',
            'department_id.required' => 'Trường này bắt buộc nhập',
        ]);

        User::find($id)->update([
            'status_id' => $request['status_id'],
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'department_id' => $request['department_id'],
        ]);

        if($request['change_password'] == true){
            $request->validate([
                'password' => 'required | confirmed',
            ],[
                'password.required' => 'Mật khẩu buộc nhập',
                'password.confirmed' => 'Xác nhận mật khẩu chưa khớp'
            ]);
            User::find($id)->update([
                'password' => Hash::make($request['password']),
                'change_password_at' => NOW()
            ]);
        }
        return response()->json([
            'message' => 'Chỉnh sửa thành công',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 1) {
            return response()->json([
                'message' => 'Không thẻ xóa admin',
            ], 201);
        }
        $userDelete = User::find($id);
        if($userDelete) {
            $userDelete->delete();
            $msg = 'Đã xóa thành công';
            return response()->json($msg, 200);
        }
        else $msg = 'Thành viên không tồn tại';
        return response()->json([
            'message' => $msg,
        ], 200);
    }
}
