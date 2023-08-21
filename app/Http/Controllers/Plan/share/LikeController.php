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
        $user_id = $request->user()->id;
        $users = User::where('id' , $user_id)->firstOrFail();
        $like_id = $request->like_id;
        $goal_id = $request->goal_id;
        
        if(isset($like_id)) {
            $users->likedGoals()->detach($goal_id);
        } else {
            $users->likedGoals()->attach($goal_id);
        }

        $response = [
            'message' => 'successful',
            'like_id' => $like_id,
        ];
        header('Content-Type: application/json; charset=uft-8');
        echo json_encode($response);
    }
}
