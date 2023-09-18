<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcessoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acesso', function (Blueprint $table) {
            $table->integer('codigo')->nullable($value = true);
            $table->string('fone')->nullable($value = true);
            $table->string('Usuario')->nullable($value = true);
            $table->boolean('ativo')->nullable($value = true);
            $table->string('Senha')->nullable($value = true);
            $table->dateTime('dataCadastro')->nullable($value = true);
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
        Schema::dropIfExists('acesso');
    }
}
