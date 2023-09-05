<?php

namespace App\Http\Controllers\Plan\share;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\User;
use App\Models\Like;

class LikeDetailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $plan_id = $request->route('plan');
        $user_id = $request->user()->id;
        $goal = Goal::where('id', $plan_id)->firstOrFail();
        $user = User::where('id', $user_id)->firstOrFail();

        if($goal->LikedByUsers->where('id', $user_id)->first()) {
            $goal->like_id = 1;
        } else {
            $goal->like_id = null;
        }

        return view('plan.share.likedetail' , [
            'goal' => $goal,
            'user' => $user,
        ]);
    }
}
