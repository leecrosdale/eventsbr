<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('terrain_id');
            $table->string('username', 30);

            $table->integer('health')->default(100);
            $table->integer('stamina')->default(100);

            $table->tinyInteger('state'); // Standing / Crawling
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('terrain_id')->references('id')->on('terrains');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
