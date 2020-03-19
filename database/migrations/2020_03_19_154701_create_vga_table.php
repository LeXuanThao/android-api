<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVgaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vgas', function (Blueprint $table) {
            $table->increments('vga_id');
            $table->string('name');
            $table->string('image');
            $table->string('brand');
            $table->string('size');
            $table->string('model');
            $table->string('gpu_brand');
            $table->unsignedInteger('min_power');
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
        Schema::dropIfExists('vgas');
    }
}
