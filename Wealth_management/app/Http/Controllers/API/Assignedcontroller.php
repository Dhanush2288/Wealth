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
            if ($request->input("assigned_status") != '') {
                $where[] = ['assigned.status', '=', $request->input("assigned_status")];
            }
            if ($request->input("assigned_user")) {
                $where[] = ['assigned.assigned_user', '=', $request->input("assigned_user")];
            }
            $where[] = ['blog.isdeleted', '=', 0];

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
                ->select('blog.*', 'A.name as creator_name', 'B.name as manager_name', 'C.name as assignedmanager_name', 'D.name as assigneduser_name', 'product_type.name as product_name', 'currency.name as currency_name', 'country.name as country_name', 'assigned.status as assigned_status', 'assigned.id as assigned_id')
                ->get();

            $responsee = [
                'success' => true,
                'data' => $blog,
                'message' => 'get all assigned'
            ];
            return response()->json($responsee, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 250);
            //throw $th;
        }
    }
    public function asdasd(Request $request)
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

            if ($request->input("assigned_user")) {
                $where[] = ['assigned.assigned_user', '=', $request->input("assigned_user")];
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
                ->whereIn('assigned.status', [1,2])
                ->select('blog.*', 'A.name as creator_name', 'B.name as manager_name', 'C.name as assignedmanager_name', 'D.name as assigneduser_name', 'product_type.name as product_name', 'currency.name as currency_name', 'country.name as country_name', 'assigned.status as assigned_status', 'assigned.id as assigned_id')
                ->get();

            $responsee = [
                'success' => true,
                'data' => $blog,
                'message' => 'get all assigned'
            ];
            return response()->json($responsee, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 250);
            //throw $th;
        }
    }
    public function recommendUsers(Request $request)
    {
        // Retrieve the blog post
        $post = DB::table('blog')->where('id', $request->input('blog_id'))->first();

        // Retrieve all users who match the blog post's criteria
        $users = DB::table('users')
            ->join('preferred_investment', 'users.id', '=', 'preferred_investment.user_id')
            ->where('users.role_id', 4)
            ->where('preferred_investment.product_id', $post->product_id)
            ->where('preferred_investment.currency_id', $post->currency_id)
            ->whereBetween('preferred_investment.risk_rating', [$post->risk - 1, $post->risk + 1 ])
            ->whereBetween('preferred_investment.maxrange', [$post->maxrange - 2000, $post->maxrange + 2000])
            ->where('preferred_investment.isdeleted', '=', 0)
            ->select('users.*')
            ->get();

        if ($users->isEmpty()) {
            $responsee = [
                'success' => false,
                'data' => 'No users match the criteria specified in the blog post.',
                'message' => "BLogs"
            ];
            return response()->json($responsee);
        }

        // Calculate the match score for each user
        $userScores = [];
        foreach ($users as $user) {
            $score = 0;
            $pref = DB::table('preferred_investment')->where('user_id', $user->id)->first();
            if ($pref->product_id == $post->product_id) {
                $score += 1;
            }

            if ($pref->currency_id == $post->currency_id) {
                $score += 1;
            }
            $score += $pref->risk_rating - $post->risk;
            $score += $pref->maxrange - $post->maxrange;
            $userScores[$user->id] = $score;
        }

        // Sort the users by their match score
        arsort($userScores);

        // Return the top N users with the highest match score
        $recommendedUsers = [];
        $n = min($users->count(), $request->input('num_users', 10));
        foreach (array_slice($userScores, 0, $n, true) as $userId => $score) {
            $recommendedUsers[] = DB::table('users')
                ->join('preferred_investment', 'users.id', '=', 'preferred_investment.user_id')
                ->leftjoin('product_type', 'product_type.id', '=', 'preferred_investment.product_id')
                ->leftjoin('country', 'country.id', '=', 'preferred_investment.country_id')
                ->leftjoin('regions', 'regions.id', '=', 'preferred_investment.region_id')
                ->leftjoin('currency', 'currency.id', '=', 'preferred_investment.currency_id')
                ->where('users.id', $userId)
                ->select('users.name', 'users.id', 'users.email', 'users.role_id', 'preferred_investment.*',  'product_type.name as product_name', 'currency.name as currency_name', 'country.name as country_name')
                ->orderBy('preferred_investment.created_at', 'desc')

                ->first();
        }
        $responsee = [
            'success' => true,
            'data' => $recommendedUsers,
            'message' => "BLogs"
        ];
        return response()->json($responsee);
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
                        "content" => $row->content,
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
                        'maxrange' => $row->maxrange,
                        'created_at' => $row->created_at,
                        'status' => $row->status
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
    public function editassign(Request $request)
    {
        try {
            $where = [];
            if ($request->input("id")) {
                $where[] = ['assigned.id', '=', $request->input("id")];
            }

            $blog = DB::table('assigned')
                ->where($where)
                ->update(['status' => $request->input("status")]);

            $responsee = [
                'success' => true,
                'data' => $blog,
                'message' => "assigned"
            ];
            return response()->json($responsee, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 250);
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
            if ($request->input("user_id")) {
                $where[] = ['preferred_investment.user_id', '=', $request->input("user_id")];
            }

            $blog = DB::table('preferred_investment')
                ->where($where)
                ->update(['isdeleted' => 1]);
            $input = array_merge($request->all(), ['created_at' => now()]);
            $assigned =  DB::table('preferred_investment')->insert($input);
            $response = [
                'success' => true,
                'data' => $blog,
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
            if ($request->input("user_id")) {
                $where[] = ['preferred_investment.user_id', '=', $request->input("user_id")];
            }
            $assigned = DB::table('preferred_investment')
                ->leftjoin('product_type', 'product_type.id', '=', 'preferred_investment.product_id')
                ->leftjoin('country', 'country.id', '=', 'preferred_investment.country_id')
                ->leftjoin('regions', 'regions.id', '=', 'preferred_investment.region_id')
                ->leftjoin('currency', 'currency.id', '=', 'preferred_investment.currency_id')
                ->where($where)
                ->select('preferred_investment.*',  'product_type.name as product_name', 'currency.name as currency_name', 'country.name as country_name')
                ->orderBy('created_at', 'desc')
                ->first();
            $response = [
                'success' => true,
                'data' => $assigned,
                'message' => "preferred created successfully",
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th, 250);
        }
    }
    public function getallpreferred(Request $request)
    {
        try {
            $where = [];
            if ($request->input("user_id")) {
                $where[] = ['preferred_investment.user_id', '=', $request->input("user_id")];
            }
            $where[] = ['preferred_investment.status', '=', 0];

            $assigned = DB::table('preferred_investment')
                ->leftjoin('product_type', 'product_type.id', '=', 'preferred_investment.product_id')
                ->leftjoin('country', 'country.id', '=', 'preferred_investment.country_id')
                ->leftjoin('regions', 'regions.id', '=', 'preferred_investment.region_id')
                ->leftjoin('currency', 'currency.id', '=', 'preferred_investment.currency_id')
                ->where($where)
                ->select('preferred_investment.*',  'product_type.name as product_name', 'currency.name as currency_name', 'country.name as country_name')
                ->orderBy('created_at', 'desc')
                ->get();
            $response = [
                'success' => true,
                'data' => $assigned,
                'message' => "preferred created successfully",
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th, 250);
        }
    }

    public function comments(Request $request)
    {
        try {

            $input = array_merge($request->all(), ['created_at' => now()]);
            $comments =  DB::table('comments')->insert($input);

            $responsee = [
                'success' => true,
                'data' => $comments,
                'message' => "comments"
            ];
            return response()->json($responsee, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 250);
            //throw $th;
        }
    }


    public function getcomments(Request $request)
    {
        try {
            if($request->input("blog_id")!=null){
                $where = [];
                if ($request->input("blog_id")) {
                    $where[] = ['comments.blog_id', '=', $request->input("blog_id")];
                }
                // if ($request->input("user_id")) {
                //     $where[] = ['comments.user_id', '=', $request->input("user_id")];
                // }
                $comments =  DB::table('comments')->where($where)->get();
                $responsee = [
                    'success' => true,
                    'data' => $comments,
                    'message' => "comments"
                ];
                return response()->json($responsee, 200);
            }else{
                return response()->json('error', 250);

            }

        } catch (\Throwable $th) {
            return response()->json($th, 250);
            //throw $th;
        }
    }
    public function getunseen(Request $request)
    {
        try {
            $where = [];
            if ($request->input("blog_id")) {
                $where[] = ['comments.blog_id', '=', $request->input("blog_id")];
            }
            if ($request->input("user_id")) {
                $where[] = ['comments.user_id', '!=', $request->input("user_id")];
            }
            $where[] = ['comments.seen', '=', 0];

            $comments =  DB::table('comments')->where($where)->get();
            $responsee = [
                'success' => true,
                'data' => $comments,
                'message' => "comments"
            ];
            return response()->json($responsee, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 250);
            //throw $th;
        }
    }
    public function getseen(Request $request)
    {
        try {
            $where = [];

            // if ($request->input("user_id")) {
            //     $where[] = ['comments.user_id', '!=', $request->input("user_id")];
            // }
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
            if ($request->input("assigned_status") != '') {
                $where[] = ['assigned.status', '=', $request->input("assigned_status")];
            }
            if ($request->input("assigned_user")) {
                $where[] = ['assigned.assigned_user', '=', $request->input("assigned_user")];
            }


            $query = DB::table('assigned')
                ->leftjoin('comments', 'comments.blog_id', '=', 'assigned.blog_id')
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
                ->select('assigned.*', 'blog.*', 'comments.*', 'comments.id as comments_id','comments.user_id as comments_user_id', 'blog.id as blog_id', 'assigned.status as assigned_status', 'A.name as creator_name', 'assigned.id as assigned_id', 'B.name as manager_name', 'C.name as assignedmanager_name', 'D.name as assigneduser_name', 'product_type.name as product_name', 'currency.name as currency_name', 'country.name as country_name');


            $blog = $query->get();

            $blogs = [];

            foreach ($blog as $row) {
                $comments = [
                    'id' => $row->comments_id,
                ];

                if (!isset($blogs[$row->assigned_id])) {
                    $blogs[$row->assigned_id] = [
                        'id' => $row->id,
                        "title" => $row->title,
                        "abstract" => $row->abstract,
                        "content" => $row->content,
                        "expiry_at"=>$row->expiry_at,
                        "risk" => $row->risk,
                        'assigneduser_name' => $row->assigneduser_name,
                        'assignedmanager_name' => $row->assignedmanager_name,
                        'product_id' => $row->product_id,
                        'product_name' => $row->product_name,
                        'country_id' => $row->country_id,
                        'country_name' => $row->country_name,
                        'currency_id' => $row->currency_id,
                        'currency_name' => $row->currency_name,
                        'comments' => [],
                        'maxrange' => $row->maxrange,
                        'created_at' => $row->created_at,
                        'assigned_status' => $row->assigned_status,
                        'blog_id' => $row->blog_id,
                        "content" => $row->content,


                    ];
                }

                if (!is_null($row->comments_id) && $row->seen == 0 &&  $row->comments_user_id != $request->input("user_id")) {
                    $blogs[$row->assigned_id]['comments'][] = $comments;
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
            return response()->json($th, 250);
            //throw $th;
        }
    }

    public function updateseen(Request $request)
    {
        try {
            $where = [];
            if ($request->input("blog_id")) {
                $where[] = ['comments.blog_id', '=', $request->input("blog_id")];
            }
            if ($request->input("user_id")) {
                $where[] = ['comments.user_id', '!=', $request->input("user_id")];
            }

            $blog = DB::table('comments')
                ->where($where)
                ->update(['seen' => 1]);

            $responsee = [
                'success' => true,
                'data' => $blog,
                'message' => "assigned"
            ];
            return response()->json($responsee, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 250);
            //throw $th;
        }
    }
}
