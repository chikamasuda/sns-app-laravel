<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
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

    return response()->json(['user' => $user], 201);
  }
}
