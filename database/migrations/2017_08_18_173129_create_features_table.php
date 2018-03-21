<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theme_id');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->integer('likes')->default(0);
            $table->integer('uses')->default(0);
            $table->boolean('belongs_to_user');
            $table->integer('added_id');
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
        Schema::dropIfExists('features');
    }
}
