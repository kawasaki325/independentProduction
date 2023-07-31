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
        // プラン一覧表示
        $user_id = $request->user()->id;

        $goal = Goal::where('user_id', $user_id)->get();

        return view('plane.index' , [
            'goal' => $goal,
        ]);

    }
}

