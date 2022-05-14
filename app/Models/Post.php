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
}
