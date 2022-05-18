<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;

class CommentController extends Controller
{
  /**
   * コメント一覧
   *
   * @param Post $post
   * @return void
   */
  public function index(Post $post)
  {
    $comments = Comment::with('users')->where('post_id', $post->id)->get();

    return response()->json(['comments' =>  $comments], 200);
  }

  /**
   * コメント投稿
   *
   * @param Request $request
   * @param Post $post
   * @return void
   */
  public function store(CommentRequest $request, Post $post)
  {
    $user_id = User::where('uid', $request->uid)->pluck('id');

    $comment = new Comment();
    $comment->user_id = $user_id[0];
    $comment->post_id = $post->id;
    $comment->comment = $request->comment;
    $comment->save();

    return response()->json(['data' => $comment], 201);
  }
}
