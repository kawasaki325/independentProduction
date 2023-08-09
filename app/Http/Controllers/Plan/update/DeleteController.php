<?php

namespace App\Http\Controllers\Plan\update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;

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
        $goal_id = $request->route('plan');
        // 該当のgoalを取得
        $goal = Goal::where('id', $goal_id)->firstOrFail();
        // フラッシュメッセージを作成
        $message = "{$goal->content}を削除しました";
        // 削除実行
        $goal->delete();

        return redirect()
            ->route('home')
            ->with('feedback.success', $message);
    }
}
