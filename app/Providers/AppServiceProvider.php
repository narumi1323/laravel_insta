<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use APP\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Gate::define('admin',function($user){
           return $user->role_id === User::ADMIN_ROLE_ID;
        });
        //アクセス制御のためのポリシー（Gate）を定義しています。具体的には、'admin'という名前のポリシーを定義しています。このポリシーは、管理者権限があるかどうかを確認します。引数の無名関数内で、渡された$userオブジェクトのrole_idをチェックし、その値がUser::ADMIN_ROLE_IDと等しい場合にのみtrueを返します。これにより、adminポリシーがユーザーが管理者であるかどうかを確認するためのルールを定義しています。
    }
}

//  AppServiceProviderです。サービスプロバイダーは、アプリケーションの起動時に特定のサービスを提供したり、アプリケーションの構成や動作を設定したりする役割を果たします。