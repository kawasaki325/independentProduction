<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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
        
        //ユーザーの登録したプラン一覧を取得
        $user_id = $request->user()->id;
        $goals = Goal::with(['places.memo', 'times', 'prices.transportation'])
             ->where('user_id', $user_id)
             ->paginate(6);

        
        // requestからエリアを取得
        $area = $request->area;
        $temp = null;
        $img = null;


        if($area !== null && $area !== '未選択') {
            $url = "http://api.openweathermap.org/data/2.5/weather?q={$area}&appid=84fe9970e0b70d3248576b9eec7788d8&lang=ja&units=metric";
            $response = Http::get($url);
            
            $weather = $response['weather'][0]['main'];
            $temp = $response['main']['temp'];
    
            switch ($weather){
                case 'Clouds':
                    $img='http://openweathermap.org/img/w/04d.png';
                    break;
                case 'Snow':
                    $img = 'http://openweathermap.org/img/w/13d.png';
                    break;
                case 'Rain':
                    $img = 'http://openweathermap.org/img/w/09d.png';
                    break;
                case 'Clear':
                    $img = 'http://openweathermap.org/img/w/01d.png';
                    break;
                case 'Fog':
                    $img = 'http://openweathermap.org/img/w/50d.png';
                    break;
                case 'Mist':
                    $img = 'http://openweathermap.org/img/w/50n.png';
                    break;
                case 'Haze':
                    $img = 'http://openweathermap.org/img/w/50d.png';
                    break;
                default:
                    $img = 'http://openweathermap.org/img/w/01n.png';
            }
        }


        return view('plan.index' , [
            'goals' => $goals,
            'temp' => $temp,
            'img' => $img,
            'area' => $area,
        ]);

    }
}

