<?php

namespace App\Http\Controllers\User\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class putController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user_id = $request->route('user_id');
        $user = User::where('id', $user_id)->firstOrFail();
        if($user->role_id === 1) {
            $user->role_id = 0;
            $user->save();
        } else {
            $user->role_id = 1;
            $user->save();
        }

        return redirect()
            ->route('admin')
            ->with('feedback.success', "編集しました");
    }
}
