<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpuSupportMemoryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpu_support_memory_types', function (Blueprint $table) {
            $table->unsignedInteger('cpu_id');
            $table->unsignedInteger('memory_type_id');
            $table->primary(['cpu_id', 'memory_type_id'], 'unique_pk_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cpu_support_memory_types');
    }
}
