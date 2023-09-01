<?php

namespace App\Http\Controllers\Plan\share;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\User;
use App\Models\Like;

class LikeIndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //お気に入りしたプラン一覧を取得
        $user_id = $request->user()->id;

        $goals = Goal::whereHas('likedByUsers', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        return view('plan.share.likeIndex' , [
            'goals' => $goals,
        ]);
    }
}
