<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('map_id');
            $table->string('name');
            $table->string('password');
            $table->tinyInteger('status')->default(\App\Enums\GameStatus::LOBBY);
            $table->integer('max_players')->default(10);
            $table->unsignedBigInteger('current_turn')->default(0);
            $table->timestamps();
            $table->foreign('map_id')->references('id')->on('maps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
