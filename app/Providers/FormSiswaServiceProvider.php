<?php

namespace App\Providers;

use App\Hobi;
use App\Kelas;
use Illuminate\Support\ServiceProvider;

class FormSiswaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    // public function register()
    // {
    //     //
    // }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('siswa.form', function($view) {
            $view->with('list_kelas', Kelas::pluck('nama_kelas','id'));
            $view->with('list_hobi', Hobi::pluck('nama_hobi','id'));
        });

        view()->composer('siswa.form_pencarian', function($view) {
            $view->with('list_kelas', Kelas::pluck('nama_kelas','id'));
        });
    }
}
