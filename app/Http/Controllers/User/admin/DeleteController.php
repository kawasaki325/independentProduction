<?php

namespace App\Http\Controllers\User\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // ルートからidを取得
        $user_id = $request->route('user_id');
        // 該当のgoalを取得
        $user = User::where('id', $user_id)->firstOrFail();
        // フラッシュメッセージを作成
        $message = "{$user->name}を削除しました";
        // 削除実行
        $user->delete();

        return redirect()
            ->route('admin')
            ->with('feedback.success', $message);
    }
}
