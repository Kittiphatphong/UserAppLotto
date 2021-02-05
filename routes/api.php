<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\ProviderApiController;
use App\Http\Controllers\Api\BillOrderApiController;
use App\Http\Controllers\Api\ResultApiController;
use App\Http\Controllers\Api\AnimalApiController;
use App\Http\Controllers\Api\PromotionApiController;
use App\Http\Controllers\Api\RecommendApiLottoController;
use App\Http\Controllers\Api\DreamTellerApiController;
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

Route::post('/register-customer',[CustomerApiController::class,'RegisterPhone']);
Route::post('/register-otp',[CustomerApiController::class,'requestOTP']);
Route::post('/verify-otp',[CustomerApiController::class,'verifyOTP']);
Route::post('/set-password',[CustomerApiController::class,'setPassword']);
Route::post('/set-Account',[CustomerApiController::class,'moreAccount']);

Route::post('/login-customer',[CustomerApiController::class,'login']);

//Provider
Route::post('/login-provider',[ProviderApiController::class,'login']);

Route::group(['middleware'=>'auth:sanctum'],function(){

    Route::post('sell-2d3d4d5d6d',[BillOrderApiController::class,'sell2d3d4d5d6d']);
    Route::post('sell-340',[BillOrderApiController::class,'sell340']);
    Route::post('pull-result',[ResultApiController::class,'pullResult']);

    Route::post('history-bill',[BillOrderApiController::class,'billAll']);
    Route::post('history-bill-detail',[BillOrderApiController::class,'billDetail']);
    Route::post('bill6d-customer',[BillOrderApiController::class,'bill6dCustomer']);
    Route::post('bill340-customer',[BillOrderApiController::class,'bil340Customer']);

    Route::post('show-result',[ResultApiController::class,'showResult']);

    Route::post('logout-customer',[CustomerApiController::class,'logout']);

    Route::post('animal-list',[AnimalApiController::class,'animalList']);

    Route::post('promotion',[PromotionApiController::class,'promotionList']);

    Route::post('recommend-lotto',[RecommendApiLottoController::class,'recommendList']);

    Route::post('dream-teller',[DreamTellerApiController::class,'dreamTellerList']);
});

//Bill order

