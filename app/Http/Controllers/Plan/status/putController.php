<?php

namespace App\Http\Controllers\Plan\status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\Price;

class putController extends Controller
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
        if($goal->status === 'normal') {
            // フラッシュメッセージを作成
            $message = "{$goal->content}を投稿しました";
            // 投稿する処理
            $goal->status = 'active';
            $goal->save();
        } else {
            // フラッシュメッセージを作成
            $message = "{$goal->content}の投稿を削除しました";
            // 投稿する処理
            $goal->status = 'normal';
            $goal->save();
        }

        return redirect()
            ->route('/home')
            ->with('feedback.success', $message);
    }
}

