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
    // public function createBlog(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required',
    //         'abstract' => 'required',
    //         'risk' => 'required',
    //         'creator_id' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         $response = [
    //             'success' => false,
    //             'message' => $validator->errors()
    //         ];
    //         return response()->json($response, 400);
    //     }
    //     $input = $request->all();
    //     $blog =  Blog::create($input);
    //     $products1 = explode(',', str_replace(['[', ']'], '', $blog->product_id));
    //     $products = array_map('intval', $products1);
    //     $currency1 = explode(',', str_replace(['[', ']'], '', $blog->currency_id));
    //     $currency = array_map('intval', $currency1);
    //     $region1 = explode(',', str_replace(['[', ']'], '', $blog->region_id));
    //     $region = array_map('intval', $region1);
    //     $country1 = explode(',', str_replace(['[', ']'], '', $blog->country_id));
    //     $country = array_map('intval', $country1);
    //     daaa($products, 1, $blog->id);
    //     daaa($currency, 2, $blog->id);
    //     daaa($region, 4, $blog->id);
    //     daaa($country, 3, $blog->id);

    //     $response = [
    //         'success' => true,
    //         'data' =>  $blog,
    //         'message' => "BLog created successfully"
    //     ];
    //     return response()->json($response, 200);
    // }
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
        $blogId = $blog->id;
        $products1 = explode(',', str_replace(['[', ']'], '', $blog->product_id));
        $products = array_map('intval', $products1);
        $currency1 = explode(',', str_replace(['[', ']'], '', $blog->currency_id));
        $currency = array_map('intval', $currency1);
        $region1 = explode(',', str_replace(['[', ']'], '', $blog->region_id));
        $region = array_map('intval', $region1);
        $country1 = explode(',', str_replace(['[', ']'], '', $blog->country_id));
        $country = array_map('intval', $country1);

        // Insert product tags for blog post
        $productTagData = [];
        foreach ($products as $tagId) {
            $productTagData[] = [
                'blog_id' => $blogId,
                'blog_tag_id' => $tagId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('blog_taggers')->insert($productTagData);

        // Insert region tags for blog post
        $currencyTagData = [];
        foreach ($currency as $tagId) {
            $currencyTagData[] = [
                'blog_id' => $blogId,
                'blog_tag_id' => $tagId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('blog_taggers')->insert($currencyTagData);
        $regionTagData = [];
        foreach ($region as $tagId) {
            $regionTagData[] = [
                'blog_id' => $blogId,
                'blog_tag_id' => $tagId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('blog_taggers')->insert($regionTagData);
        $countryTagData = [];
        foreach ($country as $tagId) {
            $regionTagData[] = [
                'blog_id' => $blogId,
                'blog_tag_id' => $tagId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('blog_taggers')->insert($countryTagData);
        $response = [
            'success' => true,
            'data' =>  $blog,
            'message' => "BLog created successfully"
        ];
        return response()->json($response, 200);
    }
    public function getall(Request $request)
    {

        $productIds = [];
        $regionIds = [];
        $currencyIds = [];
        $countryIds = [];
        if ($request->input("product_id")) {
            $products1 = explode(',', str_replace(['[', ']'], '', $request->input("product_id")));
            $productIds = array_map('intval', $products1);
        }
        if ($request->input("region_id")) {
            $regionIds1 = explode(',', str_replace(['[', ']'], '', $request->input("region_id")));
            $regionIds = array_map('intval', $regionIds1);
        }
        if ($request->input("currency_id")) {
            $currencyIds1 = explode(',', str_replace(['[', ']'], '', $request->input("currency_id")));
            $currencyIds = array_map('intval', $currencyIds1);
        }
        if ($request->input("country_id")) {
            $countryId1 = explode(',', str_replace(['[', ']'], '', $request->input("country_id")));
            $countryIds = array_map('intval', $countryId1);
        }
        $where = [];
        if ($request->input("blog_id")) {
            $where[] = ['blog.id', '=', $request->input("blog_id")];
        }
        if ($request->input("startdate")) {
            $where[] = ['blog.created_at', '>', $request->input("startdate")];
        }
        $blogs =  DB::table('blog')
            ->select('blog.id', 'blog.title')
            ->leftJoin('blog_taggers', 'blog.id', '=', 'blog_taggers.blog_id')
            ->leftJoin('blog_tag', 'blog_taggers.blog_tag_id', '=', 'blog_tag.id')
            ->whereIn('blog_tag.type', ['product', 'region', 'currency', 'country'])
            ->where($where) // add $where array as parameter to where() method

            ->when(count($productIds), function ($query) use ($productIds) {
                return $query->whereIn('blog_tag.id', $productIds)->where('blog_tag.type', 'product');
            }) // filter by product IDs if provided
            ->when(count($countryIds), function ($query) use ($countryIds) {
                return $query->whereIn('blog_tag.id', $countryIds)->where('blog_tag.type', 'country');
            })
            ->when(count($currencyIds), function ($query) use ($currencyIds) {
                return $query->whereIn('blog_tag.id', $currencyIds)->where('blog_tag.type', 'currency');
            })
            ->when(count($regionIds), function ($query) use ($regionIds) {
                return $query->whereIn('blog_tag.id', $regionIds)->where('blog_tag.type', 'region');
            }) // filter by region IDs if provided
            ->orderByDesc('blog.created_at') // sort by latest created_at date
            ->select('blog.*', 'blog_tag.id as tag_id', 'blog_tag.name as tag_name', 'blog_tag.type as tag_type')
            ->groupBy('blog.id', 'blog_taggers.id')
            ->get();


        $blogsArray = [];
        foreach ($blogs as $blog) {
            $blogId = $blog->id;
            $blogTitle = $blog->title;
            $blogAbstract = $blog->abstract;
            $blogRisk = $blog->risk;

            $tagId = $blog->tag_id;
            $tagName = $blog->tag_name;
            $tagType = $blog->tag_type;

            if (!isset($blogsArray[$blogId])) {
                $blogsArray[$blogId] = [
                    'id' => $blogId,
                    'name' => $blogTitle,
                    'abstract'=> $blogAbstract,
                    'risk'=>$blogRisk,
                    'products' => []
                ];
            }

            if ($tagType == 'product') {
                $blogsArray[$blogId]['products'][] = [
                    'id' => $tagId,
                    'name' => $tagName
                ];
            }
            if ($tagType == 'country') {
                $blogsArray[$blogId]['country'][] = [
                    'id' => $tagId,
                    'name' => $tagName
                ];
            }
            if ($tagType == 'currency') {
                $blogsArray[$blogId]['currency'][] = [
                    'id' => $tagId,
                    'name' => $tagName
                ];
            }
            if ($tagType == 'region') {
                $blogsArray[$blogId]['region'][] = [
                    'id' => $tagId,
                    'name' => $tagName
                ];
            }
        }

        $blogsResult = array_values($blogsArray);



        $responsee = [
            'success' => true,
            'data' =>  $blogsResult,
            'message' => "BLogs",
        ];

        return response()->json($responsee, 200);
    }
}
