<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*private routes*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    
Route::post('/products', [\App\Http\Controllers\ProductController::class, 'store']);
Route::put('/products/{product}', [\App\Http\Controllers\ProductController::class, 'update']);
Route::delete('/products/{product}', [\App\Http\Controllers\ProductController::class, 'destroy']);

#add logout route
Route::post('/logout', [AuthController::class, 'logout']);
  
 
});

/*public routes*/

Route::post('/register', [AuthController::class, 'register']);
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);
Route::get('/products/{product}', [\App\Http\Controllers\ProductController::class, 'show']);
Route::get('/products/search/{search}', [\App\Http\Controllers\ProductController::class, 'search']);


# add login route
Route::post('/login', [AuthController::class, 'login']);


