<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;

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
    $item = Post::with(['users', 'likes'])->get();
    return response()->json(['data' => $item], 200);
  }

  /**
   * ホーム画面の投稿作成
   *
   * @param Request $request
   * @return void
   */
  public function store(PostRequest $request)
  {
    $user_id = User::where('uid', $request->uid)->pluck('id');

    $post = new Post();
    $post->user_id = $user_id[0];
    $post->text = $request->text;
    $post->save();

    return response()->json(['data' => $post], 201);
  }

  /**
   * ホーム画面の投稿削除
   *
   * @param Post $post
   * @return void
   */
  public function destroy(Post $post)
  {
    $item = Post::where('id', $post->id)->delete();
    if ($item) {
      return response()->json(['message' => 'Deleted successfully'], 200);
    } else {
      return response()->json(['message' => 'Not found'], 404);
    }
  }
}
