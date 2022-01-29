<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;

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

Route::controller(PostsController::class)->group(function () {
    Route::get('/posts', 'index');
    Route::get('/posts/{posts}', 'show');
    Route::post('/posts', 'store');
    Route::patch('/posts/{posts}', 'update');
    Route::delete('/posts/{posts}', 'destroy');
});

Route::controller(CommentsController::class)->group(function () {
    Route::get('/posts/{posts}/comments', 'index');
    Route::get('/posts/{posts}/comments/{comments}', 'show');
    Route::post('/posts/{posts}/comments', 'store');
    Route::patch('/posts/{posts}/comments/{comments}', 'update');
    Route::delete('/posts/{posts}/comments/{comments}', 'destroy');
});
