<?php

namespace App\Http\Controllers\User\admin;

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
        //ユーザー情報を取得
        $user_id = $request->user()->id;
        $users = User::all();

        return view('user.admin.index' , [
            'users' => $users,
        ]);
    }
}
