<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        // validation（チェックのみ）
        $validator = Validator::make($request->all(), [
            'goal' => 'required',
            'date' => 'required:strtotime',
            'place' => 'required|array|min:2',
            'place.*' => 'required',
            'time' => 'required|array|min:2',
            'time.*' => 'required',
        ]);

        // validation エラーがある場合、エラーメッセージをダンプする
        if ($validator->fails()) {
            $errors = $validator->errors()->messages();
            $goal_json = json_encode($request->goal);
            $date_json = json_encode($request->date);
            $place_json = json_encode($request->place);
            $time_json = json_encode($request->time);

            return view('plan.create', [
                'errors' => $errors,
                'goal' => $goal_json,
                'date' => $date_json,
                'place' => $place_json,
                'time' => $time_json,
            ]);
        }


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
        foreach ($request->place as $place) {
            $places = new Place;
            $places->goal_id = $goal_id;
            $places->content = $place;
            $places->save();
        }


        // timeテーブルに値を登録
        foreach ($request->time as $time) {
            $times = new Time;
            $times->goal_id = $goal_id;
            $times->time = $time;
            $times->save();
        }

        return redirect('/plans');
    }
}
