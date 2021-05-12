<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth-login','ApiloginController@login');
// listproject proses
Route::get('projek-proses/{id}','api\ListprojekController@proses');
Route::get('projek-fitur/{id}','api\ListprojekController@fiturprogres');
Route::post('projek-fitur-update','api\ListprojekController@updetstatusfitur');
// listproject waiting
Route::get('projek-waiting/{id}','api\ListprojekController@waiting');
// listproject Finish
Route::get('projek-finish/{id}','api\ListprojekController@finish');
// lisprogrammer
Route::get('programmer-list','api\Listprogrammer@show');

