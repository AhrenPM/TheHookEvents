<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('category_id');
            $table->integer('sub_category_id')->nullable();
            $table->text('statistics');
            $table->text('supports')->nullable();
            $table->string('color1')->nullable();
            $table->string('color2')->nullable();
            $table->string('image')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('child_id')->nullable();
            $table->boolean('is_head');
            $table->boolean('is_last');
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
        Schema::dropIfExists('subjects');
    }
}
