<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

class SiswakuAppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $halaman='';
        if (Request::segment(1)== 'siswa') {
            # code...
            $halaman="siswa";
        }
        if (Request::segment(1)== 'kelas') {
            # code...
            $halaman="kelas";
        }
        if (Request::segment(1)== 'hobi') {
            # code...
            $halaman="hobi";
        }
        if (Request::segment(1)== 'about') {
            # code...
            $halaman="about";
        }
        if (Request::segment(1)== 'user') {
            # code...
            $halaman="user";
        }
        view()->share('halaman',$halaman);
    }
}
