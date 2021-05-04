<?php

use Illuminate\Support\Facades\Route;
Route::get('/', 'LoginController@index');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::post('login-admin', 'LoginController@login')->name('login-admin');

// home
Route::group([
    'name' => 'back',
    'prefix' => 'back',
    'middleware' => 'ceklogin',
], function(){
    Route::get('home','HomeController@index')->name('home');
});

// karyawan
Route::group([
    'name' => 'karyawan',
    'prefix' => 'karyawan',
    'middleware' => 'ceklogin',
], function(){
    Route::get('data-karyawan','KaryawanController@index')->name('data-karyawan');
    Route::post('data-karyawan-add','KaryawanController@add')->name('data-karyawan-add');
});

// jabatan
Route::group([
    'name' => 'jabatan',
    'prefix' => 'jabatan',
    'middleware' => 'ceklogin',
], function(){
    Route::get('data-jabatan','JabatanController@index')->name('data-jabatan');
    Route::post('data-jabatan-add','JabatanController@add')->name('data-jabatan-add');
    Route::get('data-jabatan-del/{id}','JabatanController@delete')->name('data-jabatan-del');
});

// projek berjalan
Route::group([
    'name' => 'projekb',
    'prefix' => 'projekb',
    'middleware' => 'ceklogin',
], function(){
    Route::get('projek-berjalan','ProjekberjalanController@index')->name('projek-berjalan');
    Route::get('projek-berjalan-timeline','ProjekberjalanController@timeline')->name('projek-berjalan-timeline');
});

// projek masuk
Route::group([
    'name' => 'projekm',
    'prefix' => 'projekm',
    'middleware' => 'ceklogin',
], function(){
    Route::get('projek-masuk','ProjekmasukController@index')->name('projek-masuk');
    Route::post('projek-masuk-add','ProjekmasukController@add')->name('projek-masuk-add');
    Route::get('projek-masuk-del/{id}','ProjekmasukController@deleteproject')->name('projek-masuk-del');
    Route::post('detail-fitur-add','ProjekmasukController@simpanfitur')->name('detail-fitur-add');
    Route::post('detail-fitur-del','ProjekmasukController@deletefitur')->name('detail-fitur-del');
    Route::get('detail-fitur/{id}','ProjekmasukController@detailfitur')->name('detail-fitur');
});
