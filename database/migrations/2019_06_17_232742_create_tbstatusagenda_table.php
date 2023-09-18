<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbstatusagendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbstatusagenda', function (Blueprint $table) {
            $table->increments('codigo');
            $table->string('nome')->nullable($value = true);
            $table->string('dsSimbolo')->nullable($value = true);
            $table->string('dsCor')->nullable($value = true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbstatusagenda');
    }
}
