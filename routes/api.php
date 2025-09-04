<?php

use App\Http\Controllers\Modules\SalesApi\ItemApiController;
use App\Http\Controllers\Modules\SalesApi\OrderApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::apiResource('sales/item', ItemApiController::class);
Route::apiResource('sales/order', OrderApiController::class); 
Route::get('sales/order/{order}/items',[OrderApiController::class,'order_items']);