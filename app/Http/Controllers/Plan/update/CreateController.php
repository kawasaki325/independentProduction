<?php

namespace App\Http\Controllers\Plan\update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // リクエストからplan_idを取得
        $plan_id = $request->route('plan');
        // 取得したplan_idの投稿を取得
        $goal = Goal::where('id', $plan_id)->firstOrFail();

        return view('plan.update.create' , [
            'goal' => $goal,
        ]);
    }
}
