<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'GuestController@index');
Route::get('guest/books/borrow/{id}', [
	'middleware' => ['auth', 'role:member'],
	'as' => 'guest.books.borrow',
	'uses' => 'BooksController@borrow'
]);

Route::put('books/{book}/return', [
	'middleware' => ['auth', 'role:member'],
	'as' => 'member.books.return',
	'uses' => 'BooksController@returnBack'
]);

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'role:admin']], function () {
	// Route::resource('authors', 'AuthorsController');
	Route::get('authors', 'AuthorsController@index')->name('authors.index');
	Route::get('authors/show', 'AuthorsController@show')->name('authors.show');
	Route::get('authors/create', 'AuthorsController@create')->name('authors.create');
	Route::post('authors/store', 'AuthorsController@store')->name('authors.store');
	Route::get('authors/{id}/edit', 'AuthorsController@edit')->name('authors.edit');
	Route::patch('authors/update/{id}', 'AuthorsController@update')->name('authors.update');
	Route::get('authors/{id}/destroy', 'AuthorsController@destroy')->name('authors.destroy');
	Route::get('authors/chat', 'ChatController@chat')->name('authors.chat');		

});

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'role:admin']], function () {
	Route::get('authors','AuthorsController@index')->name('authors.index');
	Route::get('books', 'BookController@index')->name('index');
	Route::get('books/{id}/destroy', 'BooksController@destroy')->name('books.destroy');
	Route::get('books/store', 'BooksController@store')->name('authors.store');
	
	Route::resource('authors', 'AuthorsController');
	Route::resource('books', 'BooksController');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');
Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');
Route::get('settings/profile', 'SettingsController@profile');
Route::get('settings/profile/edit', 'SettingsController@editProfile');
Route::post('settings/profile', 'SettingsController@updateProfile');
Route::get('settings/password', 'SettingsController@editPassword');
Route::post('settings/password', 'SettingsController@updatePassword');

Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'role:admin']], function () {
	// Route::resource('authors', 'AuthorsController');
	Route::get('members', 'MembersController@index')->name('members.index');
	Route::get('members/show/{id}', 'MembersController@show')->name('members.show');
	Route::get('members/create', 'MembersController@create')->name('members.create');
	Route::post('members/store', 'MembersController@store')->name('members.store');
	Route::get('members/{id}/edit', 'MembersController@edit')->name('members.edit');
	Route::patch('members/update/{id}', 'MembersController@update')->name('members.update');
	Route::get('members/{id}/destroy', 'MembersController@destroy')->name('members.destroy');

	Route::get('statistics', [
		'as'=>'statistics.index',
		'uses'=>'StatisticsController@index'
		]);

});

Route::get('/chat', 'ChatsController@chat');
Route::post('/push', 'ChatsController@push');
Route::get('/vue', 'ChatsController@vue');


Route::post('/ChatSession','ChatsController@chatsession');
Route::post('/textsession','ChatsController@textsession');


Route::get('/follow','SettingsController@follow');

Route::get('/wesmboh','SettingsController@wesmboh');

Route::get('/phone','ChatsController@phone');

