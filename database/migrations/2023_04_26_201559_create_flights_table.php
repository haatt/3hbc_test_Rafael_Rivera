<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->enum('type', ['PASSENGER', 'FREIGHT']);
            $table->timestamp('departure_time');
            $table->timestamp('arrival_time');

            $table->unsignedBigInteger('departure_id');
            $table->unsignedBigInteger('destination_id');
            $table->unsignedBigInteger('airline_id');

            $table->foreign('departure_id')->references('id')->on('airports');
            $table->foreign('destination_id')->references('id')->on('airports');
            $table->foreign('airline_id')->references('id')->on('airlines');
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
        Schema::dropIfExists('flights');
    }
}
