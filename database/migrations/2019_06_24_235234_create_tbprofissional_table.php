<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbprofissionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbprofissional', function (Blueprint $table) {
            $table->increments('cdProfissional');
            $table->string('dsAtivo')->nullable($value = true);
            $table->string('dsNomeMedico')->nullable($value = true);
            $table->string('dsCRM')->nullable($value = true);
            $table->string('dsCPF')->nullable($value = true);
            $table->string('dsEspecialidade')->nullable($value = true);
            $table->string('dsFone')->nullable($value = true);
            $table->string('dsCelular')->nullable($value = true);
            $table->string('dsCidade')->nullable($value = true);
            $table->string('dsUF')->nullable($value = true);
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
        Schema::dropIfExists('tbprofissional');
    }
}
