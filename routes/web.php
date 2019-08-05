<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

route::prefix('absen')->group(function(){
	Route::get('/', 'HomeController@index');
	Route::post('/absen', 'HomeController@absen');
});

route::prefix('crud')->group(function(){
	Route::get('/', 'KaryawanController@index')->name('KaryawanEskalink');
	Route::get  ('/showData/{id}', 'KaryawanController@showData');
	Route::post('/simpanData', 'KaryawanController@storeData');
	Route::put('/editData/{id}', 'KaryawanController@update');
	Route::get('/hapus/{id}', 'KaryawanController@delete');
});

route::prefix('guestbook')->group(function(){
	Route::get('/', 'GuestbookController@index')->name('viewbook');
	Route::post('/simpan', 'GuestbookController@store')->name('simpanbook');
});

route::prefix('crud_ajax')->group(function(){
	Route::get('/', 'CrudAjaxController@index')->name('coba_view');
	Route::get('/edit_ajax/{id}', 'CrudAjaxController@edit');
	Route::put('/update_ajax/{id}', 'CrudAjaxController@update');
	Route::post('/store_ajax', 'CrudAjaxController@store');
	Route::delete('/destroy_ajax/{id}', 'CrudAjaxController@destroy');
});