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
}
