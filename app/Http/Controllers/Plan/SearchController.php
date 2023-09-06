<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\User;
use App\Models\Place;
use App\Models\Memo;
use App\Models\Price;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // 検索機能

        $this->validate($request, [
            'keyword' => 'max:255',
        ]);

        $user_id = $request->user()->id;
        $user = User::where('id' , $user_id)->firstOrFail();

        $keyword = mb_convert_kana($request->keyword, 's');
        $keywords = preg_split('/[\s]+/', $keyword);
        $escape_keywords=[];

        $price = 5000;

        foreach($keywords as $keyword) {
            $escape_keywords[] = $keyword ;
        }

        // キーワードが含まれるデータを検索
        if($request->keyword !== null){

            $goalsA = Goal::where('status', 'active')
            ->where(function ($subQuery) use ($escape_keywords) {
                    foreach ($escape_keywords as $keyword) {
                        $subQuery->orWhere('content', 'like', '%' . $keyword . '%');
                    }
                })
            ->get();
    
            $goalsB = Goal::whereHas('places', function ($query) use ($escape_keywords) {
                $query->where(function ($placeQuery) use ($escape_keywords) {
                    foreach ($escape_keywords as $keyword) {
                        $placeQuery->orWhere('content', 'like', '%' . $keyword . '%');
                    }
                });
            })
            ->where('status', 'active')
            ->get();
                
    
             // $goalsAと$goalsBを結合
            $goalC = $goalsA->concat($goalsB);
            $goalD = $goalC->unique('id');
            $goals = $goalD->sortBy('id');
        } else {
            $goals=Goal::where('status', 'active')->get();
        }

        if($request->price !== null) {
            $goals = $goals->where('totalPrice', '<=', $price);
        }
        


        $keyword = $request->keyword;

        return view('plan.share.index' , [
            'goals' => $goals,
            'keyword' => $keyword,
        ]);
    }
}
