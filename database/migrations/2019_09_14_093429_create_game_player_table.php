<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamePlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_player', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('game_id');

            $table->integer('x');
            $table->integer('y');

            $table->integer('health')->default(100);
            $table->integer('stamina')->default(100);

            $table->unsignedBigInteger('item_weapon_id')->nullable();
            $table->unsignedBigInteger('item_armor_id')->nullable();

            $table->tinyInteger('state'); // Standing / Crawling

            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('game_id')->references('id')->on('games');

            $table->foreign('item_weapon_id')->references('id')->on('items');
            $table->foreign('item_armor_id')->references('id')->on('items');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_player');
    }
}
