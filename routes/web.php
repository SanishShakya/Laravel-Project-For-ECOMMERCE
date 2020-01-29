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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('backend/')->namespace('Backend')->name('backend.')->group(function (){
    /*route for tag controller*/
    Route::get('tag/create','TagController@create')->name('tag.create');
    Route::post('tag','TagController@store')->name('tag.store');
    Route::get('tag','TagController@index')->name('tag.index');
    Route::get('{id}/tag','TagController@show')->name('tag.show');
    Route::delete('{id}/tag','TagController@destroy')->name('tag.destroy');


});
Route::prefix('backend/')->namespace('Backend')->name('backend.')->group(function (){
    /*route for category controller*/
    Route::get('category/create','CategoryController@create')->name('category.create');
    Route::post('category','CategoryController@store')->name('category.store');
});
