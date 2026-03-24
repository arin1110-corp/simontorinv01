<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('*', function ($view) {
            $roles = [];

            if (session()->has('pegawai_id')) {
                $roles = DB::table('simontorin_user_role')
                    ->where('user_role_user', session('pegawai_id')) // ✅ INI KUNCINYA
                    ->pluck('user_role_nama');
            }

            $view->with('roles', $roles);
        });
    }
}