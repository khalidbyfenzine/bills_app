<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome'); 
});*/

Route::get('/', [BillController::class, 'index']);
Route::delete('/selected-bills',[BillController::class,'deletechecked'])->name('bill.deleteSelected');
Route::resource('bills', BillController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('service', ServiceController::class);
Route::get('/export_bill', [BillController::class, 'export_bill'])->name('export_bill');
Route::get('/search', [BillController::class,'search']);
