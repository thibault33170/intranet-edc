<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    /**
     * Benevoles routes
     */
    Route::get('benevoles', 'BenevoleController@index')
        ->name('benevoles.index')
        ->middleware('benevole.index');

    Route::get('benevoles/create', 'BenevoleController@create')
        ->name('benevoles.create');

    Route::post('benevoles', 'BenevoleController@store')
        ->name('benevoles.store');

    Route::get('benevoles/{benevole}', 'BenevoleController@show')
        ->name('benevoles.show')
        ->middleware('benevole.show');

    Route::get('benevoles/{benevole}/edit', 'BenevoleController@edit')
        ->name('benevoles.edit')
        ->middleware('benevole.edit');

    Route::put('benevoles/{benevole}', 'BenevoleController@update')
        ->name('benevoles.update')
        ->middleware('benevole.edit');

    /**
     * Capture routes
     */
    Route::get('captures', 'CaptureController@index')
        ->name('captures.index')
        ->middleware('capture.index');

    Route::get('captures/create', 'CaptureController@create')
        ->name('captures.create');

    Route::post('captures', 'CaptureController@store')
        ->name('captures.store');

    Route::get('captures/{capture}', 'CaptureController@show')
        ->name('captures.show')
        ->middleware('capture.show');

    Route::get('captures/{capture}/edit', 'CaptureController@edit')
        ->name('captures.edit')
        ->middleware('capture.edit');

    Route::put('captures/{capture}', 'CaptureController@update')
        ->name('captures.update')
        ->middleware('capture.edit');

    Route::post('captures/attach', 'CaptureController@attach')
        ->name('captures.attach');

    Route::post('captures/detach', 'CaptureController@detach')
        ->name('captures.detach');

    /**
     * Cats routes
     */
    Route::get('cats', 'CatController@index')
        ->name('cats.index')
        ->middleware('cat.index');

    Route::get('cats/create', 'CatController@create')
        ->name('cats.create');

    Route::post('cats', 'CatController@store')
        ->name('cats.store');

    Route::get('cats/{cat}', 'CatController@show')
        ->name('cats.show')
        ->middleware('cat.show');

    Route::get('cats/{cat}/edit', 'CatController@edit')
        ->name('cats.edit')
        ->middleware('cat.edit');

    Route::put('cats/{cat}', 'CatController@update')
        ->name('cats.update')
        ->middleware('cat.edit');

    Route::post('cats/attach', 'CatController@attach')
        ->name('cats.attach');

    Route::post('cats/detach', 'CatController@detach')
        ->name('cats.detach');
});

/**
 * Authentication routes
 */
Auth::routes();