<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_progres', function (Blueprint $table) {
            $table->id('id_progres');
            $table->integer('id_project');
            $table->integer('id_user');
            $table->string('tgl_mulai');
            $table->string('tgl_selesai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_progres');
    }
}
