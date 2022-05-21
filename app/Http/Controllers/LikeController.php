<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class LikeController extends Controller
{
  /**
   * いいね登録
   *
   * @return void
   */
  public function like(Request $request, Post $post)
  {
    try {
      DB::beginTransaction();
      $like = Like::createLike($request, $post);
      DB::commit();
      return response()->json(['data' => $like], 201);
    } catch (\Throwable $e) {
      DB::rollback();
      Log::error($e);
      //フロントにエラーを投げる
      throw $e;
    }
  }

  /**
   * いいね取り消し
   *
   * @param Post $post
   * @return void
   */
  public function unlike(Request $request, Post $post)
  {
    try {
      DB::beginTransaction();
      $like = Like::deleteLike($request, $post);
      DB::commit();
      if ($like) {
        return response()->json(['message' => 'Deleted successfully'], 200);
      } else {
        return response()->json(['message' => 'Not found'], 404);
      }
    } catch (\Throwable $e) {
      DB::rollback();
      Log::error($e);
      throw $e;
    }
  }
}
