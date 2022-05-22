<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
  /**
   * コメント投稿
   *
   * @param Request $request
   * @param Post $post
   * @return void
   */
  public function store(CommentRequest $request, Post $post)
  {
    try {
      DB::beginTransaction();
      $comment = Comment::createComment($request, $post);
      DB::commit();
      return response()->json(['data' => $comment], 201);
    } catch (\Throwable $e) {
      DB::rollback();
      Log::error($e);
      throw $e;
    }
  }
}
