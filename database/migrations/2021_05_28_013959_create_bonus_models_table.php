<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_bonus', function (Blueprint $table) {
            $table->id('bonus_id');
            $table->integer('id_project');
            $table->integer('bonus_hari');
            $table->integer('bonus_harga_project');
            $table->integer('bonus_harga_operasional');
            $table->integer('bonus_harga_bersih');
            $table->integer('bonus_persen');
            $table->integer('bonus_harga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_bonus');
    }
}
