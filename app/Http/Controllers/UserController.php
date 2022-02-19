<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Session;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $user_list = User::all();
        return view('user.index', compact('user_list'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validasi = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|confirmed|min:6',
            // 'password_confirmation' => 'required|confirmed|min:6',
            'level' => 'required|in:admin,operator',
        ]);

        if ($validasi->fails()) {
            return redirect('user/create')
                    ->withInput()
                    ->withErrors($validasi);
        }

        $data['password'] = bcrypt($data['password']);
        User::create($data);
        Session::flash('flash_message', 'Data user berhasil di simpan');
        return redirect('user');
    }

    public function show($id)
    {
        return redirect('user');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $data = $request->all();

        $validasi = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:100|unique:users,email,'. $data['id'],
            'password' => 'sometimes|nullable|confirmed|min:6',
            'level' => 'required|in:admin,operator',
        ]);

        if ($validasi->fails()) {
            return redirect("user/$id/edit")
                    ->withInput()
                    ->withErrors($validasi);
        }

        if ($request->filled('password')) {
            //hash password
            $data['password'] = bcrypt($data['password']);

        } else {
            //Hapus Password (password tidak di update)
            $data = array_except($data, ['password']);
        }

        $user->update($data);
        Session::flash('flash_message', 'Data user berhasil di update');
        return redirect('user');

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('flash_message', 'Data user berhasil di hapus');
        return redirect('user');
    }
}
