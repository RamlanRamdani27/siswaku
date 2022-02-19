<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RahasiaController extends Controller
{
    //
    public function halamanRahasia()
    {
        # code...
        return 'Anda sedang melihat <strong>Halaman Rahasia.</strong>';
    }
    public function showMeSecret()
    {
        # code...
        $url = route('secret');
        $links = '<a href="'. $url .'">Ke Halaman Rahasia</a>';
        return $links;
    }
}
