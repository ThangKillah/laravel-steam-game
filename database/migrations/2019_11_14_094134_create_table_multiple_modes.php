<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMultipleModes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiplayer_modes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('game_id');
            $table->boolean('campaigncoop')->default(0);
            $table->boolean('dropin')->default(0);
            $table->boolean('lancoop')->default(0);

            $table->boolean('offlinecoop')->default(0);
            $table->integer('offlinecoopmax')->default(0);
            $table->integer('offlinemax');

            $table->boolean('onlinecoop')->default(0);
            $table->integer('onlinecoopmax');
            $table->integer('onlinemax');

            $table->integer('platform_id');

            $table->boolean('splitscreen')->default(0);
            $table->boolean('splitscreenonline')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multiplayer_modes');
    }
}
