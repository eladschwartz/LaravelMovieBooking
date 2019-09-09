<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->unsignedInteger('movie_id');
            $table->unsignedInteger('genre_id');
            $table->unsignedInteger('price_id');
            $table->foreign('price_id')->references('id')->on('movie_prices');
            $table->string('title');
            $table->float('rating');
            $table->text('overview');
            $table->string('poster_path');
            $table->string('trailer_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}

