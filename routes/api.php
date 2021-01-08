<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\ProviderApiController;
use App\Http\Controllers\Api\BillOrderApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register-customer',[CustomerApiController::class,'Register']);
Route::post('/register-otp/{id}',[CustomerApiController::class,'requestOTP']);
Route::post('/verify-otp/{id}',[CustomerApiController::class,'verifyOTP']);

Route::post('/login-customer',[CustomerApiController::class,'login']);

//Provider
Route::post('/login-provider',[ProviderApiController::class,'login']);

Route::group(['middleware'=>'auth:sanctum'],function(){

    Route::post('sell-2d3d4d5d6d',[BillOrderApiController::class,'sell2d3d4d5d6d']);
    Route::post('sell-340',[BillOrderApiController::class,'sell340']);

});

//Bill order

