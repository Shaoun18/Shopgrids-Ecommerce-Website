<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-trending-product', [ApiController::class, 'getAllTrendingProduct']);
Route::get('get-category-product', [ApiController::class, 'getAllCategoryProduct']);
Route::get('get-category-product-bi-id/{id}', [ApiController::class, 'getAllCategoryProductID']);
Route::get('product-by-id/{id}', [ApiController::class, 'getProductByID'])->name('product-by-id');

Route::post('new-order', [ApiController::class, 'newOrder'])->name('new-order');
Route::post('customer-logout', [ApiController::class, 'Logout'])->name('customer-logout');
