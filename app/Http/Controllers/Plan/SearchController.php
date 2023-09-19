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

        // キーワードをバリデーション処理
        $this->validate($request, [
            'keyword' => 'max:255',
        ]);

        // ログインユーザーのidを取得
        $user_id = $request->user()->id;

        // ログインユーザーの情報を取得
        $user = User::where('id' , $user_id)->firstOrFail();
        
        // 金額のリクエストに変数名を付ける
        $price = $request->price;
        
        // エリアのリクエストに変数名を付ける
        $area = $request->area;

        // キーワードの全角スペースを半角スペースに変更
        $keyword = mb_convert_kana($request->keyword, 's');

        // キーワードをスペースで区切って連想配列とする
        $keywords = preg_split('/[\s]+/', $keyword);

        // 連想配列を配列として保存するための変数を定義
        $escape_keywords=[];
        
        // keywordsをescape_keywordsに配列として導入
        foreach($keywords as $keyword) {
            $escape_keywords[] = $keyword ;
        }
        
        // キーワードが含まれるデータを検索
        if($request->keyword !== null){
            // statusがactiveかつcontentにキーワードが含まれるものを検索
            $goalsA = Goal::where('status', 'active')
            ->where(function ($subQuery) use ($escape_keywords) {
                    foreach ($escape_keywords as $keyword) {
                        $subQuery->orWhere('content', 'like', '%' . $keyword . '%');
                    }
                });
    
            // statusがactiveかつリレーション先のplaceにキーワードが含まれるものを検索
            $goalsB = Goal::whereHas('places', function ($query) use ($escape_keywords) {
                $query->where(function ($placeQuery) use ($escape_keywords) {
                    foreach ($escape_keywords as $keyword) {
                        $placeQuery->orWhere('content', 'like', '%' . $keyword . '%');
                    }
                });
            })
            ->where('status', 'active');
 

        } else {
            // キーワードがなければstatusがactiveのものを取得
            $goals=Goal::where('status', 'active');
        }

        // $goalAがからでなければ（キーワードが空でない場合）
        if(!(empty($goalsA)) ) {
            // 金額範囲の指定があれば$goalAと$goalBから絞り込み
            if($price == 1500) {
                $goalsA = $goalsA->where('totalPrice', '<=', $price);
                $goalsB = $goalsB->where('totalPrice', '<=', $price);
            } elseif($price == 5000) {
                $goalsA = $goalsA->where('totalPrice', '<=', $price)
                ->where('totalPrice', '>=', 1501);
                $goalsB = $goalsB->where('totalPrice', '<=', $price)
                ->where('totalPrice', '>=', 1501);
            } elseif($price == 10000) {
                $goalsA = $goalsA->where('totalPrice', '<=', $price)
                ->where('totalPrice', '>=', 5001);
                $goalsB = $goalsB->where('totalPrice', '<=', $price)
                ->where('totalPrice', '>=', 5001);
            } elseif($price == 10001) {
                $goalsA = $goalsA->where('totalPrice', '>', $price);
                $goalsB = $goalsB->where('totalPrice', '>', $price);
            } 

            // 出発地の入力があれば出発地点で絞り込み
            if($area != '未選択' && $area != null) {
                $goalsA = $goalsA->where('start', $area);
                $goalsB = $goalsB->where('start', $area);
            }

            // goalAとgoalBで絞り込んだ条件を結合
            $goals = $goalsA->union($goalsB)->distinct();
            // goalAが空であれば
        } else {
            if($price == 1500) {
                $goals = $goals->where('totalPrice', '<=', $price);
            } elseif($price == 5000) {
                $goals = $goals->where('totalPrice', '<=', $price)
                ->where('totalPrice', '>=', 1501);
            } elseif($price == 10000) {
                $goals = $goals->where('totalPrice', '<=', $price)
                ->where('totalPrice', '>=', 5001);
            } elseif($price == 10001) {
                $goals = $goals->where('totalPrice', '>', $price);
            } 

            if($area != '未選択' && $area != null) {
                $goals = $goals->where('start', $area);
            }
        }

        // 絞り込んだ条件でgoalテーブルから取得
        $goals = $goals->paginate(6);

        // キーワードを変数を与える
        $keyword = $request->keyword;

        return view('plan.share.index' , [
            'goals' => $goals,
            'keyword' => $keyword,
        ]);
    }
}
