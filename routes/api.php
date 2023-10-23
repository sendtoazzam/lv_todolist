<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TasksController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;

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


Route::post('register', [UserController::class, 'register']);
Route::post('auth/login', [UserController::class, 'authenticate']);
     
Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);
    Route::resource('tasks', TasksController::class);

    Route::get('/tasks', [TasksController::class, 'index']);
    Route::prefix('/task')->group(function(){
        Route::post('/create',[TasksController::class, 'store']);
        Route::prefix('/manage')->group(function(){
            Route::put('/{id}' , [TasksController::class, 'update']);
            Route::delete('/{id}', [TasksController::class, 'destroy'] );
        });
    });
});