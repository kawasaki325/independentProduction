<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

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
        
        $price = $request->price;

        $area = $request->area;
        
        foreach($keywords as $keyword) {
            $escape_keywords[] = $keyword ;
        }
        
        // キーワードが含まれるデータを検索
        $query = Goal::where('status', 'active');

        if ($request->keyword !== null) {
            $query->where(function ($subQuery) use ($escape_keywords) {
                foreach ($escape_keywords as $keyword) {
                    $subQuery->orWhere('content', 'like', '%' . $keyword . '%');
                }
            });
        
            $query->orWhereHas('places', function ($placeQuery) use ($escape_keywords) {
                $placeQuery->where(function ($subQuery) use ($escape_keywords) {
                    foreach ($escape_keywords as $keyword) {
                        $subQuery->orWhere('content', 'like', '%' . $keyword . '%');
                    }
                });
            });
        }
        
        if ($price == 1500) {
            $query->where('totalPrice', '<=', $price);
        } elseif ($price == 5000) {
            $query->where('totalPrice', '<=', $price)->where('totalPrice', '>=', 1501);
        } elseif ($price == 10000) {
            $query->where('totalPrice', '<=', $price)->where('totalPrice', '>=', 5001);
        } elseif ($price == 10001) {
            $query->where('totalPrice', '>', $price);
        }
        
        if ($area != '未選択' && $area != null) {
            $query->where('start', $area);
        }
        
        $goals = $query->paginate(6);
        


        $keyword = $request->keyword;




        return view('plan.share.index' , [
            'goals' => $goals,
            'keyword' => $keyword,
        ]);
    }
}
