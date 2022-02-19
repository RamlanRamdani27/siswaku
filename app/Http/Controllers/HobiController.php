<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HobiRequest;
use App\Hobi;
use Session;

class HobiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hobi_list = Hobi::orderBy('id','asc')->Paginate(10);;
        $jumlah_hobi = $hobi_list->count();
        return view('hobi.index', compact('hobi_list','jumlah_hobi'));
    }

    public function create()
    {
        return view('hobi.create');
    }

    public function store(HobiRequest $request)
    {
        Hobi::create($request->all());
        Session::flash('flash_message', 'Data hobi berhasil di simpan');
        return redirect('hobi');
    }

    public function edit(Hobi $hobi)
    {
        return view('hobi.edit', compact('hobi'));
    }

    public function update(Hobi $hobi, HobiRequest $request)
    {
        $hobi->update($request->all());
        Session::flash('flash_message','Data hobi berhasil di update');
        return redirect('hobi');
    }

    public function destroy(Hobi $hobi)
    {
        $hobi->delete();
        Session::flash('flash_message','Data berhasil di hapus');
        Session::flash('penting', true);
        return redirect('hobi');
    }
}
