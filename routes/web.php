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
	route::resource('/user', 'CrudAjaxController');
	route::get('/table/user', 'CrudAjaxController@dataTable')->name('table.user');
});