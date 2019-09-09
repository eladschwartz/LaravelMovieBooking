<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->UnsignedInteger('movie_id');
            $table->integer('adult');
            $table->integer('child');
            $table->timestamps();
        });

        Schema::table('movie_prices', function($table) {
         $table->foreign('movie_id')->references('movie_id')->on('movies');
     });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_prices');
    }
}
