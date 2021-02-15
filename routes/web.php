<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\WinnerController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RecommentLottoController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\DreamTellerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\BuyLottoController;
Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' =>'auth'],function(){
    Route::get('/dashboard', [DashboardController::class,'dashboard'])
        ->name('dashboard');


    Route::get('/buy-lotto',[BuyLottoController::class,'buy'])->name('buy.buy');
    Route::post('/buy-lotto-6d',[BuyLottoController::class,'store6d'])->name('buy.store6d');
    Route::post('/buy-lotto-40',[BuyLottoController::class,'store40'])->name('buy.store40');

    Route::get('/customers',[Customercontroller::class,'customerList'])->name('customer.list');

    Route::get('/customer-register',[CustomerController::class,'customerRegister'])->name('customer.register');
    Route::post('customers',[CustomerController::class,'customerStore'])->name('customer.store');
    Route::post('/customer-delete/{id}',[CustomerController::class,'customerDelete'])->name('customer.delete');


//Bill order
    Route::get('/bill6d',[BillController::class,'bill6d'])->name('bill.2d3d4d5d6d');
    Route::get('/bill340',[BillController::class,'bill340'])->name('bill.340');

//Provider
    Route::get('/provider',[ProviderController::class,'providerList'])->name('provider.list');
    Route::post('/provider',[ProviderController::class,'providerStore'])->name('provider.store');

//Winner
    Route::get('win-2d3d4d5d6d',[WinnerController::class,'win2d3d4d5d6d'])->name('win.2d3d4d5d6d');
    Route::get('win-340',[WinnerController::class,'win340'])->name('win.340');

//Result
    Route::get('result-list',[ResultController::class,'resultList'])->name('result.list');
    Route::post('result-store',[ResultController::class,'resultStore'])->name('result.store');
    Route::post('result-delete/{id}',[ResultController::class,'resultDelete'])->name('result.delete');
    Route::get('win-store/{id}',[ResultController::class,'winStore'])->name('win.store');
    Route::post('win-restore/{id}',[ResultController::class,'winRestore'])->name('win.restore');

//Promotion
    Route::get('promotion-list',[PromotionController::class,'promotionList'])->name('promotion.list');
    Route::get('promotion-create',[PromotionController::class,'promotionCreate'])->name('promotion.create');
    Route::post('promotion-create',[PromotionController::class,'promotionStore'])->name('promotion.store');
    Route::get('promotion-edit/{id}',[PromotionController::class,'promotionEdit'])->name('promotion.edit');
    Route::post('promotion-edit/{id}',[PromotionController::class,'promotionUpdate'])->name('promotion.update');
    Route::post('promotion-delete/{id}',[PromotionController::class,'promotionDelete'])->name('promotion.delete');
    Route::post('promotion-notification/{id}',[PromotionController::class,'promotionNotification'])->name('promotion.notification');

//Recommend lotto

    Route::get('recommend-list',[RecommentLottoController::class,'recommendList'])->name('recommend.list');
    Route::get('recommend-create',[RecommentLottoController::class,'recommendCreate'])->name('recommend.create');
    Route::post('recommend-create',[RecommentLottoController::class,'recommendStore'])->name('recommend.store');
    Route::get('recommend-edit/{id}',[RecommentLottoController::class,'recommendEdit'])->name('recommend.edit');
    Route::post('recommend-update/{id}',[RecommentLottoController::class,'recommendUpdate'])->name('recommend.update');
    Route::post('recommend-delete/{id}',[RecommentLottoController::class,'recommendDelete'])->name('recommend.delete');

//40 Animal
    Route::get('animal-list',[AnimalController::class,'animalList'])->name('animal.list');
    Route::get('animal-create',[AnimalController::class,'animalCrate'])->name('animal.create');
    Route::post('animal-create',[AnimalController::class,'animalStore'])->name('animal.store');
    Route::get('animal-edit/{id}',[AnimalController::class,'animalEdit'])->name('animal.edit');
    Route::post('animal-update/{id}',[AnimalController::class,'animalUpdate'])->name('animal.update');

//Dream Teller
   Route::resource('dream-teller',DreamTellerController::class,[
       'only' => ['index', 'create','store','update','edit','destroy']
   ]);

//Notification
   Route::get('notification-list',[NotificationController::class,'notificationList'])->name('notification.list');
   Route::get('notification-type',[NotificationController::class,'notificationType'])->name('notification.type');
   Route::get('notification-icon',[NotificationController::class,'notificationIcon'])->name('notification.icon');
   Route::post('notification-icon',[NotificationController::class,'notificationStore'])->name('notification.store');
    Route::get('notification-icon-edit/{id}',[NotificationController::class,'notificationIconEdit'])->name('notification.icon.edit');
    Route::post('notification-icon-edit/{id}',[NotificationController::class,'notificationUpdate'])->name('notification.update');
});


Route::get('test/{draw}',[\App\Http\Controllers\PushNotificationController::class,'pushNotificationWin']);
require __DIR__.'/auth.php';
