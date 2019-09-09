<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->increments('id');
            $table->UnsignedInteger('theater_id');
            $table->UnsignedInteger('state_id');
            $table->unsignedInteger('row');
            $table->unsignedInteger('number');
            $table->timestamps();
        });

        Schema::table('seats', function($table) {
         $table->foreign('theater_id')->references('id')->on('theaters');
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
