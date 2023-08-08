<?php

namespace App\Http\Controllers\Plan\update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\Place;
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
            'time' => 'required|array|min:2',
            'time.*' => 'required',
        ]);

        $goal = Goal::where('id', $request->goal_id)->firstOrFail();
        $goal->content = $request->goal;
        $goal->date = $request->date;
        $goal->save();

        $places = Place::where('goal_id', $request->goal_id)->get();
        for($i=0; $i < count($places); $i++) {
            $places[$i]->content = $request->place[$i];
            $places[$i]->save();
        }

        $times = Time::where('goal_id', $request->goal_id)->get();
        for($i=0; $i < count($times); $i++) {
            $times[$i]->time = $request->time[$i];
            $times[$i]->save();
        }

        return redirect(route('update/{plan}', ['plan' => $goal->id]));

    }
}
