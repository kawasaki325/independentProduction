<?php

namespace App\Http\Controllers\Plan\update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\Place;
use App\Models\Memo;
use App\Models\Time;
use App\Models\Price;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'goal' => 'required',
            'date' => 'required',
            'place' => 'required|array|min:2',
            'place.*' => 'required',
            'memo' => 'required|array|min:2',
            'memo.*' => 'nullable',
            'time' => 'required|array|min:2',
            'time.*' => 'required',
            'price' => 'required|array|min:2',
            'price.*' => 'required',
        ]);

        // priceの合計を計算する為の変数
        $totalPrice = 0;

        // priceのデータを変更
        $prices = Price::where('goal_id', $request->goal_id)->get();
        for($i=0; $i < count($prices); $i++) {
            $prices[$i]->amount = $request->price[$i];
            $prices[$i]->save();
            $totalPrice += $request->price[$i];
        }

        // goalのデータを変更
        $goal = Goal::where('id', $request->goal_id)->firstOrFail();
        $goal->content = $request->goal;
        $goal->date = $request->date;
        $goal->totalPrice = $totalPrice;
        $goal->save();

        // memoのデータを編集するための変数
        $place_id = [];

        // placeのデータを変更
        $places = Place::where('goal_id', $request->goal_id)->get();
        for($i=0; $i < count($places); $i++) {
            $places[$i]->content = $request->place[$i];
            $places[$i]->save();
            $place_id[] = $places[$i]->memo->place_id;
        }


        // memoのデータを変更
        for($i=0; $i < count($place_id); $i++) {
            $memos = Memo::where('place_id', $place_id[$i])->firstOrFail();
            $memos->content = $request->memo[$i];
            $memos->save();
        }

        // timeのデータを変更
        $times = Time::where('goal_id', $request->goal_id)->get();
        for($i=0; $i < count($times); $i++) {
            $times[$i]->time = $request->time[$i];
            $times[$i]->save();
        }


        return redirect()
            ->route('update/{plan}', ['plan' => $goal->id])
            ->with('feedback.success', "編集しました");

    }
}
