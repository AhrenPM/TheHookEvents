<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->integer('child_id');
            $table->string('parent_title');
            $table->string('child_title');
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
        Schema::dropIfExists('related_subjects');
    }
}
