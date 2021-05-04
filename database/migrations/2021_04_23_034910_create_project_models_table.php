<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_project', function (Blueprint $table) {
            $table->id('id_project');
            $table->string('judul');
            $table->string('deskripsi');
            $table->date('tanggal_masuk');
            $table->date('tanggal_dateline');
            $table->string('nama_client');
            $table->string('no_hp_client');
            $table->string('harga');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_project');
    }
}
