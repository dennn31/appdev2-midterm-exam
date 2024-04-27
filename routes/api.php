<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\ProductAccessMiddleware;

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

Route::apiResource('products', ProductController::class);



Route::post('/get', function () {
    return response()->json(['message' => 'Product Stored']);
})->middleware(ProductAccessMiddleware::class); 

Route::put('/update/{id}', function ($id) {
    return response()->json(['message' => 'Existing Product $ID updated']);
})->middleware(ProductAccessMiddleware::class);

Route::delete('/delete/{id}', function ($id) {
    return response()->json(['message' => 'Existing Product $ID deleted']);
})->middleware(ProductAccessMiddleware::class);


