<?php

namespace App\Http\Controllers\Plane;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\Place;
use App\Models\Time;
use App\Models\Price;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // 行先を登録する

        // 入力値のバリデーション
        $this->validate($request, [
            'goal' => 'required',
            'date' => 'required',
            'place' => 'required',
            'time' => 'required',
            'price' => 'required',
        ]);

        // 登録したユーザーidの取得
        $user_id = $request->user()->id;

        // goalテーブルに入力値を登録
        $goal = new Goal;
        $goal->user_id = $user_id;
        $goal->content = $request->goal;
        $goal->date = $request->date;
        $goal->save();

        // 登録したgoalテーブルのidを取得
        $goal_id = $goal->id;

        // placeテーブルに値を登録
        $place = new Place;
        $place->goal_id = $goal_id;
        $place->content = $request->place;
        $place->save();

        // priceテーブルに値を登録
        $price = new Price;
        $price->goal_id = $goal_id;
        $price->amount = $request->price;
        $price->save();

        // timeテーブルに値を登録
        $time = new Time;
        $time->goal_id = $goal_id;
        $time->time = $request->time;
        $time->save();

        return redirect('/planes');
    }
}
