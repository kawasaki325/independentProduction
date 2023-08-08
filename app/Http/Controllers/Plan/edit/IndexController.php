<?php

namespace App\Http\Controllers\Plan\edit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\Place;
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
        $plan_id = $request->route('plan');
        $goal = Goal::where('id', $plan_id)->firstOrFail();

        return view('plan.edit.index' , [
            'goal' => $goal,
        ]);
    }
}
