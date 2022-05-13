<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;

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
//認証
Route::post('/register', [AuthController::class, 'register']);
Route::get('/user', [AuthController::class, 'me']);

//投稿CRUD
Route::apiResource('/post', PostController::class)->only(['index', 'destroy', 'store']);
