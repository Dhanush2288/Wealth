<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class BlogController extends Controller

{
    public function createBlog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'abstract' => 'required',
            'risk' => 'required',
            'creator_id' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = $request->all();

        $blog = DB::table('blog')->insert($input);
        $response = [
            'success' => true,
            'data' => $blog,
            'message' => "BLog created successfully"
        ];
        return response()->json($response, 200);
    }
    public function getall(Request $request)
    {
        $blog = DB::table('blog')
        ->leftjoin('users AS A', 'A.id', '=', 'blog.creator_id')
        ->leftjoin('users AS B', 'B.id', '=', 'blog.manager_id')
        ->select('blog.*','A.name as creator_name','B.name as manager_name')
        ->get();

        $responsee = [
            'success' => true,
            'data' => $blog,
            'message' => "BLogs"
        ];
        return response()->json($responsee, 200);

    }

}
