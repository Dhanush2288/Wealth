<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Assigned;


class Assignedcontroller extends Controller
{
    public function createassigned(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'manager_id' => 'required',
                'blog_id' => 'required',
                'assigned_user' => 'required',

            ]);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors()
                ];
                return response()->json($response, 250);
            }
            $input = $request->all();
            $assigned =  Assigned::create($input);
            $response = [
                'success' => true,
                'data' => $assigned,
                'message' => "assigned created successfully",
                'df' => $input
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th, 250);
        }
    }
    public function getassignedall(Request $request)
    {
        try {
            $where = [];
            if ($request->input("blog_id")) {
                $where[] = ['blog.id', '=', $request->input("blog_id")];
            }
            if ($request->input("startdate")) {
                $where[] = ['blog.created_at', '>', $request->input("startdate")];
            }
            if ($request->input("product_id")) {
                $where[] = ['blog.product_id', 'IN', $request->input("product_id")];
            }
            if ($request->input("region_id")) {
                $where[] = ['blog.region_id', 'IN', $request->input("region_id")];
            }
            if ($request->input("currency_id")) {
                $where[] = ['blog.currency_id', 'IN', $request->input("currency_id")];
            }
            if ($request->input("country_id")) {
                $where[] = ['blog.country_id', 'IN', $request->input("country_id")];
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

            $blog = DB::table('assigned')
                ->leftjoin('blog', 'blog.id', '=', 'assigned.blog_id')
                ->leftjoin('users AS A', 'A.id', '=', 'blog.creator_id')
                ->leftjoin('users AS B', 'B.id', '=', 'blog.manager_id')
                ->leftjoin('users AS C', 'C.id', '=', 'assigned.assigned_user')
                ->leftjoin('users AS D', 'D.id', '=', 'assigned.manager_id')
                ->leftjoin('product_type', 'product_type.id', '=', 'blog.product_id')
                ->leftjoin('country', 'country.id', '=', 'blog.country_id')
                ->leftjoin('regions', 'regions.id', '=', 'blog.region_id')
                ->leftjoin('currency', 'currency.id', '=', 'blog.currency_id')
                ->where($where)
                // ->whereIn('product_id', [1])
                ->select('blog.*', 'A.name as creator_name', 'B.name as manager_name', 'C.name as assignedmanager_name', 'D.name as assigneduser_name', 'product_type.name as product_name', 'currency.name as currency_name', 'country.name as country_name')
                ->get();

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
    public function getblogassignedall(Request $request)
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
            if ($request->input("status")) {
                $where[] = ['blog.status', '=', $request->input("status")];
            }

            $query = DB::table('blog')
                ->leftjoin('assigned', 'blog.id', '=', 'assigned.blog_id')
                ->leftjoin('users AS A', 'A.id', '=', 'blog.creator_id')
                ->leftjoin('users AS B', 'B.id', '=', 'blog.manager_id')
                ->leftjoin('users AS C', 'C.id', '=', 'assigned.assigned_user')
                ->leftjoin('users AS D', 'D.id', '=', 'assigned.manager_id')
                ->leftjoin('product_type', 'product_type.id', '=', 'blog.product_id')
                ->leftjoin('country', 'country.id', '=', 'blog.country_id')
                ->leftjoin('regions', 'regions.id', '=', 'blog.region_id')
                ->leftjoin('currency', 'currency.id', '=', 'blog.currency_id')
                ->where($where)
                ->select('blog.*', 'A.name as creator_name', 'assigned.id as assigned_id', 'B.name as manager_name', 'C.name as assignedmanager_name', 'D.name as assigneduser_name', 'product_type.name as product_name', 'currency.name as currency_name', 'country.name as country_name');

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

            $blogs = [];

            foreach ($blog as $row) {
                $assigned = [
                    'id' => $row->assigned_id,
                    'assigneduser_name' => $row->assigneduser_name,
                    'assignedmanager_name' => $row->assignedmanager_name
                ];

                if (!isset($blogs[$row->id])) {
                    $blogs[$row->id] = [
                        'id' => $row->id,
                        "title" => $row->title,
                        "abstract" => $row->abstract,
                        "content" =>$row->content,
                        "risk" => $row->risk,
                        'creator_id' => $row->creator_id,
                        'creator_name' => $row->creator_name,
                        'manager_id' => $row->manager_id,
                        'manager_name' => $row->manager_name,
                        'product_id' => $row->product_id,
                        'product_name' => $row->product_name,
                        'country_id' => $row->country_id,
                        'country_name' => $row->country_name,
                        'currency_id' => $row->currency_id,
                        'currency_name' => $row->currency_name,
                        'assigned' => [],
                        'maxrange'=>$row->maxrange,
                        'created_at'=>$row->created_at,
                        'status'=>$row->status
                    ];
                }

                if (!is_null($row->assigned_id)) {
                    $blogs[$row->id]['assigned'][] = $assigned;
                }
            }

            $blogs = array_values($blogs);
            $responsee = [
                'success' => true,
                'data' => $blogs,
                'message' => "BLogs"
            ];
            return response()->json($responsee, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 350);
            //throw $th;
        }
    }
    public function createpreferred(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
            ]);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors()
                ];
                return response()->json($response, 250);
            }
            $input = $request->all();
            $assigned =  DB::table('preferred_investment')->insert($input);
            $response = [
                'success' => true,
                'data' => $assigned,
                'message' => "preferred created successfully",
                'df' => $input
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th, 250);
        }
    }
    public function getpreferred(Request $request)
    {
        try {
            $where = [];
            if ($request->input("blog_id")) {
                $where[] = ['blog.id', '=', $request->input("blog_id")];
            }
            $input = $request->all();
            $assigned =  DB::table('preferred_investment')->insert($input);
            $response = [
                'success' => true,
                'data' => $assigned,
                'message' => "preferred created successfully",
                'df' => $input
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th, 250);
        }
    }
}
