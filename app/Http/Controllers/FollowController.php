<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    private $follow;

    public function __construct(Follow $follow)
    {
        $this->follow = $follow;
    }

    public function store($user_id)
    {
        $this->follow->follower_id = Auth::user()->id;
        $this->follow->following_id = $user_id;
        $this->follow->save();

        return redirect()->back();
    }
    /*
    $user_idは、フォローするユーザーのID。ルートから渡される。
    $this->follow->follower_id = Auth::user()->id;は、ログインしているユーザーのIDを取得し、フォローする対象のfollower_idとして設定する。
    $this->follow->following_id = $user_id;は、フォローされるユーザーのIDを指定されたユーザーIDとして設定する
    */

    public function destroy($user_id)
    {
        $this->follow
              ->where('follower_id', Auth::user()->id)
              ->where('following_id',$user_id)
              ->delete();

        return redirect()->back();
    }
}
