<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor', function (Blueprint $table) {
            $table->increments('cod');
            $table->string('nome')->index();
            $table->string('rua')->nullable($value = true);
            $table->string('bairro')->nullable($value = true);
            $table->string('cidade')->nullable($value = true);
            $table->string('uf')->nullable($value = true);
            $table->string('cep')->nullable($value = true);
            $table->string('fone')->nullable($value = true);
            $table->string('fax')->nullable($value = true);
            $table->string('numero')->nullable($value = true);
            $table->string('compl')->nullable($value = true);
            $table->string('cgc')->nullable($value = true);
            $table->string('insc')->nullable($value = true);
            $table->string('mail')->nullable($value = true);
            $table->text('obs')->nullable($value = true);
            $table->dateTime('dtcad')->nullable($value = true);
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
        Schema::dropIfExists('fornecedor');
    }
}
