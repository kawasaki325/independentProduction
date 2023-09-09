<?php

namespace App\Http\Controllers\User\Individual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class FollowController extends Controller
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
        $users =  User::where('id', $user_id)->firstOrFail();

        if(isset($request->follow_id)) {
            $users->follows()->detach($request->user_id);
        } else {
            $users->follows()->attach($request->user_id);
        }

        $response = [
            'message' => 'successful',
            'follow_id' => $request->follow_id,
        ];
        header('Content-Type: application/json; charset=uft-8');
        echo json_encode($response);
    }
}
