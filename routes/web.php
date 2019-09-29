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


Route::group(['middleware' => 'auth:web'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => '{game}'], function () {

        Route::get('overview', 'MapController@overview')->name('map.overview');
        Route::get('play', 'PlayerController@play')->name('player.play');
        Route::get('actions', 'ActionController@index')->name('actions.index');
        Route::get('update-map', 'PlayerController@getUpdate')->name('player.update');
        Route::get('get-player', 'PlayerController@getPlayer')->name('player.player');
        Route::get('data', 'GameController@data')->name('game.data');
        Route::post('move', 'PlayerController@move')->name('player.move');

    });

    Route::group(['prefix' => 'admin', 'middleware' => 'userIsAdmin'], function() {
        Route::get('/', 'GameController@listGames');
        Route::get('/game/{game}/start', 'GameController@start')->name('game.start');

    });

});




