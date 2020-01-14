<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGamespotReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->integer('gamespot_id')->nullable();
            $table->integer('author_id');
            $table->string('title')->index('title_reviews');
            $table->string('slug');
            $table->text('deck')->nullable();
            $table->longText('body');
            $table->text('good')->nullable();
            $table->text('bad')->nullable();
            $table->json('image');
            $table->dateTime('publish_date');
            $table->dateTime('edit_date');
            $table->double('score');
            $table->string('review_type');
            $table->integer('game_id')->nullable();
            $table->integer('platform_id')->nullable();
            //$table->smallInteger('stt');
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
        Schema::dropIfExists('gamespot_reviews');
    }
}
