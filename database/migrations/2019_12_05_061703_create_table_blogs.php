<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('authors');
            $table->string('author_id')->default(0);
            $table->integer('gamespot_id')->nullable();
            $table->string('title');
            $table->text('deck')->nullable();
            $table->longText('body');
            $table->json('image');
            $table->dateTime('publish_date');
            $table->integer('count_view')->default(0);
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
        Schema::dropIfExists('blogs');
    }
}
