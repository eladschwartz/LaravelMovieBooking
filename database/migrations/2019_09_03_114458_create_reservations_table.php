<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->UnsignedInteger('screening_id');
            $table->UnsignedInteger('user_id');
            $table->UnsignedInteger('amount');
            $table->timestamps();
        });

        Schema::table('reservations', function($table) {
           $table->foreign('screening_id')->references('id')->on('screenings');
           $table->foreign('user_id')->references('id')->on('users');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
