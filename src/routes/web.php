<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Auth::routes();

//CATEGORYCONTROLLER
Route::group(['middleware' => 'auth', 'prefix' => '/category'], function()
{
	Route::get('/', 'CategoryController@Category');
	Route::post('/create', 'CategoryController@CreateCategory');
	Route::post('/update', 'CategoryController@UpdateCategory');
	Route::post('/sub_create', 'CategoryController@CreateSubCategory');
	Route::get('/other_category/{id}', 'CategoryController@getRestOfCategories');
	Route::post('/move_category', 'CategoryController@MoveCategory');
	Route::get('/getCategoryTree', 'CategoryController@getCategoryTree');
});

//ITEMCONTROLLER
Route::group(['middleware' => 'auth', 'prefix' => '/item'], function()
{
	Route::get('/', 'ItemController@Item');
	Route::post('/create', 'ItemController@CreateItem');
	Route::post('/update', 'ItemController@UpdateItem');
	Route::get('/getItems', 'ItemController@getItems');
});


//USERCONTROLLER
Route::group(['middleware' => 'auth'], function () 
{
    Route::get('users', 'UsersController@index')->name('users');
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
    Route::get('/notifications', 'UsersController@notifications');
    Route::get('/read', 'UsersController@ReadNotification');
    Route::post('/user/invoke_privilege', 'UsersController@InvokePrivilege');
});

