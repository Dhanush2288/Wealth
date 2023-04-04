<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use  App\Helper\helper;
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
        $blog =  Blog::create($input);

        $response = [
            'success' => true,
            'data' =>  $blog,
            'message' => "BLog created successfully"
        ];
        return response()->json($response, 200);
    }

    public function getall(Request $request)
    {
        try {
            $where = [];
            if ($request->input("blog_id")) {
                $where[] = ['blog.id', '=', $request->input("blog_id")];
            }
            if ($request->input("startdate")) {
                $where[] = ['blog.created_at', '>', $request->input("startdate")];
            }

            if ($request->input("creator_id")) {
                $where[] = ['blog.creator_id', '=', $request->input("creator_id")];
            }
            if ($request->input("manager_id")) {
                $where[] = ['blog.manager_id', '=', $request->input("manager_id")];
            }
            if ($request->input("risk")) {
                $where[] = ['blog.risk', '=', $request->input("risk")];
            }
            $where[] = ['blog.isdeleted', '=', 0];

            $query = DB::table('blog')
                ->leftjoin('users AS A', 'A.id', '=', 'blog.creator_id')
                ->leftjoin('users AS B', 'B.id', '=', 'blog.manager_id')
                ->leftjoin('product_type', 'product_type.id', '=', 'blog.product_id')
                ->leftjoin('country', 'country.id', '=', 'blog.country_id')
                ->leftjoin('regions', 'regions.id', '=', 'blog.region_id')
                ->leftjoin('currency', 'currency.id', '=', 'blog.currency_id')
                ->where($where)
                ->select('blog.*', 'A.name as creator_name', 'B.name as manager_name', 'product_type.name as product_name', 'currency.name as currency_name', 'country.name as country_name');

                if ($request->input("product_id")) {
                    $query->whereIn('blog.product_id', $request->input("product_id"));
                }
                if ($request->input("region_id")) {
                    $query->whereIn('blog.region_id', $request->input("region_id"));
                }
                if ($request->input("currency_id")) {
                    $query->whereIn('blog.currency_id', $request->input("currency_id"));
                }
                if ($request->input("country_id")) {
                    $query->whereIn('blog.country_id', $request->input("country_id"));
                }

                $blog = $query->get();
            $responsee = [
                'success' => true,
                'data' => $blog,
                'message' => "BLogs"
            ];
            return response()->json($responsee, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 250);
            //throw $th;
        }
    }
    public function deleteblog(Request $request)
    {
        try {
            $where = [];
            if ($request->input("blog_id")) {
                $where[] = ['blog.id', '=', $request->input("blog_id")];
            }

            $blog = DB::table('blog')
                ->where($where)
                ->update(['isdeleted' => '1']);

            $responsee = [
                'success' => true,
                'data' => $blog,
                'message' => "BLog  deleted"
            ];
            return response()->json($responsee, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 250);
            //throw $th;
        }
    }
    public function editblog(Request $request)
    {
        try {
            $where = [];
            if ($request->input("id")) {
                $where[] = ['blog.id', '=', $request->input("id")];
            }
            $input=$request->all();

            $blog = DB::table('blog')
                ->where($where)
                ->update(  $input);

            $responsee = [
                'success' => true,
                'data' => $blog,
                'message' => "BLog  updated"
            ];
            return response()->json($responsee, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 250);
            //throw $th;
        }
    }
}
