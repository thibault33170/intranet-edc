<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('benevoles', 'BenevoleController');

    Route::resource('captures', 'CaptureController');
    Route::post('/captures/attach', 'CaptureController@attach')->name('captures.attach');
    Route::post('/captures/detach', 'CaptureController@detach')->name('captures.detach');
});

Auth::routes();