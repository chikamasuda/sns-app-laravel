<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    use HasFactory;

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
     * postsテーブルとのリレーション
     *
     * @return void
     */
    public function posts()
    {
        return $this->belongsTo(User::class, 'post_id');
    }

    /**
     * コメント一覧取得
     *
     * @param Post $post
     * @return void
     */
    public static function getComments($post)
    {
        $comments = Comment::with('users')->where('post_id', $post->id)->get();
        return $comments;
    }

    /**
     * コメント追加
     *
     * @param Request $request
     * @param Post $post
     * @return void
     */
    public static function createComment($request, $post)
    {
        $user_id = User::where('uid', $request->uid)->pluck('id');

        $comment = Comment::create([
            'id'      => $request->id,
            'user_id' => $user_id[0],
            'post_id' => $post->id,
            'comment' => $request->comment,
        ]);

        return $comment;
    }
}
