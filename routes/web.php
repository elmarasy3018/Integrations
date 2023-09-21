<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleSheetController;
use App\Http\Controllers\ShopifyController;
use App\Http\Controllers\WoocommerceController;

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

Route::get('/google-sheet', [GoogleSheetController::class, 'index']);
Route::post('/google-sheet', [GoogleSheetController::class, 'fetchData']);

Route::get('/shopify', [ShopifyController::class, 'index']);
Route::post('/shopify', [ShopifyController::class, 'fetchData']);

Route::get('/woocommerce', [WoocommerceController::class, 'index']);
Route::post('/woocommerce', [WoocommerceController::class, 'fetchData']);