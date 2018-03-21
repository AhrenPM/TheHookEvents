<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feature_id');
            $table->string('location');
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->string('website')->nullable();
            $table->boolean('tickets');
            $table->boolean('recurring_weekly');
            $table->date('recurring_end')->nullable();
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
        Schema::dropIfExists('events');
    }
}
