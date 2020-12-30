<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');


});
Route::get('/customers',[Customercontroller::class,'customerList'])->name('customer.list');
Route::post('customers',[CustomerController::class,'customerStore'])->name('customer.store');


require __DIR__.'/auth.php';
