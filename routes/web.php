<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\DB;

Route::get('/', 'PagesController@homepage');
Route::get('about', 'PagesController@about');
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('siswa/cari', 'SiswaController@cari');
Route::resource('siswa', 'SiswaController');
Route::resource('kelas', 'KelasController')->parameters(['kelas' => 'kelas']);
Route::resource('hobi', 'HobiController');
Route::resource('user', 'UserController');


// Route::get('siswa', 'SiswaController@index');
// Route::get('siswa/create', 'SiswaController@create');
// Route::get('siswa/{siswa}', 'SiswaController@show');
// Route::post('siswa', 'SiswaController@store');
// Route::get('siswa/{siswa}/edit', 'SiswaController@edit');
// Route::patch('siswa/{siswa}', 'SiswaController@update');
// Route::delete('siswa/{siswa}', 'SiswaController@destroy');
