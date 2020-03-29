<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendPcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommend_pc', function (Blueprint $table) {
            $table->increments('pc_id');
            $table->string('name');
            $table->string('image');
            $table->string('type');
            $table->unsignedInteger('cpu_id');
            $table->unsignedInteger('ram_id');
            $table->unsignedInteger('main_id');
            $table->unsignedInteger('vga_id');
            $table->unsignedInteger('psu_id');
            $table->unsignedInteger('hdd_id');
            $table->unsignedInteger('ssd_id');
            $table->unsignedInteger('case_id');
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
        Schema::dropIfExists('recommend_pc');
    }
}
