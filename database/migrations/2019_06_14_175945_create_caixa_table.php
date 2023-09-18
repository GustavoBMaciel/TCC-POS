<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaixaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixa', function (Blueprint $table) {
            $table->increments('Num_Sequencial');
            $table->dateTime('Data')->nullable($value = true);
            $table->string('Tipo')->nullable($value = true);
            $table->double('Valor', 19, 4)->default(0.0000);
            $table->integer('Cod_Clifor')->default(0);
            $table->string('Nome_Clifor')->nullable($value = true);
            $table->tinyInteger('Sn')->nullable($value = true);
            $table->integer('Venda')->default(0);
            $table->string('Ent_Ven')->nullable($value = true);
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
        Schema::dropIfExists('caixa');
    }
}
