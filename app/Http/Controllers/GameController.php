<?php

namespace App\Http\Controllers;

use App\Enums\GameStatus;
use App\Events\GameStarted;
use App\Game;
use App\GamePlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{



    public function publicList() {
        return view('game.list')->withGames(Game::all());
    }

    public function listGames()
    {
        return view('admin.game.index')->withGames(Game::where('status', '!=', GameStatus::ENDED)->get());
    }

    public function overview(Game $game)
    {
        return view('admin.game.overview')->withGame($game);
    }

    public function getOverview(Game $game)
    {
        return $game->generateMap();
    }

    public function start(Game $game)
    {
        $game->status = GameStatus::RUNNING;
        $game->save();
        event(new GameStarted($game));
        return redirect()->back();
    }

    public function data(Game $game)
    {
        return $game;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
