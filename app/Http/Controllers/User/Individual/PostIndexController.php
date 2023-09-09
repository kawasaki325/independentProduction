<?php

namespace App\Http\Controllers\User\Individual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\Place;
use App\Models\Memo;
use App\Models\Time;
use App\Models\Price;

class PostIndexController extends Controller
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

        $goals = Goal::with(['places.memo', 'times', 'prices.transportation'])
                ->where('user_id', $user_id)
                ->paginate(6);

        return view('user.individual.postIndex' , [
            'goals' => $goals,
        ]);
    }
}
