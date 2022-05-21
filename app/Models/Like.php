<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'uid'
    ];

    /**
     * postsテーブルとのリレーション
     *
     * @return void
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * いいね登録
     *
     * @param Request $request
     * @param Post $post
     * @return void
     */
    public static function createLike($request, $post)
    {
        $user_id = User::where('uid', $request->uid)->pluck('id');

        $like = Like::create([
            'id'      => $request->id,
            'post_id' => $post->id,
            'user_id' => $user_id[0],
            'uid'     => $request->uid,
        ]);

        return $like;
    }

    /**
     * いいね削除
     *
     * @param Request $request
     * @param Post $post
     * @return void
     */
    public static function deleteLike($request, $post)
    {
        $like = Like::where('post_id', $post->id)->where('uid', $request->uid)->first();
        $like->delete();
        return $like;
    }
}
