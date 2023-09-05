<?php

namespace App\Http\Controllers\User\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'required|max:10',
            'email' => 'required|email',
            'password' => 'required|min:4|max:12|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user_id = $request->route('user_id');
        // パスワードをハッシュ値に変換してユーザー登録
        $password = Hash::make($request->password);
        
        $user = User::where('id', $user_id)->firstOrFail();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->save();

        return redirect()
            ->route('user')
            ->with('feedback.success', "編集しました");
    }
}
