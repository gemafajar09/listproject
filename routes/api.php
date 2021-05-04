<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth-login','ApiloginController@login');
Route::post('auth-login-karyawan','ApiloginController@loginkaryawan');
// listproject
Route::get('projek-list/{id}','api\ListprojekController@show');
Route::get('projek-user/{id}','api\ListprojekController@userprojek');
Route::get('projek-detail/{id}','api\ListprojekController@detail');
Route::get('projek-show/{id}','api\ListprojekController@detailproject');
// lisprogrammer
Route::get('programmer-list','api\Listprogrammer@show');

