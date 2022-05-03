<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * ログイン
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        //該当するUserモデルを取得する。
        $user = User::find(['uid' => $request->uid]);

        //ログイン
        Auth::login($user);

        return response()->json(['message' => 'ログインに成功しました'], 200);
    }

    /**
     * ユーザーの作成・保存
     *
     * @param User $user
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        $user = User::create($request->all());
        Auth::login($user);

        return response()->json(['data' => $user], 201);
    }

    /**
     * ログアウト
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['message' => 'ログアウトしました'], 200);
    }

    /**
     * ユーザー情報を返す
     *
     * @return void
     */
    public function me()
    {
        $user = auth()->user();

        return response()->json(compact('user'), 200);
    }
}
