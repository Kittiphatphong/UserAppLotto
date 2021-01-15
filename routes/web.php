<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillOrderController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\WinnerController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\PromotionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' =>'auth'],function(){
    Route::get('/dashboard', function () {
        return view('dashboard')->with('dashboard','dashboard');})
        ->name('dashboard');


    Route::get('/customers',[Customercontroller::class,'customerList'])->name('customer.list');

    Route::get('/customer-register',[CustomerController::class,'customerRegister'])->name('customer.register');
    Route::post('customers',[CustomerController::class,'customerStore'])->name('customer.store');
    Route::post('/customer-delete/{id}',[CustomerController::class,'customerDelete'])->name('customer.delete');


//Bill order
    Route::get('/bill2d3d4d5d6d',[BillOrderController::class,'bill2d3d4d5d6d'])->name('bill.2d3d4d5d6d');
    Route::get('/bill340',[BillOrderController::class,'bill340'])->name('bill.340');

//Provider
    Route::get('/provider',[ProviderController::class,'providerList'])->name('provider.list');
    Route::post('/provider',[ProviderController::class,'providerStore'])->name('provider.store');

//Winner
    Route::get('win-2d3d4d5d6d',[WinnerController::class,'win2d3d4d5d6d'])->name('win.2d3d4d5d6d');
    Route::get('win-340',[WinnerController::class,'win340'])->name('win.340');

//Result
    Route::get('result-list',[ResultController::class,'resultList'])->name('result.list');
    Route::post('result-store',[ResultController::class,'resultStore'])->name('result.store');
    Route::get('win-store/{id}',[ResultController::class,'winStore'])->name('win.store');
    Route::get('win-restore/{id}',[ResultController::class,'winRestore'])->name('win.restore');

//Promotion
    Route::get('promotion-list',[PromotionController::class,'promotionList'])->name('promotion.list');
    Route::get('promotion-create',[PromotionController::class,'promotionCreate'])->name('promotion.create');
    Route::post('promotion-create',[PromotionController::class,'promotionStore'])->name('promotion.store');


});

require __DIR__.'/auth.php';
