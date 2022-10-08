<?php

use Illuminate\Support\Facades\Route;

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
    return view('dashboard'); /* arahkan ke halaman dashboard */
});

//Route Resource
Route::resource('/departemen', \App\Http\Controllers\DepartemenController::class);
Route::resource('/pegawai', \App\Http\Controllers\PegawaiController::class);

Route::delete('/departemen/{id}', 'DepartemenController@destroy')->name('departemen.destroy');
//Route::update('/departemen/{id}', 'DepartemenController@update')->name('departemen.update');