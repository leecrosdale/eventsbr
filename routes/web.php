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

Route::get('/test', function() {

    $player = \App\GamePlayer::where('id',1)->first();
    dd($player->weapon);

});

Auth::routes();



Route::group(['middleware' => 'auth:web'], function () {

    Broadcast::routes();

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/games', 'GameController@publicList')->name('game.list');

    Route::group(['prefix' => '{game}'], function () {

        Route::get('join', 'PlayerController@join')->name('game.join');





        Route::get('overview', 'MapController@overview')->name('map.overview');
        Route::get('play', 'PlayerController@play')->name('player.play');

        Route::get('actions', 'ActionController@index')->name('actions.index');
        Route::get('update-map', 'PlayerController@getUpdate')->name('player.update');
        Route::get('get-player', 'PlayerController@getGamePlayer')->name('player.player');
        Route::get('map-items', 'PlayerController@mapItems')->name('map.items');
        Route::get('data', 'GameController@data')->name('game.data');

        Route::post('move', 'PlayerController@move')->name('player.move');
        Route::post('shoot', 'PlayerController@shoot')->name('player.shoot');
        Route::post('pickup', 'PlayerController@pickup')->name('player.pickup');

    });

    Route::group(['prefix' => 'admin', 'middleware' => 'userIsAdmin'], function() {
        Route::get('/', 'GameController@listGames');

        Route::get('/{game}/overview', 'GameController@overview')->name('game.overview');
        Route::get('/{game}/update-map-overview', 'GameController@getOverview')->name('game.update');
        Route::get('/game/{game}/start', 'GameController@start')->name('game.start');
    });

});




