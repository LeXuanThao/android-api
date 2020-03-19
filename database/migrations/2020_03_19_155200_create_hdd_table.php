<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHddTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hdds', function (Blueprint $table) {
            $table->increments('hdd_id');
            $table->string('name');
            $table->string('image');
            $table->string('brand');
            $table->string('size');
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
        Schema::dropIfExists('hdds');
    }
}
