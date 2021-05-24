<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_gaji', function (Blueprint $table) {
            $table->id('id_gaji');
            $table->integer('id_user');
            $table->integer('gaji');
            $table->tinyInteger('hari_kerja');
            $table->date('tanggal_gajian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_gaji');
    }
}
