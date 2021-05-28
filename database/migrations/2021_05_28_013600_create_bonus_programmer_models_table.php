<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusProgrammerModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_bonus_programmer', function (Blueprint $table) {
            $table->id('bonus_programmer_id');
            $table->integer('bonus_id');
            $table->integer('id_user');
            $table->integer('id_project');
            $table->integer('bonus_programmer_operasional');
            $table->integer('bonus_programmer_lama');
            $table->integer('bonus_programmer_persen');
            $table->integer('bonus_programmer_harga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_bonus_programmer');
    }
}
