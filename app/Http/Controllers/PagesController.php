<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function homepage()
    {
        # code...
        return view('pages.homepage');
    }

    public function about()
    {
        # code...
        $halaman='about';
        return view('pages.about', compact('halaman'));
    }
}
