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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', 'Admin\Admin_controller@index');

Route::get('/siswa', 'Admin\Siswa_controller@index');
Route::get('/siswa/yajra', 'Admin\Siswa_controller@yajra');
Route::get('/siswa/add', 'Admin\Siswa_controller@create');
Route::post('/siswa/add', 'Admin\Siswa_controller@store');
Route::get('/siswa/edit/{nis}', 'Admin\Siswa_controller@edit');
Route::post('/siswa/edit/{nis}', 'Admin\Siswa_controller@update');
