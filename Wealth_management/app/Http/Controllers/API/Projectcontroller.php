<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class Projectcontroller extends Controller
{
    public function createproduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = $request->all();
        $user = DB::table('product_type')->insert($input);
        $response = [
            'success' => true,
            'data' => $user,
            'message' => "product created successfully",
            'df'=>$input
        ];
        return response()->json($response, 200);
    }
    public function createcountry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = $request->all();
        $user = DB::table('country')->insert($input);
        $response = [
            'success' => true,
            'data' => $user,
            'message' => "country created successfully",
            'df'=>$input
        ];
        return response()->json($response, 200);
    }
    public function createregion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = $request->all();
        $user = DB::table('regions')->insert($input);
        $response = [
            'success' => true,
            'data' => $user,
            'message' => "region created successfully",
            'df'=>$input
        ];
        return response()->json($response, 200);
    }

    public function createcurrency(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = $request->all();
        $user = DB::table('currency')->insert($input);
        $response = [
            'success' => true,
            'data' => $user,
            'message' => "currency created successfully",
            'df'=>$input
        ];
        return response()->json($response, 200);
    }
    public function getallproject(Request $request)
    {

        $currency = DB::table('currency')->get();
        $project_types = DB::table('product_type')->get();
        $regions = DB::table('regions')->get();
        $country = DB::table('country')->get();
        $response = [
            'success' => true,
            'data' =>[
                'currency'=>$currency,
                'project_types'=>$project_types,
                'regions'=>$regions,
                'country'=>$country,
            ],
            'message' => "All projects",
         ];
        return response()->json($response, 200);
    }
}
