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
    public static function createLike($request)
    {
        $like = Like::create($request->all());

        return $like;
    }

    /**
     * いいね削除
     *
     * @param Request $request
     * @param Post $post
     * @return void
     */
    public static function deleteLike($like)
    {
        $like = Like::where('id', $like->id)->first();
        $like->delete();
        return $like;
    }
}
