<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->increments('cod');
            $table->integer('codcli')->index()->default(0);
            $table->dateTime('data')->nullable($value = true);
            $table->string('horario')->nullable($value = true);
            $table->string('realizado')->nullable($value = true);
            $table->integer('tipo')->nullable($value = true);
            $table->string('nomePaciente')->nullable($value = true);
            $table->string('nomeConvenio')->nullable($value = true);
            $table->string('fonePaciente')->nullable($value = true);
            $table->double('valor', 19, 4)->nullable($value = true);
            $table->string('formaPagto')->nullable($value = true);
            $table->time('hrSalaEspera')->nullable($value = true);
            $table->integer('cdProfissional')->nullable($value = true);
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
        Schema::dropIfExists('agenda');
    }
}
