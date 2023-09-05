<?php

namespace App\Http\Controllers\User\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user_id = $request->user()->id;
        $user = User::where('id', $user_id)->firstOrFail();

        return view('user.profile.create' , [
            'user' => $user,
        ]);
    }
}
