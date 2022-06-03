<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;



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

// CATEGORY 
Route::get('/category', [CategoryController::class, 'index'] );
Route::get('/category/{id}', [CategoryController::class, 'show'] );

Route::post('/category', [CategoryController::class, 'store'] );

Route::put('/category/{id}', [CategoryController::class, 'update'] );
Route::delete('/category/{id}', [CategoryController::class, 'destroy'] );


// POST 
Route::get('post', [PostController::class, 'index']);
Route::get('post/{id}', [PostController::class, 'show']);

Route::post('post', [PostController::class, 'store']);
Route::put('post/{id}', [PostController::class, 'update']);
Route::delete('post/{id}', [PostController::class, 'destroy']);

// COMMENT 


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
