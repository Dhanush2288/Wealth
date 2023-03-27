<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BLogController;
use App\Http\Controllers\API\Projectcontroller;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);
Route::post('users', [AuthController::class, 'userall']);
Route::post('createrole', [AuthController::class, 'createrole']);
Route::post('createblog', [BLogController::class, 'createblog']);
Route::post('getblogs', [BLogController::class, 'getall']);
Route::post('deleteblog', [BLogController::class, 'deleteblog']);
Route::post('editblog', [BLogController::class, 'editblog']);

Route::post('createproduct', [Projectcontroller::class, 'createproduct']);
Route::post('createcountry', [Projectcontroller::class, 'createcountry']);
Route::post('createregion', [Projectcontroller::class, 'createregion']);





