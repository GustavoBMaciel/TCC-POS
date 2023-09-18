<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('Cod');
            $table->string('nome')->nullable($value = true);
            $table->dateTime('dtcad')->nullable($value = true);
            $table->dateTime('dtnasc')->nullable($value = true);
            $table->string('Responsavel')->nullable($value = true);
            $table->string('rua')->nullable($value = true);
            $table->string('numero')->nullable($value = true);
            $table->string('compl')->nullable($value = true);
            $table->string('Bairro')->nullable($value = true);
            $table->string('CEP')->nullable($value = true);
            $table->string('Cidade')->nullable($value = true);
            $table->string('uf')->nullable($value = true);
            $table->string('fone')->nullable($value = true);
            $table->string('celular')->nullable($value = true);
            $table->text('Obs')->nullable($value = true);
            $table->boolean('ativo')->nullable($value = true);
            $table->integer('Sexo')->default(0);
            $table->integer('convenio')->default(0);
            $table->string('tipo')->nullable($value = true);
            $table->string('foto')->nullable($value = true);
            $table->integer('profissao')->nullable($value = true);
            $table->string('dsEmail')->nullable($value = true);
            $table->string('dsCPF')->nullable($value = true);
            $table->string('dsCartaoConvenio')->nullable($value = true);
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
        Schema::dropIfExists('cliente');
    }
}
