<?php

namespace App\Http\Controllers\Plan\share;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\User;
use App\Models\Like;

class PlanDetailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // 投稿の詳細を表示する

        // リクエストからplan_idを取得
        $plan_id = $request->route('plan');
        // リクエストからuser_idを取得
        $user_id = $request->user()->id;
        // plan_idから投稿を取得
        $goal = Goal::where('id', $plan_id)->firstOrFail();
        // user_idからユーザー情報を取得
        $user = User::where('id', $user_id)->firstOrFail();

        // リクエストを送ったユーザーが投稿をいいねしていれば
        if($goal->LikedByUsers->where('id', $user_id)->first()) {
            // 投稿いlike_id=1を付与
            $goal->like_id = 1;
        } else {
            // そうでなければlike_id=nullを付与
            $goal->like_id = null;
        }

        return view('plan.share.detail' , [
            'goal' => $goal,
            'user' => $user,
        ]);
    }
}
