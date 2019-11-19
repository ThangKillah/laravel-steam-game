<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableReleaseDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('release_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('format_date_id');
            $table->integer('game_id');
            $table->timestamp('date')->nullable();
            $table->string('human'); // A human readable representation of the date
            $table->integer('m')->nullable(); //The month as an integer starting at 1 (January)
            $table->integer('y')->nullable(); //The year in full (2018)
            $table->integer('platform_id');
            $table->integer('region');
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
        Schema::dropIfExists('release_dates');
    }
}
