<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class LikeController extends Controller
{
    /**
     * いいねされてるか判定するメソッド
     *
     * @param User|null $user
     * @return boolean
     */
    public function isLikedBy(Request $request)
    {
        $user_id = $request->user_id;
        $post_id = $request->post_id;

        if ($user_id) {
            $post = Post::find($post_id)->likes->first();
            $result = (bool)$post->whereHas('likes',  function ($query) use ($user_id) {
                $query->where('likes.user_id', $user_id);
            })->count();
            return response()->json(['data' => $result], 200);
        } else {
            $result = false;
            return response()->json(['data' => $result], 200);
        }
    }
}
