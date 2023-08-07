<?php

namespace App\Http\Controllers\Plane;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\Place;
use App\Models\Time;
use App\Models\Price;

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
        //ユーザーの登録したプラン一覧を取得
        $user_id = $request->user()->id;
        $goals = Goal::where('user_id', $user_id)->get();


        return view('plane.index' , [
            'goals' => $goals,
        ]);

    }
}

