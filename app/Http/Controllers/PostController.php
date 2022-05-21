<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
  /**
   * ホーム画面の投稿一覧
   *
   * @param Post $post
   * @return void
   */
  public function index()
  {
    try {
      $item = Post::getPostList();
      return response()->json(['data' => $item], 200);
    } catch (\Throwable $e) {
      // 全てのエラー・例外をキャッチしてログに残す
      Log::error($e);
      // フロントに異常を通知するため例外はそのまま投げる
      throw $e;
    }
  }

  /**
   * ホーム画面の投稿作成
   *
   * @param PostRequest $request
   * @return void
   */
  public function store(PostRequest $request)
  {
    try {
      DB::beginTransaction();
      $post = Post::createPost($request);
      DB::commit();
      return response()->json(['data' => $post], 201);
    } catch (\Throwable $e) {
      DB::rollback();
      Log::error($e);
      throw $e;
    }
  }

  /**
   * コメントページの投稿を表示
   *
   * @param Post $post
   * @return void
   */
  public function show(Post $post)
  {
    try {
      $post = Post::showPost($post);
      if ($post) {
        return response()->json(['post' => $post], 200);
      } else {
        return response()->json(['message' => 'Not found'], 404);
      }
    } catch (\Throwable $e) {
      Log::error($e);
      throw $e;
    }
  }

  /**
   * ホーム画面の投稿削除
   *
   * @param Post $post
   * @return void
   */
  public function destroy(Post $post)
  {
    try {
      DB::beginTransaction();
      $item = Post::deletePost($post);
      DB::commit();
      if ($item) {
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
