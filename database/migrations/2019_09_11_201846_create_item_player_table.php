<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_player', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('item_id');
            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('item_id')->references('id')->on('items');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_player');
    }
}
