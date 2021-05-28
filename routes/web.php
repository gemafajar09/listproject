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
    Route::get('projek-berjalan-timeline/{id}','ProjekberjalanController@timeline')->name('projek-berjalan-timeline');
    Route::post('projek-berjalan-timeline','ProjekberjalanController@store')->name('projek-berjalan-timeline.store');
    Route::post('projek-berjalan-timeline/update','ProjekberjalanController@update')->name('projek-berjalan-timeline.update');
    Route::post('projek-berjalan-timeline/delete','ProjekberjalanController@delete')->name('projek-berjalan-timeline.delete');
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

// grafik
Route::group([
    'name' => 'grafik',
    'prefix' => 'grafik',
    'middleware' => 'ceklogin',
], function(){
    Route::get('grafik','GrafikController@index')->name('grafik');
    Route::get('data-jabatan-del/{id}','GrafikController@delete')->name('data-jabatan-del');
});

// gaji
Route::group([
    'name' => 'gaji',
    'prefix' => 'gaji',
    'middleware' => 'ceklogin',
], function(){
    Route::get('gaji','GajiController@index')->name('gaji');
    Route::post('data-gaji-add','GajiController@add')->name('data-gaji-add');
    Route::post('data-gaji-del','GajiController@delete')->name('data-gaji-del');
    Route::get('data-gaji-detail/{id}','GajiController@detail')->name('data-gaji-detail');
});

// bonus
Route::group([
    'name' => 'bonus',
    'prefix' => 'bonus',
    'middleware' => 'ceklogin',
], function(){
    Route::get('bonus','BonusController@index')->name('bonus');
    Route::get('bonus-tambah','BonusController@tambah')->name('bonus-tambah');
    Route::post('bonus-cari-harga','BonusController@cari_harga')->name('bonus-cari-harga');
    Route::get('bonus-programmer/{id}','BonusController@cari_programmer')->name('bonus-programmer');
    Route::get('bonus-detail/{bpnus_id}','BonusController@bonus_detail')->name('bonus-detail');
    Route::post('bonus-simpan','BonusController@simpan')->name('bonus-simpan');
    Route::post('data-bonus-del','BonusController@delete')->name('data-bonus-del');
});