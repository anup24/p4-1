<?php

/* Get & Show */
Route::get('/', 'TranslateController@index');
Route::get('/translations','TranslationsController@index');
Route::get('/translations/{n?}','TranslationsController@show');

/* Create */
Route::post('/translate','TranslateController@translate');

/* Edit */
Route::get('/translations/{n?}/edit','TranslationsController@edit');
Route::put('/translations/{n?}','TranslationsController@update');

/* Delete */
Route::get('/translations/{n?}/delete', 'TranslationsController@delete');
Route::delete('/translations/{n?}', 'TranslationsController@destroy');