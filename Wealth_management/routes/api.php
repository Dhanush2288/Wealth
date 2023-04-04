<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BLogController;
use App\Http\Controllers\API\Projectcontroller;

use App\Http\Controllers\API\Assignedcontroller;


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
Route::post('userfirst', [AuthController::class, 'userfirst']);

Route::post('createrole', [AuthController::class, 'createrole']);
Route::post('getroles', [AuthController::class, 'getroles']);

Route::post('createblog', [BLogController::class, 'createblog']);
Route::post('getblogs', [BLogController::class, 'getall']);
Route::post('deleteblog', [BLogController::class, 'deleteblog']);
Route::post('editblog', [BLogController::class, 'editblog']);

Route::post('createproduct', [Projectcontroller::class, 'createproduct']);
Route::post('createcountry', [Projectcontroller::class, 'createcountry']);
Route::post('createregion', [Projectcontroller::class, 'createregion']);

Route::post('createassigned', [Assignedcontroller::class, 'createassigned']);
Route::post('getassignedall', [Assignedcontroller::class, 'getassignedall']);
Route::post('getblogassignedall', [Assignedcontroller::class, 'getblogassignedall']);


Route::post('createpreferred', [Assignedcontroller::class, 'createpreferred']);

Route::post('getall', [Projectcontroller::class, 'getallproject']);




