<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackWolfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_wolf', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pack_id')->unsigned();
            $table->bigInteger('wolf_id')->unsigned();

            $table->foreign('pack_id')->references('id')->on('packs')
                ->onDelete('cascade');

            $table->foreign('wolf_id')->references('id')->on('wolves')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pack_wolf');
    }
}
