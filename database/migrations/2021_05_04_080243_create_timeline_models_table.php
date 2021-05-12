<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelineModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_timeline', function (Blueprint $table) {
            $table->id('timeline_id');
            $table->integer('id_project');
            $table->integer('id_user');
            $table->enum('status', ['0','1','2','3'])->default(0);
            $table->date('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_timeline');
    }
}
