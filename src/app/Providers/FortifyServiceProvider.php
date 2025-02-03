<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // 新規会員登録処理
        Fortify::createUsersUsing(CreateNewUser::class);

        // /registerにアクセスしたときに表示するviewファイル
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // /loginにアクセスしたときに表示するviewファイル
        Fortify::loginView(function () {
            return view('auth.login');
        });

    }
}

