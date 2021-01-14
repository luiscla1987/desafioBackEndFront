<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesStarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies_stars', function (Blueprint $table) {
            $table->unsignedInteger('movie_id');
            $table->unsignedInteger('star_id');

            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('star_id')->references('id')->on('stars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies_stars');
    }
}
