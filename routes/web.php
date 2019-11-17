<?php
/* Pages (index, login, register) */
Route::get('/', 'PagesController@index')->name('/');

/* register / login */
Auth::routes();

/* Network */
Route::get('/home', 'NetworkController@index')->name('home');

Route::group(['middleware' => ['auth', 'revalidate']], function () {
	/* Posts */
	Route::get('post/show/{id}', 'PostsController@show')->name('post/show');
	Route::post('post/store', 'PostsController@store')->name('post/store');
	Route::delete('post/destroy/{post}', 'PostsController@destroy');

	/* Comments */
	Route::post('comment/store', 'CommentsController@store')->name('comment/store');

	/* Likes */
	Route::post('like/store', 'LikesController@store');
	Route::post('like/destroy', 'LikesController@destroy');

	/* Interests */

	/* Messages */

	/* Notifications */
	Route::get('notifications/index/{type}', 'NotificationsController@index');
	Route::get('notifications/{notification}', 'NotificationsController@show');

	/* Gallery */
	Route::get('gallery', 'GalleryController@index')->name('gallery');
	Route::get('gallery/{id}', 'GalleryController@show')->name('gallery');
	Route::post('gallery/store', 'GalleryController@store')->name('gallery/store');

	/* Photo */
	Route::get('photo/{id}', 'PhotosController@show');
	Route::post('photo/update/{type}', 'PhotosController@update');
	Route::post('photo/store', 'PhotosController@store')->name('photo/store');
	Route::delete('photo/destroy/{photo}', 'PhotosController@destroy');

	/* Friends */
	Route::get('friends/index/{type}', 'FriendsController@index')->name('friends/index');
	Route::get('friends/show', 'FriendsController@show')->name('friends/show');
	Route::get('friends/get', 'FriendsController@get')->name('friends/get');
	Route::put('friends/update', 'FriendsController@update')->name('friends/update');
	Route::post('friends/store', 'FriendsController@store')->name('friends/store');
	Route::delete('friends/destroy', 'FriendsController@destroy')->name('friends/destroy');

	/* profile */
	Route::get('profile/edit', 'ProfileController@edit')->name('profile/edit');
	Route::put('profile/update/{type}', 'ProfileController@update')->where('type', '[A-Za-z]+');

	/* User */
	Route::get('profile', 'HomeController@index')->name('profile');
	Route::get('/profile/about', 'HomeController@about')->name('profile/about');
	Route::get('/{name}/{user}', 'HomeController@show');
});
