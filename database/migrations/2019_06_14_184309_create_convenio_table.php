<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvenioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenio', function (Blueprint $table) {
            $table->increments('Cod');
            $table->string('nome')->nullable($value = true);
            $table->string('contato')->nullable($value = true);
            $table->string('fone')->nullable($value = true);
            $table->dateTime('DiaPagamento')->nullable($value = true);
            $table->dateTime('dtcad')->nullable($value = true);
            $table->boolean('ativo')->nullable($value = true);
            $table->double('desconto', 19, 4)->nullable($value = true);
            $table->string('lancaCaixa')->nullable($value = true);
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
        Schema::dropIfExists('convenio');
    }
}
