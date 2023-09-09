<?php

namespace App\Http\Controllers\User\Individual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class FollowIndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        // 自分がフォローしているユーザーを取得
        $user_id = $request->user()->id;
        $user=$user = User::where('id', $user_id)->with('follows', 'followers')->firstOrFail();
        $users = $user->follows;
        
        return view('user.follow.index' , [
            'users' => $users,
        ]);
    }
}
