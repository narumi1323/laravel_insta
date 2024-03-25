<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
      $this->user = $user;
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);
        return view('users.profile.show')->with('user',$user);
    }

   public function edit()
  {
    $user = $this->user->findOrFail(Auth::user()->id);

    return view('users.profile.edit')
            ->with('user', $user);
  }

  public function update(Request $request)
{
    #1. リクエストのデータをバリデーション
    $request->validate([
        'name' => 'required|min:1|max:50',
        'email' => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
        'avatar' => 'nullable|mimes:jpeg,jpg,png,gif|max:1048', // 画像は更新時に任意とする
        'introduction' => 'nullable|max:1000',
    ]);

    #2. 投稿を取得して更新する
    $user = $this->user->findOrFail(Auth::user()->id); // ユーザーIDを引数として渡す
    $user->name = $request->name;
    $user->email = $request->email;
    $user->introduction = $request->introduction;

    #3. 画像がアップロードされた場合にのみ更新
    if ($request->hasFile('avatar')) {  //($request->avatar)でも同じ
        $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
    } 

    $user->save();

   #4. 画像ページにリダイレクトする
    return redirect()->route('profile.show',Auth::user()->id); // ユーザーIDをリダイレクトのパラメータとして指定
}

   public function followers($id)
   {
    $user = $this->user->findOrFail($id);
    return view('users.profile.followers')->with('user',$user);
   }

    public function following($id)
    {
        // ユーザーを取得
       $user = $this->user->findOrFail($id);
        // ビューを返す
        return view('users.profile.following')->with('user',$user);
    }
    
}
