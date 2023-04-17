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
Route::middleware('auth:sanctum')->post('userpreall', [AuthController::class, 'userpreall']);
Route::middleware('auth:sanctum')->post('assignedclients', [AuthController::class, 'assignedclients']);
Route::middleware('auth:sanctum')->post('createblog', [BLogController::class, 'createblog']);
Route::middleware('auth:sanctum')->post('getblogs', [BLogController::class, 'getall']);
Route::middleware('auth:sanctum')->post('deleteblog', [BLogController::class, 'deleteblog']);
Route::middleware('auth:sanctum')->post('editblog', [BLogController::class, 'editblog']);

Route::post('createproduct', [Projectcontroller::class, 'createproduct']);
Route::post('createcountry', [Projectcontroller::class, 'createcountry']);
Route::post('createregion', [Projectcontroller::class, 'createregion']);
Route::post('createcurrency', [Projectcontroller::class, 'createcurrency']);

Route::middleware('auth:sanctum')->post('createassigned', [Assignedcontroller::class, 'createassigned']);
Route::middleware('auth:sanctum')->post('getassignedall', [Assignedcontroller::class, 'getassignedall']);
Route::middleware('auth:sanctum')->post('getblogassignedall', [Assignedcontroller::class, 'getblogassignedall']);
Route::middleware('auth:sanctum')->post('comments', [Assignedcontroller::class, 'comments']);
Route::middleware('auth:sanctum')->post('getcomments', [Assignedcontroller::class, 'getcomments']);
Route::middleware('auth:sanctum')->post('updateseen', [Assignedcontroller::class, 'updateseen']);
Route::middleware('auth:sanctum')->post('getunseen', [Assignedcontroller::class, 'getunseen']);
Route::middleware('auth:sanctum')->post('getseen', [Assignedcontroller::class, 'getseen']);
Route::middleware('auth:sanctum')->post('asdasd', [Assignedcontroller::class, 'asdasd']);



Route::post('createpreferred', [Assignedcontroller::class, 'createpreferred']);
Route::post('getpreferred', [Assignedcontroller::class, 'getpreferred']);

Route::middleware('auth:sanctum')->post('getall', [Projectcontroller::class, 'getallproject']);

Route::middleware('auth:sanctum')->post('getallpreferred', [Assignedcontroller::class, 'getallpreferred']);
Route::middleware('auth:sanctum')->post('recommendUsers', [Assignedcontroller::class, 'recommendUsers']);

Route::middleware('auth:sanctum')->post('editassign', [Assignedcontroller::class, 'editassign']);


