<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('concept_id');
            $table->text('web_resource')->nullable();
            $table->text('server_resource')->nullable();
            $table->string('title');
            $table->string('type');
            $table->integer('likes');
            $table->string('image')->nullable();
            $table->text('supports')->nullable();
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
        Schema::dropIfExists('resources');
    }
}
