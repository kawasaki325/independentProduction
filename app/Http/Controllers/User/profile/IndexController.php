<?php

namespace App\Http\Controllers\User\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

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
        $user = User::where('id', $user_id)->firstOrFail();

        return view('user.profile.index' , [
            'user' => $user,
        ]);
    }
}
