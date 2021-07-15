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
use App\Http\Controllers\Api\NotificationApiController;
use App\Http\Controllers\Api\BillApiController;
use App\Http\Controllers\Api\SaveOrderController;
use App\Http\Controllers\TermConditionApiController;
use App\Http\Controllers\Api\ImageAppApiController;
use App\Http\Controllers\Api\GoogleMapApiController;
use App\Http\Controllers\Api\FortuneApiController;
use App\Http\Controllers\Api\PushNotificationApiController;
use App\Http\Controllers\Api\TypeExpenseApiController;
use App\Http\Controllers\Api\ExpenseApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\LiveLinkApiController;
use App\Http\Controllers\Api\MedthodBuyApiController;
use App\Http\Controllers\Api\HoroscopeApiController;
use App\Http\Controllers\Api\AstrologicalApiController;
use App\Http\Controllers\Api\RandomDigitApiController;
use App\Http\Controllers\Api\RecordSearchApiController;
use App\Http\Controllers\Api\HistoryBillApiController;
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
Route::group(['middleware'=>'apilogger'],function(){

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//address
Route::post('/get-address',[CustomerApiController::class,'address']);
//term and condition
Route::post('/term-condition',[TermConditionApiController::class,'term']);
//Background image app
Route::post('/background-app',[ImageAppApiController::class,'imageApp']);

Route::post('/register-customer',[CustomerApiController::class,'RegisterPhone']);
Route::post('/v2/register-customer',[CustomerApiController::class,'RegisterPhoneV2']);
Route::post('/register-otp',[CustomerApiController::class,'requestOTP']);
Route::post('/verify-otp',[CustomerApiController::class,'verifyOTP']);
Route::post('/set-password',[CustomerApiController::class,'setPassword']);
Route::post('/login-customer',[CustomerApiController::class,'login']);
Route::post('/forgot-password',[CustomerApiController::class,'forgotPassword']);

//Provider
Route::post('/login-provider',[ProviderApiController::class,'login']);


Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::post('/set-account',[CustomerApiController::class,'moreAccount']);
    Route::post('/v2/set-account',[CustomerApiController::class,'moreAccountV2']);
    Route::post('/customer-info',[CustomerApiController::class,'customerInfo']);
    Route::post('/logout-customer',[CustomerApiController::class,'logout']);
    Route::post('/change-password',[CustomerApiController::class,'changePassword']);
    Route::post('/profileupload',[CustomerApiController::class,'profileupload']);
    Route::post('/background-upload',[CustomerApiController::class,'backgroundUpload']);

    Route::post('sell-2d3d4d5d6d',[BillOrderApiController::class,'sell2d3d4d5d6d']);
    Route::post('sell-340',[BillOrderApiController::class,'sell340']);
    Route::post('history-bill',[BillOrderApiController::class,'billAll']);
    Route::post('history-bill-wining',[BillOrderApiController::class,'billAllWin']);
    Route::post('history-bill-detail',[BillOrderApiController::class,'billDetail']);
    Route::post('bill6d-customer',[BillOrderApiController::class,'bill6dCustomer']);
    Route::post('bill340-customer',[BillOrderApiController::class,'bil340Customer']);

//    Route::post('sell-6d',[BillApiController::class,'sell6d']);
//    Route::post('sell-340',[BillApiController::class,'sell340']);
//    Route::post('history-bill',[BillApiController::class,'billList']);
//    Route::post('history-bill-detail',[BillApiController::class,'billDetail']);
//    Route::post('history-bill-wining',[BillApiController::class,'billWining']);

    Route::post('pull-result',[ResultApiController::class,'pullResult']);
    Route::post('show-result',[ResultApiController::class,'showResult']);
    Route::post('filter-result',[ResultApiController::class,'filterResult']);



    Route::post('animal-list',[AnimalApiController::class,'animalList']);
    Route::post('animal-category',[AnimalApiController::class,'animalCategory']);

    Route::post('promotion',[PromotionApiController::class,'promotionList']);
    Route::post('filter-promotion',[PromotionApiController::class,'promotionFilter']);

    Route::post('recommend-lotto',[RecommendApiLottoController::class,'recommendList']);

    Route::post('dream-teller',[DreamTellerApiController::class,'dreamTellerList']);

    Route::post('notification',[NotificationApiController::class,'notificationList']);
    Route::post('notification-buying',[NotificationApiController::class,'notificationBuying']);
    Route::post('notification-wining',[NotificationApiController::class,'notificationWining']);
    Route::post('notification-result',[NotificationApiController::class,'notificationResult']);
    Route::post('notification-promotion',[NotificationApiController::class,'notificationPromotion']);
    Route::post('notification-news',[NotificationApiController::class,'notificationNews']);

    //save order
    Route::post('saveOrder',[SaveOrderController::class,'saveOrder6d']);
    Route::post('updateIdOrder',[SaveOrderController::class,'update6d']);
    Route::post('updateCustomerOrder',[SaveOrderController::class,'updateUser6d']);
    Route::post('deleteIdOrder',[SaveOrderController::class,'deleteId6d']);
    Route::post('deleteCustomerOrder',[SaveOrderController::class,'DeleteUser6d']);
    Route::post('getSaveOrder',[SaveOrderController::class,'getSaveOrder']);

    //google map list
    Route::post('google-map',[GoogleMapApiController::class,'index']);

    //fortune
    Route::post('temple-list',[FortuneApiController::class,'templeList']);
    Route::post('get-paper-fortune',[FortuneApiController::class,'getPaperFortune']);


    //push notification for ipro call
    Route::post("push-notification-buy",[PushNotificationApiController::class,"notificationBuyForAllChanel"]);


    //Expense
    Route::post('type-expense',[TypeExpenseApiController::class,'typeExpenseList']);
    Route::post('create-type-expense',[TypeExpenseApiController::class,'createTypeExpense']);
    Route::post('edit-type-expense',[TypeExpenseApiController::class,'editTypeExpense']);
    Route::post('delete-type-expense',[TypeExpenseApiController::class,'deleteTypeExpense']);

    Route::post('expense-list',[ExpenseApiController::class,'expenseDataCustomer']);
    Route::post('create-expense',[ExpenseApiController::class,'createExpense']);
    Route::post('delete-expense',[ExpenseApiController::class,'deleteExpense']);
    Route::post('edit-expense',[ExpenseApiController::class,'editExpense']);


    //News
    Route::post('news-list',[NewsApiController::class,'newsList']);

    //Live link
    Route::post('live-link',[LiveLinkApiController::class,'liveLink']);

    //Method buy
    Route::post('method-buy',[MedthodBuyApiController::class,'methodBuy']);

    //Astrological
    Route::post('astrological',[AstrologicalApiController::class,'astrological']);

    //Random Digit
    Route::post('random-digit',[RandomDigitApiController::class,'randomDigit']);

    //Top search
    Route::post('dream-search-list',[RecordSearchApiController::class,'dreamSearchList']);
    Route::post('record-dream-search',[RecordSearchApiController::class,'recordSearch']);

    //History bill
    Route::post('history-bill-channel',[HistoryBillApiController::class,'history']);
    Route::post('get-all-draw',[HistoryBillApiController::class,'getDraws']);

});
//read me
});
//Bill order

