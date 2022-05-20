<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;


class LikeController extends Controller
{
  /**
   * いいね登録
   *
   * @return void
   */
  public function like(Request $request, Post $post)
  {
    $user_id = User::where('uid', $request->uid)->pluck('id');

    $like = Like::create([
      'id'      => $request->id,
      'post_id' => $post->id,
      'user_id' => $user_id[0],
      'uid'     => $request->uid,
    ]);

    return response()->json(['data' => $like], 201);
  }

  /**
   * いいね取り消し
   *
   * @param Post $post
   * @return void
   */
  public function unlike(Request $request, Post $post)
  {
    $like = Like::where('post_id', $post->id)->where('uid', $request->uid)->first();
    $like->delete();

    if ($like) {
      return response()->json(['message' => 'Deleted successfully'], 200);
    } else {
      return response()->json(['message' => 'Not found'], 404);
    }
  }
}
