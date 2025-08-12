<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function() {
    Route::get('/', [ProductsController::class, 'getProducts']);
    Route::put('create', [ProductsController::class, 'createProduct']);
    Route::prefix('/{product}')->group(function() {
        Route::patch('/update', [ProductsController::class, 'updateProduct']);
        Route::delete('/delete', [ProductsController::class, 'deleteProduct']);
    });
    Route::get('/category/{product:category}', [ProductsController::class, 'getProductsByCategory']);
});
Route::fallback(function(){
    return response()->json(['message' => '<your message>'], 404);
});
