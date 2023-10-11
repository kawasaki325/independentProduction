<?php

namespace App\Http\Controllers\Plan\share;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use App\Models\Goal;
use App\Models\Place;
use App\Models\Memo;
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
        // 投稿されているデータを表示する
        
        //goalテーブルのstatusがactiveのデータを取得
        $goals = Goal::where('status', 'active')
        ->with(['places.memo', 'times', 'prices.transportation'])
        ->orderBy('updated_at', 'desc')
        ->paginate(6);



        return view('plan.share.index' , [
            'goals' => $goals,
        ]);
    }
}
