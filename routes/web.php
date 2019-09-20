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

Route::group(['prefix' => '{game}'], function() {

    Route::get('overview', 'MapController@overview')->name('map.overview');
//    Route::get('update-map', 'MapController@map')->name('map.map');
    Route::get('play', 'PlayerController@play')->name('player.play');
    Route::get('update-map', 'PlayerController@getUpdate')->name('player.update');


});




