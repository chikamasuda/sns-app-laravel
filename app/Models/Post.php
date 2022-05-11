<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * お気に入りテーブルとのリレーション
     *
     * @return void
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    /**
     * いいねされてるか判定するメソッド
     *
     * @param User|null $user
     * @return boolean
     */
    public function isLikedBy($uid): bool
    {
        return $uid ? (bool)$this->likes->where('uid', $uid)->count() : false;
    }
}
