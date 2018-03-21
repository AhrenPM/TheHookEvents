<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_queues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feature_id');
            $table->boolean('special')->default(0);
            $table->date('promotion_1')->nullable();
            $table->date('promotion_2')->nullable();
            $table->date('promotion_3')->nullable();
            $table->date('forced')->nullable();
            $table->date('event_date');
            $table->integer('going')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_queues');
    }
}
