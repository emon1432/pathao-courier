<?php

use App\Http\Controllers\PathaoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/store-list', [PathaoController::class, 'getStores']);
Route::get('/city-list', [PathaoController::class, 'getCityList']);
Route::get('/zone-list/{cityId}', [PathaoController::class, 'getZoneList']);
Route::get('/area-list/{zoneId}', [PathaoController::class, 'getAreaList']);
Route::get('/price', [PathaoController::class, 'getPrice']);

Route::get('/create-view', function () {
    return view('create');
});

Route::post('/create-order', [PathaoController::class, 'createOrder'])->name('create-order');
