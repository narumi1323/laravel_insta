<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use APP\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->role_id == User::ADMIN_ROLE_ID)
        {
            return $next($request);
        }

        return redirect()->route('index');
    }
}

 // 条件式if(Auth::check() && Auth::user()->role_id == User::ADMIN_ROLE_ID)は、ユーザーがログインしておりかつそのユーザーが管理者ロールであるかどうかをチェックしています。Auth::check()は、ユーザーが認証されているかどうかを確認し、Auth::user()->role_id == User::ADMIN_ROLE_IDは、ユーザーのロールが管理者ロールであるかどうかを確認します。
// もしユーザーが管理者であれば、return $next($request);が実行され、次のミドルウェアまたはリクエストの処理が行われます。$nextは、ミドルウェアの中で次に実行される処理を表します。Laravelのミドルウェアは、チェーンのように連続して実行されるため、現在のミドルウェアの処理が完了すると、次の処理を呼び出すために$nextを使用します。$next($request)は、次のミドルウェアまたはアプリケーションの処理を実行するために$requestを引数として渡します。これにより、リクエストは次の処理に渡され、その処理が実行されます。

// 管理者でない場合は、return redirect()->route('index');が実行され、indexルートにリダイレクトされます。これにより、管理者権限が必要なページにアクセスできないようになります。

// このミドルウェアは、アプリケーションのセキュリティを向上させ、特定の機能やページにアクセスするためのアクセス制御を提供します。補足：Closureは、PHPの無名関数（匿名関数）を表すためのクラスです。無名関数は、名前を持たない関数であり、直接変数に代入されたり、引数として渡されたり、関数の戻り値として使用されることができます。

//  「AdminMiddleware」と呼ばれるミドルウェアを定義しています。このミドルウェアは、管理者権限が必要なリクエストを処理します。 
