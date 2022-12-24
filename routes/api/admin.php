<?php
Route::post('/storeNilai', 'KinerjaController@storeNilai')->name('storeNilai');
// http://127.0.0.1:8000/api/v1/storeNilai


Route::get('/checkStatus/{userid}/{periode}', 'KinerjaController@checkStatus')->name('checkStatus');


// API GET DATA USER FOR HR
Route::get('/getSeksiByDept/{depid}', 'KinerjaController@getSeksiByDept')->name('getSeksiByDept');

Route::get('/getUserBySeksi/{seksiid}', 'KinerjaController@getUserBySeksi')->name('getUserBySeksi');

Route::get('/getUserDetail/{userid}', 'KinerjaController@getUserDetail')->name('getUserDetail');



