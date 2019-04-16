<?php
Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/profile', 'HomeController@index')->name('profile');
