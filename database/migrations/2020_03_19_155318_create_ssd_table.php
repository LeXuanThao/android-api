<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSsdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssds', function (Blueprint $table) {
            $table->increments('ssd_id');
            $table->string('name');
            $table->string('image');
            $table->string('brand');
            $table->string('size');
            $table->string('port');
            $table->unsignedInteger('price');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ssds');
    }
}
