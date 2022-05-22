<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
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
//ユーザー登録
Route::post('/register', [AuthController::class, 'register']);

//投稿CRUD
Route::apiResource('/posts', PostController::class)->only(['index', 'destroy', 'store', 'show']);

//コメント
Route::apiResource('/posts/{post}/comments', CommentController::class)->only(['index', 'store']);

//いいね
Route::apiResource('/likes', LikeController::class)->only(['destroy', 'store']);
