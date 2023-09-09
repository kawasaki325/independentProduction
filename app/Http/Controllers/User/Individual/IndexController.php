<?php

namespace App\Http\Controllers\User\Individual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // ログインしているユーザーのidを取得
        $my_id = $request->user()->id;

        // 選択されたユーザーのidを取得
        $user_id = $request->route('user_id');

        // 選択されたユーザーの情報を取得（フォローした人とフォローされた人の情報も）
        $user = User::where('id', $user_id)->with('follows', 'followers')->firstOrFail();

        // フォローした人の数を取得
        $follow_count = count($user->follows);
        // フォローされた人の数を取得
        $followed_count = count($user->followers);

        // フォローされた人の中にログインユーザーのidがあればfollow_idを1とする。
        foreach ($user->followers as $follower) {
            $user->follow_id=null;
            if($follower->id === $my_id)
            {
                $user->follow_id=1;
            }
        }

        return view('user.individual.index' , [
            'user' => $user,
            'follow_count' => $follow_count,
            'followed_count' => $followed_count,
        ]);
    }
}
