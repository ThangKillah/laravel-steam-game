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
            $table->string('cover')->nullable();
            $table->json('screenshots');
            $table->json('videos');
            $table->json('websites');
            $table->json('similar_games');
            $table->double('aggregated_rating')->nullable(); // Rating based on external critic scores
            $table->integer('aggregated_rating_count')->nullable(); // Number of external critic scores
            $table->dateTime('first_release_date');
            $table->integer('follows')->nullable(); // Number of people following a game
            $table->integer('hypes')->nullable(); //Number of follows a game gets before release
            $table->string('name');
            $table->double('popularity'); // The popularity score of the game
            $table->integer('pulse_count')->nullable(); // Number of pulse articles for this game
            $table->double('rating')->nullable(); // Average IGDB user rating
            $table->integer('rating_count')->nullable(); // Total number of IGDB user ratings
            $table->string('slug');
            //$table->integer('status');
            $table->text('storyline')->nullable(); // A short description of a games story
            $table->text('summary')->nullable(); //A description of the game
            $table->double('total_rating')->nullable(); // Average rating based on both IGDB user and external critic scores
            $table->integer('total_rating_count')->nullable(); // Total number of user and external critic scores
            //$table->string('version_title'); // Title of this version (i.e Gold edition)
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
