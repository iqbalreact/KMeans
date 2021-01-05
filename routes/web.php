<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PersediaanController;
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

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', 'App\Http\Controllers\AdminController@index');
Route::get('/kmeans', 'App\Http\Controllers\AdminController@prosesPage')->name('kmeans.index');
Route::post('/kmeans/perhitungan', 'App\Http\Controllers\AdminController@perhitungan')->name('kmeans.perhitungan');
Route::get('/machine', 'App\Http\Controllers\ClusteringController@machine');

Route::resource('/obat', ObatController::class);
Route::resource('/persediaan', PersediaanController::class);
