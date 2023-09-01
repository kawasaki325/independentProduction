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
            'keyword' => 'required|max:255',
        ]);

        $user_id = $request->user()->id;
        $user = User::where('id' , $user_id)->firstOrFail();

        $keyword = mb_convert_kana($request->keyword, 's');
        $keywords = preg_split('/[\s]+/', $keyword);
        $escape_keywords=[];

        foreach($keywords as $keyword) {
            $escape_keywords[] = '%' . $keyword . '%';
        }

        $goals = Goal::where(function ($q) use ($escape_keywords) {
            foreach($escape_keywords as $keyword) {
                $q ->orwhere('content', 'like', $keyword)
                ->orwhereHas('places', function ($query) use ($keyword) {
                    $query->where('content', $keyword);
                })
                ->where('status', 'active');
            }
        })
        ->get();

        $keyword = $request->keyword;

        return view('plan.share.index' , [
            'goals' => $goals,
            'keyword' => $keyword,
        ]);
    }
}
