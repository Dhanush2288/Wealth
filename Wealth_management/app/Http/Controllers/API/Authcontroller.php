<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller

{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'role_id' => 'required',
                'password' => 'required',
                'c_password' => 'required|same:password',


            ]);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors()
                ];
                return response()->json($response, 400);
            }
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            $response = [
                'success' => true,
                'data' => $success,
                'message' => "User register successfully"
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 250);
            //throw $th;
        }
    }


    public function login(Request $request)
    {
        try {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();
            $success = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->select('users.id', 'users.name', 'users.email', 'roles.name as usertype')
                ->where('users.id', $user->id)
                ->get();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $response = [
                'success' => true,
                'user' => $success,
                'message' => "User register successfully"
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
            ];
            return response()->json($response, 400);
        }
    } catch (\Throwable $th) {
        return response()->json($th, 250);
        //throw $th;
    }
    }
    public function createrole(Request $request)
    {
        try {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'roleid' => 'required',

        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = $request->all();
        $user = Roles::create($input);
        $success['name'] = $user->name;
        $response = [
            'success' => true,
            'data' => $success,
            'message' => "role created successfully"
        ];
        return response()->json($response, 200);
    } catch (\Throwable $th) {
        return response()->json($th, 250);
        //throw $th;
    }
    }
    public function userall(Request $request)
    {
        try {
        $where = [];
        if ($request->input("roleid")) {
            $where[] = ['users.role_id', '=', $request->input("roleid")];
        }
        $success = DB::table('users')
            ->leftjoin('roles', 'roles.id', '=', 'users.role_id')
            ->where($where)
            ->select('users.name', 'users.created_at', 'users.email', 'users.id', 'users.role_id', 'users.company', 'users.poistion', 'roles.name as role_name',)

            ->get();
        $response = [
            'success' => true,
            'data' => $success,
            'message' => "User register successfully"
        ];
        return response()->json($response, 200);
    } catch (\Throwable $th) {
        return response()->json($th, 250);
        //throw $th;
    }

    }
    public function getroles(Request $request)
    {
        try {
        $success = DB::table('roles') ->get();
        $response = [
            'success' => true,
            'data' => $success,
            'message' => "User roles successfully"
        ];
        return response()->json($response, 200);
    } catch (\Throwable $th) {
        return response()->json($th, 250);
        //throw $th;
    }
    }
    public function userfirst(Request $request)
    {
        try {
        $where = [];
        if ($request->input("id")) {
            $where[] = ['users.id', '=', $request->input("id")];
        }
        $success = DB::table('users')
            ->leftjoin('roles', 'roles.id', '=', 'users.role_id')
            ->where($where)
            ->select('users.name', 'users.created_at', 'users.email', 'users.id', 'users.role_id', 'users.company', 'users.poistion', 'roles.name as role_name',)
            ->first();
        $response = [
            'success' => true,
            'data' => $success,
            'message' => "User register successfully"
        ];
        return response()->json($response, 200);
    } catch (\Throwable $th) {
        return response()->json($th, 250);
        //throw $th;
    }
}
}
