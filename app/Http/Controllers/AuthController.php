<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    try {
      DB::beginTransaction();
      $user = User::register($request);
      DB::commit();
      return response()->json(['data' => $user], 201);
    } catch (\Throwable $e) {
      DB::rollback();
      // 全てのエラー・例外をキャッチしてログに残す
      Log::error($e);
      // フロントに異常を通知するため例外はそのまま投げる
      throw $e;
    }
  }
}
