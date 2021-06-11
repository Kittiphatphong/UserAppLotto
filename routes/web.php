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
use App\Http\Controllers\BillOrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TermConditionController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DristricController;
use App\Http\Controllers\ImageAppController;
use App\Http\Controllers\GoogleMapController;
use App\Http\Controllers\Partnercontroller;
use App\Http\Controllers\TempleController;
use App\Http\Controllers\FortuneController;
use App\Http\Controllers\TypeExpenseController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LiveLinkController;
use App\Http\Controllers\MethodBuyController;
use App\Http\Controllers\ZodiacController;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
})->name('lang');
Route::group(['middleware' =>'auth'],function(){


//    Route::get('activity',function (){
//        return \Spatie\Activitylog\Models\Activity::all()->last();
//    });



    Route::get('/dashboard', [DashboardController::class,'dashboard'])
        ->name('dashboard');
//    Route::get('/buy-lotto',[BuyLottoController::class,'buy'])->name('buy.buy');
//    Route::post('/buy-lotto-6d',[BuyLottoController::class,'store6d'])->name('buy.store6d');
//    Route::post('/buy-lotto-40',[BuyLottoController::class,'store40'])->name('buy.store40');

//User
    Route::group(['middleware' => ['permission:users management']], function () {
        Route::resource('/users',UserController::class);
        Route::get('/role',[UserController::class,'role'])->name('users.role');
        Route::get('/newRole',[UserController::class,'newRole'])->name('new.role');
        Route::post('/newRole',[UserController::class,'storePermission'])->name('store.permission');
        Route::get('/editRole/{id}',[UserController::class,'editRole'])->name('edit.role');
        Route::post('/editRole/{id}',[UserController::class,'updatePermission'])->name('update.permission');
    });


//Customer
    Route::group(['middleware'=>['permission:customer register']],function(){
        Route::get('/customer-register',[CustomerController::class,'customerRegister'])->name('customer.register');
        Route::post('customers',[CustomerController::class,'customerStore'])->name('customer.store');
    });
    Route::get('/customers',[Customercontroller::class,'customerList'])->name('customer.list')->middleware('permission:customer list');
    Route::post('/customer-delete/{id}',[CustomerController::class,'customerDelete'])->name('customer.delete')->middleware('permission:customer delete');


//Bill order
    Route::group(['middleware'=>['permission:bills']],function() {
        Route::get('/bill6d', [BillOrderController::class, 'bill6d'])->name('bill.2d3d4d5d6d');
        Route::get('/bill340', [BillOrderController::class, 'bill340'])->name('bill.340');
    });

//    Route::get('/bill6d',[BillController::class,'bill6d'])->name('bill.2d3d4d5d6d');
//    Route::get('/bill340',[BillController::class,'bill340'])->name('bill.340');


//Winner
    Route::group(['middleware'=>['permission:winner']],function() {
    Route::get('win-2d3d4d5d6d',[WinnerController::class,'win2d3d4d5d6d'])->name('win.2d3d4d5d6d');
    Route::get('win-340',[WinnerController::class,'win340'])->name('win.340');
    });

//Promotion
    Route::group(['middleware'=>['permission:promotion new']],function() {
        Route::get('promotion-create', [PromotionController::class, 'promotionCreate'])->name('promotion.create');
        Route::post('promotion-create', [PromotionController::class, 'promotionStore'])->name('promotion.store');
    });
    Route::get('promotion-list',[PromotionController::class,'promotionList'])->name('promotion.list')->middleware('permission:promotion list');
    Route::group(['middleware'=>['permission:promotion edit']],function() {
        Route::get('promotion-edit/{id}', [PromotionController::class, 'promotionEdit'])->name('promotion.edit');
        Route::post('promotion-edit/{id}', [PromotionController::class, 'promotionUpdate'])->name('promotion.update');
    });
    Route::post('promotion-delete/{id}',[PromotionController::class,'promotionDelete'])->name('promotion.delete')->middleware('permission:promotion delete');
    Route::post('promotion-notification/{id}',[PromotionController::class,'promotionNotification'])->name('promotion.notification')->middleware('permission:promotion notification');


//Result
    Route::get('result-list',[ResultController::class,'resultList'])->name('result.list')->middleware('permission:result list');
    Route::post('result-store',[ResultController::class,'resultStore'])->name('result.store')->middleware('permission:result put');
    Route::group(['middleware'=>['permission:result action']],function() {
        Route::post('result-delete/{id}', [ResultController::class, 'resultDelete'])->name('result.delete');
        Route::get('win-store/{id}', [ResultController::class, 'winStore'])->name('win.store');
        Route::post('win-restore/{id}', [ResultController::class, 'winRestore'])->name('win.restore');
    });

//Recommend lotto

    Route::get('recommend-list',[RecommentLottoController::class,'recommendList'])->name('recommend.list')->middleware('permission:recommend list');
    Route::group(['middleware'=>['permission:recommend new']],function() {
        Route::get('recommend-create', [RecommentLottoController::class, 'recommendCreate'])->name('recommend.create');
        Route::post('recommend-create', [RecommentLottoController::class, 'recommendStore'])->name('recommend.store');
    });
    Route::group(['middleware'=>['permission:recommend edit']],function() {
        Route::get('recommend-edit/{id}', [RecommentLottoController::class, 'recommendEdit'])->name('recommend.edit');
        Route::post('recommend-update/{id}', [RecommentLottoController::class, 'recommendUpdate'])->name('recommend.update');
    });
    Route::post('recommend-delete/{id}',[RecommentLottoController::class,'recommendDelete'])->name('recommend.delete')->middleware('permission:recommend delete');

//40 Animal
    Route::get('animal-list',[AnimalController::class,'animalList'])->name('animal.list')->middleware('permission:animal list');
    Route::group(['middleware'=>['permission:animal new']],function() {
        Route::get('animal-create', [AnimalController::class, 'animalCrate'])->name('animal.create');
        Route::post('animal-create', [AnimalController::class, 'animalStore'])->name('animal.store');
    });
    Route::group(['middleware'=>['permission:animal edit']],function() {
        Route::get('animal-edit/{id}', [AnimalController::class, 'animalEdit'])->name('animal.edit');
        Route::post('animal-update/{id}', [AnimalController::class, 'animalUpdate'])->name('animal.update');
    });
//Dream Teller
   Route::resource('dream-teller',DreamTellerController::class,[
       'only' => ['index', 'create','store','update','edit','destroy']
   ]);

//Notification
    Route::get('notification-type',[NotificationController::class,'notificationType'])->name('notification.type')->middleware('permission:notification type list');
    Route::group(['middleware'=>['permission:notification type new']],function() {
        Route::get('notification-icon', [NotificationController::class, 'notificationIcon'])->name('notification.icon');
        Route::post('notification-icon', [NotificationController::class, 'notificationStore'])->name('notification.store');
    });
    Route::group(['middleware'=>['permission:notification type edit']],function() {
        Route::get('notification-icon-edit/{id}', [NotificationController::class, 'notificationIconEdit'])->name('notification.icon.edit');
        Route::post('notification-icon-edit/{id}', [NotificationController::class, 'notificationUpdate'])->name('notification.update');
    });
   Route::get('notification-list',[NotificationController::class,'notificationList'])->name('notification.list')->middleware('permission:notification transaction');

    //Provider
    Route::group(['middleware'=>['permission:provider management']],function() {
        Route::get('/provider', [ProviderController::class, 'providerList'])->name('provider.list');
        Route::post('/provider', [ProviderController::class, 'providerStore'])->name('provider.store');
    });

    //Log database
    Route::get('log',[LogController::class,'index'])->name('log.index');
    //Log Api
    Route::get('log-api',[LogController::class,'indexApi'])->name('log.index.api');

    //Term and condition
    Route::resource('term-condition',TermConditionController::class);

    //Province and dristric
    Route::resource('province',ProvinceController::class);
    Route::resource('district',DristricController::class);

    //Background image app
    Route::resource('image-app',ImageAppController::class);
    Route::post('active-background/{id}',[ImageAppController::class,'active'])->name('image-app.active');

    //Google map
    Route::resource('google-map',GoogleMapController::class);
    //Partner
    Route::resource('partner',Partnercontroller::class);
    //Temple
    Route::resource('temple',TempleController::class);
    //Fortune
    Route::resource('fortune',FortuneController::class);
    Route::get('update-status-temple/{id}',[FortuneController::class,'changeStatus'])->name('temple.status');

    //Expense
    Route::resource('expense-type',TypeExpenseController::class);

    //News
    Route::resource('news',NewsController::class);

    //Live link
    Route::resource('live-link',LiveLinkController::class);

    //How to buy
    Route::resource('method-buy',MethodBuyController::class);

    //Horoscope

    Route::resource('zodiac',ZodiacController::class);
});


Route::get('test/{draw}',[\App\Http\Controllers\PushNotificationController::class,'pushNotificationWin']);
require __DIR__.'/auth.php';
