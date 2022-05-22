<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;

class Post extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'text',
  ];

  /**
   * ユーザーテーブルとのリレーション
   *
   * @return void
   */
  public function users()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * お気に入りテーブルとのリレーション
   *
   * @return void
   */
  public function likes()
  {
    return $this->hasMany(Like::class);
  }

  /**
   * コメントテーブルとのリレーション
   *
   * @return void
   */
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  /**
   * 投稿一覧取得
   *
   * @return void
   */
  public static function getPostList()
  {
    $item = Post::with(['users', 'likes'])->get();

    return $item;
  }

  /**
   * 新規投稿作成
   *
   * @param Request $request
   * @return void
   */
  public static function createPost($request)
  {
    $user_id = User::where('uid', $request->uid)->pluck('id');

    $post = Post::create([
      'id'      => $request->id,
      'user_id' => $user_id[0],
      'text'    => $request->text,
    ]);

    return $post;
  }

  /**
   * コメント欄の投稿の表示
   *
   * @param Post $post
   * @return void
   */
  public static function showPost($post)
  {
    $post = Post::with(['users', 'likes', 'comments', 'comments.users'])
      ->where('id', $post->id)
      ->first();

    return $post;
  }

  /**
   * 投稿削除
   *
   * @param Post $post
   * @return void
   */
  public static function deletePost($post)
  {
    $post = Post::where('id', $post->id)->delete();
    return $post;
  }
}
