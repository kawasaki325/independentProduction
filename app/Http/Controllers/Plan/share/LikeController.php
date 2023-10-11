<?php

namespace App\Http\Controllers\Plan\share;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\Like;
use App\Models\User;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // いいねを登録・解除する

        // リクエストを送ったユーザーのidを取得
        $user_id = $request->user()->id;
        // 取得したユーザーidのデータをusersテーブルから取得
        $users = User::where('id' , $user_id)->firstOrFail();
        // リクエストからlike_idを取得
        $like_id = $request->like_id;
        // リクエストからgoal_idを取得
        $goal_id = $request->goal_id;
        
        // like_idがあれば
        if(isset($like_id)) {
            // likesテーブルからuser_idとgoal_idを削除
            $users->likedGoals()->detach($goal_id);
        } else {
            // like_idがなければlikesテーブルにuser_idとgoal_idを登録
            $users->likedGoals()->attach($goal_id);
        }

        // 成功したときにコンソールに$responseを表示
        $response = [
            'message' => 'successful',
            'like_id' => $like_id,
        ];
        header('Content-Type: application/json; charset=uft-8');
        echo json_encode($response);
    }
}
