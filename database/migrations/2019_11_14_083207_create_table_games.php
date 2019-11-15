<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGames extends Migration
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
            $table->integer('game_id');
            $table->integer('category_id');
            $table->string('cover');
            $table->json('screenshots');
            $table->json('similar_games');
            $table->double('aggregated_rating')->default(0.0); // Rating based on external critic scores
            $table->integer('aggregated_rating_count')->default(0); // Number of external critic scores
            $table->dateTime('first_release_date');
            $table->integer('follows')->default(0); // Number of people following a game
            $table->integer('hypes')->default(0); //Number of follows a game gets before release
            $table->string('name');
            $table->double('popularity'); // The popularity score of the game
            $table->integer('pulse_count'); // Number of pulse articles for this game
            $table->double('rating'); // Average IGDB user rating
            $table->integer('rating_count'); // Total number of IGDB user ratings
            $table->string('slug');
            $table->integer('status');
            $table->string('storyline'); // A short description of a games story
            $table->string('summary'); //A description of the game
            $table->double('total_rating'); // Average rating based on both IGDB user and external critic scores
            $table->integer('total_rating_count'); // Total number of user and external critic scores
            $table->string('version_title'); // Title of this version (i.e Gold edition)
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
        Schema::dropIfExists('games');
    }
}
