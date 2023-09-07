<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Goal;
use App\Models\Place;
use App\Models\Memo;
use App\Models\Time;
use App\Models\Price;
use App\Models\Transportation;

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
            'date' => 'required',
            'place' => 'required|array|min:2',
            'place.*' => 'required',
            'area' => 'required',
            'memo' => 'required|array|min:2',
            'memo.*' => 'nullable',
            'time' => 'required|array|min:2',
            'time.*' => 'required',
            'transportation' => 'required|array|min:1',
            'transportation.*' => 'required',
            'price' => 'required|array|min:1',
            'price.*' => 'required',
        ]);

        // validation エラーがある場合、エラーメッセージをダンプする
        if ($validator->fails()) {
            $errors = $validator->errors()->messages();
            $goal_json = json_encode($request->goal);
            $date_json = json_encode($request->date);
            $place_json = json_encode($request->place);
            $memo_json = json_encode($request->memo);
            $transportation_json = json_encode($request->transportation);
            $price_json = json_encode($request->price);
            $time_json = json_encode($request->time);

            return view('plan.create', [
                'errors' => $errors,
                'goal' => $goal_json,
                'date' => $date_json,
                'place' => $place_json,
                'memo' => $memo_json,
                'transportation' => $transportation_json,
                'price' => $price_json,
                'time' => $time_json,
            ]);
        }


        // 登録したユーザーidの取得
        $user_id = $request->user()->id;

        // priceの合計を計算する為の変数
        $totalPrice = 0;

        // priceテーブルに値を登録
        foreach ($request->price as $price) {
            $totalPrice += $price;
        }

        // goalテーブルに入力値を登録
        $goal = new Goal;
        $goal->user_id = $user_id;
        $goal->content = $request->goal;
        $goal->date = $request->date;
        $goal->totalPrice = $totalPrice;
        $goal->start = $request->area;
        $goal->save();

        // 登録したgoalテーブルのidを取得
        $goal_id = $goal->id;

        // memoテーブルにplace_idを登録する為の変数
        $place_id = [];
        $i = 0;

        // transportationテーブルにplace_idを登録する為の変数
        $price_id = [];
        $p = 0;

        // placeテーブルに値を登録
        foreach ($request->place as $place) {
            $places = new Place;
            $places->goal_id = $goal_id;
            $places->content = $place;
            $places->save();
            $place_id[] = $places->id;
        }

        // priceテーブルに値を登録
        foreach ($request->price as $price) {
            $prices = new Price;
            $prices->goal_id = $goal_id;
            $prices->amount = $price;
            $prices->save();
            $totalPrice += $price;
            $price_id[] = $prices->id;
        }

        // transportationテーブルに値を登録
        foreach ($request->transportation as $transportation) {
            $transportations = new Transportation;
            $transportations->price_id = $price_id[$p];
            $transportations->transportation = $transportation;
            $transportations->save();
            $p++;
        }

        // memoテーブルに値を登録
        foreach ($request->memo as $memo) {
            $memos = new Memo;
            $memos->place_id = $place_id[$i];
            $memos->content = $memo;
            $memos->save();
            $i++;
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
